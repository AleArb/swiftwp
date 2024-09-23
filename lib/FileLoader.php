<?php

namespace Swift;

/**
 * Provides a method for glob loading "php" files.
 */
class FileLoader
{
  public static function loadPhpFiles(string $path): void
  {
    $directory = get_stylesheet_directory() . $path;
    $phpFiles = glob($directory . '/*.php');

    sort($phpFiles);
    foreach ($phpFiles as $phpFile) {
      require_once $phpFile;
    }
  }
}