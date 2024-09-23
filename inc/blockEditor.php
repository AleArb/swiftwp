<?php

namespace Swift\BlockEditor;

// Remove Gutenberg.
// add_filter('use_block_editor_for_post', '__return_false', 10);
// add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Remove Gutenberg related styles on front-end.
add_action('wp_enqueue_scripts', function (): void {
  wp_dequeue_style('core-block-supports');
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wp-global-styles');
  wp_dequeue_style('block-style-variation-styles');
});