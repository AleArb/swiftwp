<?php

namespace Swift;

/**
 * Provides a set of methods that are used to manipulate strings.
 */
class StringHelpers
{
  /**
   * Removes a prefix from a string.
   */
  public static function removePrefix(string $prefix, string $string): string
  {
    if (substr($string, 0, strlen($prefix)) === $prefix) {
      return substr($string, strlen($prefix));
    }

    return $string;
  }

  /**
   * Updates url parameters.
   */
  public static function updateUrlParameters(string $query): string
  {
    $delimiter = '=';
    $parts = explode($delimiter, $query, 2);

    if (count($parts) !== 2) {
      throw new InvalidArgumentException('Invalid parameter string format. Expected format is "key=value".');
    }

    $key = trim($parts[0]);
    $value = trim($parts[1]);
    $currentUrl = $_SERVER['REQUEST_URI'];
    $urlComponents = parse_url($currentUrl);
    $queryParams = [];

    if (isset($urlComponents['query'])) {
      parse_str($urlComponents['query'], $queryParams);
    }

    $queryParams[$key] = $value;
    $newQueryString = http_build_query($queryParams);
    $newUrl = $urlComponents['path'] . '?' . $newQueryString;

    return $newUrl;
  }
}