<?php
defined('ABSPATH') || exit;

// Get WooCommerce global objects
global $post, $wp_query, $wp_post_types;
$separator = '<span>/</span>';

// Breadcrumbs wrapper start
echo '<div class="breadcrumbs">';
  echo '<div class="container">';
    // Handle Shop page link
    if (is_shop()) {
      echo esc_html(get_the_title(wc_get_page_id('shop')));
    } elseif ( is_product_category() || is_product_tag() ) {
      // Product category or tag
      $term = $wp_query->get_queried_object();
      $taxonomy = $term->taxonomy;

      // Get ancestors and output breadcrumb links
      $ancestors = get_ancestors($term->term_id, $taxonomy);
      $ancestors = array_reverse($ancestors);

      foreach ($ancestors as $ancestor) {
        $ancestor = get_term($ancestor, $taxonomy);
        echo '<a href="' . esc_url(get_term_link($ancestor->term_id, $taxonomy)) . '">' . esc_html($ancestor->name) . '</a>' . $separator;
      }

      // Current term
      echo esc_html($term->name);
    } elseif ( is_product() ) {
      // Single product
      $terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent'));
      if ($terms) {
        $term = end($terms);
        $ancestors = get_ancestors($term->term_id, 'product_cat');
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $ancestor = get_term($ancestor, 'product_cat');
            echo '<a href="' . esc_url(get_term_link($ancestor->term_id, 'product_cat')) . '">' . esc_html($ancestor->name) . '</a>' . $separator;
        }

        // Current term
        echo '<a href="' . esc_url(get_term_link($term->term_id, 'product_cat')) . '">' . esc_html($term->name) . '</a>' . $separator;
      }

      // Current product
      echo esc_html(get_the_title());
    } else {
      // Fallback for other pages
      echo esc_html(get_the_title());
    }
  echo '</div>';
echo '</div>';