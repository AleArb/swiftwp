<?php

namespace Swift\Components\NavigationMain;

add_action('after_setup_theme', function (): void {
  register_nav_menus([
    'navigation_footer' => __('Navigation Footer', 'swift')
  ]);
});