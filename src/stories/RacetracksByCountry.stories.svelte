<script module>
      import { defineMeta } from '@storybook/addon-svelte-csf';
      import { expect, userEvent, waitFor, within } from '@storybook/test';
    import RacetrackByCountry from './RacetrackByCountry.svelte';
      const { Story } = defineMeta({
        title: 'Example/RacetrackByCountry',
    component: RacetrackByCountry,
    parameters: {
      // More on how to position stories at: https://storybook.js.org/docs/configure/story-layout
    //   layout: 'fullscreen',
    },
  });
</script>
<Story name="x" />