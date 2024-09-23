<?php

namespace Swift\Components\NavigationMain;

add_action('after_setup_theme', function (): void {
  register_nav_menus([
    'navigation_main' => __('Navigation Main', 'swift')
  ]);
});

add_filter('Swift/addComponentData?name=NavigationMain', function (array $data): array {
  $data['menu'] = Timber::get_menu('navigation_main') ?? Timber::get_pages_menu();
  $data['logo'] = [
      'src' => get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : Asset::requireUrl('assets/images/logo.svg'),
      'alt' => get_bloginfo('name')
  ];

  return $data;
});