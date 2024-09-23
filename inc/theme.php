<?php

namespace Swift\Theme;

add_action('after_setup_theme', function (): void
{
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
  add_theme_support('title_tag');
  add_theme_support('woocommerce');

  /**
   * Register menus.
   */
  register_nav_menus([
      'primary_menu' => __('Primary menu', 'swift'),
      'footer_menu_1' => __('Footer Menu 1', 'swift'),
      'footer_menu_2' => __('Footer Menu 2', 'swift'),
      'footer_menu_3' => __('Footer Menu 3', 'swift'),
      'legal' => __('Legal', 'swift'),
  ]);

  /**
   * Make theme available for translation.
   * Translations can be filled in the /languages directory.
   */
  load_theme_textdomain('swift', get_template_directory() . '/languages');
});

/**
 * Remove auto <p> tag.
 */
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

/**
 * Allow SVG upload to media library.
 */
add_filter('upload_mimes', function ($mimes): array {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
});