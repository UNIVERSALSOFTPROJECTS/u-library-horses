<script module>
    import { defineMeta } from '@storybook/addon-svelte-csf';
    import { fn } from '@storybook/test';
    import NavbarComponent from './NavbarComponent.svelte';
    const { Story } = defineMeta({
    title: 'Example/Navbar',
    component: NavbarComponent,
    parameters: {
      // More on how to position stories at: https://storybook.js.org/docs/configure/story-layout
    //   layout: 'fullscreen',
    },
  });
</script>
<Story name= "a"/>