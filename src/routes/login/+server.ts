// src/routes/login/+server.ts
import { API_BASE_URL } from '../../lib/api.js';
import type { RequestHandler } from '@sveltejs/kit';

export const POST: RequestHandler = async ({ request }) => {
  const { usr, pass } = await request.json();

  const response = await fetch(`${API_BASE_URL}/login-dynamic`, {
    method: 'GET',
    headers: { usr, pass }
  });

  const data = await response.text();

  if (!response.ok) {
    return new Response(JSON.stringify({ error: 'login fallido' }), { status: 401 });
  }

  return new Response(JSON.stringify({ success: true, message: data }), { status: 200 });
};
