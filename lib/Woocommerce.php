<?php

namespace Swift;

use Exception;

/**
 * Provides a set of methods that are used to manipulate Woocommerce data.
 */
class Woocommerce
{
  // Returns currently selected variation of a variable product based on parameters in the URL.
  public static function wc_get_product_variation(int $product_id): object
  {
    $product = wc_get_product($product_id);

    if (!$product || !$product->is_type('variable')) {
      throw new Exception('Invalid product. Please make sure the product either exists, or is variable.');
    }

    $variations = $product->get_available_variations();
    $default_attributes = $product->get_default_attributes();
    $filtered_attributes = array_filter($_GET, function($attribute_name) {
      return strpos($attribute_name, 'attribute_') !== false;
    }, ARRAY_FILTER_USE_KEY);
    $queried_attributes = array_combine(
      array_map(function($key) {
        return str_replace('attribute_', '', $key);
      },
      array_keys($filtered_attributes)),
      $filtered_attributes
    );
    $selected_attributes = [];

    foreach (array_merge($default_attributes, $queried_attributes) as $selected_attribute_name => $selected_attribute_value) {
      $selected_attributes[$selected_attribute_name] = sanitize_text_field($selected_attribute_value);
    }

    // Check each variation for a match
    foreach ($variations as $variation_data) {
      $variation = wc_get_product($variation_data['variation_id']);
      $variation_attributes = $variation->get_attributes();

      if ($variation_attributes == $selected_attributes) {
        return $variation;
      }
    }

    // No matching variation found
    return $product;
  }

  // Register attribute meta.
  public static function registerAttributeMeta(string $attribute_meta): void
  {
    // Hook for adding attribute meta.
    add_action('woocommerce_attribute_added', function($attribute_id) use ($attribute_meta): void {
      add_term_meta($attribute_id, $attribute_meta, sanitize_text_field($_POST[$attribute_meta]));
    });
    // Hook for updating attribute meta.
    add_action('woocommerce_attribute_updated', function($attribute_id) use ($attribute_meta): void {
      update_term_meta($attribute_id, $attribute_meta, sanitize_text_field($_POST[$attribute_meta]));
    });
    // Hook for deleting attribute meta.
    add_action('woocommerce_attribute_deleted', function($attribute_id) use ($attribute_meta): void {
      delete_term_meta($attribute_id, $attribute_meta);
    });
  }
}