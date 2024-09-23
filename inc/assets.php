<?php

namespace Swift\Assets;

use Swift\AssetLoader;

// Enqueue frontend related styles and scripts.
add_action('wp_enqueue_scripts', function (): void {
  wp_enqueue_script('Swift/assets/index', AssetLoader::loadAsset('assets/index.js'), [], null, true);
  wp_script_add_data('Swift/assets/index', 'module', true);

  wp_enqueue_style('Swift/assets/index', AssetLoader::loadAsset('assets/index.scss'), [], null);
});

// Enqueue admin related styles and scripts.
add_action('admin_enqueue_scripts', function (): void {
  wp_enqueue_script('Swift/assets/admin', AssetLoader::loadAsset('assets/admin.js'), [], null, true);
  wp_script_add_data('Swift/assets/admin', 'module', true);

  wp_enqueue_style('Swift/assets/admin', AssetLoader::loadAsset('assets/admin.scss'), [], null);
});