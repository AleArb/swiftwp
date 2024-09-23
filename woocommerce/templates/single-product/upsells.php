<?php

defined('ABSPATH') || exit;

$product = wc_get_product(get_the_ID());
$product_upsell_ids = $product->get_upsell_ids();

if (empty($product_upsell_ids)) {
    return;
}

echo '<div class="single-product__upsells">';
  echo '<div class="container">';
    echo '<h2 class="title">' . __("You'll also love", 'swift') . '</h2>';
    echo '<ul class="products">';
      foreach ($product_upsell_ids as $product_upsell_id) {
        echo '<li class="product">';
          get_template_part('woocommerce/templates/content', 'product', [
            'product_id' => $product_upsell_id
          ]);
        echo '</li>';
      }
    echo '</ul>';
  echo '</div>';
echo '</div>';