<?php

namespace Swift;

/**
 * Provides a method for loading production build assets.
 */
class AssetLoader
{
  private static $manifest;

  // Load the manifest file.
  private static function loadManifest(): array
  {
    if (!isset(self::$manifest)) {
      $manifestPath = get_stylesheet_directory() . '/build/manifest.json';
      if (file_exists($manifestPath)) {
        self::$manifest = json_decode(file_get_contents($manifestPath), true);
      } else {
        self::$manifest = [];
      }
    }
    return self::$manifest;
  }

  // Get the URL for an asset from the manifest.
  public static function loadAsset(string $asset): string
  {
    $manifest = self::loadManifest();

    if (isset($manifest[$asset]['file'])) {
      return get_stylesheet_directory_uri() . '/build/' . $manifest[$asset]['file'];
    } else {
      return get_stylesheet_directory_uri() . '/build/' . $asset;
    }
  }
}