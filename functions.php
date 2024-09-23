<?php

namespace Swift;

use Swift\ComponentManager;
use Swift\FileLoader;

require_once __DIR__ . '/vendor/autoload.php';

if ( !defined('WP_ENV') ) {
  define('WP_ENV', function_exists('wp_get_environment_type') ? wp_get_environment_type() : 'production');
} elseif ( !defined('WP_ENVIRONMENT_TYPE') ) {
  define('WP_ENVIRONMENT_TYPE', WP_ENV);
}

// Load files from /inc folder.
FileLoader::loadPhpFiles('/inc');

// Load components.
ComponentManager::loadComponents();