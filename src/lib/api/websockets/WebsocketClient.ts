import { get } from 'svelte/store';
import { userSession } from '../stores/userLogin.js';
import { muestroHip2List } from '../stores/muestroHip2Store.js';
import type { WSMuestroHip2NewResponse } from '../models/WSMuestroHip2NewResponse.js';
import { hipodromosBase } from '../stores/hipodromosBase.js';
    
type MessageHandler = (data: any) => void;

export class WebSocketClientService {
  private socket: WebSocket | null = null;
  private url: string;
  private handlers: MessageHandler[] = [];
  private keepAliveInterval: number | null = null;

  constructor(url: string) {
    this.url = url;
  }

  connect(): void {
    const session = get(userSession);
    if (!session?.token) {
      console.warn('[WS] ❌ No hay token en sesión, no se conecta');
      return;
    }

    this.socket = new WebSocket(this.url);

    this.socket.onopen = () => {
      console.log('[WS] ✅ Conectado');
      this.keepAliveInterval = window.setInterval(() => {
        this.send("2");
      }, 25000);
    };

    this.socket.onmessage = (event: MessageEvent) => {
      try {
        const message = JSON.parse(event.data);
        console.log('[WS] 📩 Recibido:', message);
        this.handlers.forEach(handler => handler(message));
        this.handleSpecialMessages(message);
      } catch (err) {
        console.error('[WS] ❌ Error parseando mensaje:', err);
      }
    };

    this.socket.onerror = (err) => {
      console.error('[WS] ❗ Error:', err);
    };

    this.socket.onclose = () => {
      console.warn('[WS] 🔌 Desconectado');
      if (this.keepAliveInterval) {
        clearInterval(this.keepAliveInterval);
        this.keepAliveInterval = null;
      }
    };
  }

  private handleSpecialMessages(msg: any): void {
    const session = get(userSession);
    const token = session?.token ?? 'NO_TOKEN';

    if (msg.etype === 'runmethodWithResult') {
      if (msg.method === 'val') {
        this.send({ type: 'data', data: token });

        setTimeout(() => {
          const payload = {
            type: 'event',
            event: 'fromUser_LogThisString',
            params: {
              tipo: 'ch2',
              tokens: token,
              idt: '40',
              tr: 'LRL',
              cr: '7',
              icr: '1204425'
            }
          };
          this.send(payload);
        }, 1000);
      }

      if (msg.method === 'prop' && msg.params?.[0] === 'size') {
        this.send({ type: 'data', data: 1000 });
      }
    }

    if (msg.etype === 'runFunction' && msg.prop === 'muestro_hip2_new') {
      try {
        const raw = msg.value; // puede ser string o string[]
        const jsonString = Array.isArray(raw) ? raw[0] : raw;
    
        const parsed = JSON.parse(jsonString) as WSMuestroHip2NewResponse[];

        const baseHipodromos = get(hipodromosBase);

        const enriched = parsed.map((ws) => {
          const base = baseHipodromos.find((b) => b.id_pista === ws.rid_pista);
          return {...ws, ...base};
        })

        console.log("🎯 muestro_hip2_new parseado:", parsed);
    
        // Guardar lista completa
        muestroHip2List.set(enriched);
    
      } catch (err) {
        console.error("❌ Error al parsear muestro_hip2_new:", err);
      }
    }
    
  }

  send(data: any): void {
    if (this.socket?.readyState === WebSocket.OPEN) {
      const payload = typeof data === 'string' ? data : JSON.stringify(data);
      this.socket.send(payload);
    }
  }

  onMessage(handler: MessageHandler): void {
    this.handlers.push(handler);
  }

  close(): void {
    this.socket?.close();
    if (this.keepAliveInterval) clearInterval(this.keepAliveInterval);
  }
}
