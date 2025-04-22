<script module>
    import { defineMeta } from '@storybook/addon-svelte-csf';
    import { expect, userEvent, waitFor, within } from '@storybook/test';
    import AmountRacetrackByType from './AmountRacetrackByType.svelte';
    const { Story } = defineMeta({
      title: 'Example/AmountRacetrackByType',
  component: AmountRacetrackByType,
  parameters: {
    // More on how to position stories at: https://storybook.js.org/docs/configure/story-layout
  //   layout: 'fullscreen',
  },
});
</script>
<Story name="y" />