<?php

namespace Swift;

/**
 * Set of methods for managing custom components.
 */
class ComponentManager
{
  // Method for loading component "functions.php" file.
  public static function loadComponents(): void {
    $componentFiles = glob(get_stylesheet_directory() . '/Components/**/functions.php');

    sort($componentFiles);
    foreach ($componentFiles as $componentFile) {
      require_once $componentFile;
    }
  }
}