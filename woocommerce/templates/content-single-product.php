<?php
defined('ABSPATH') || exit;

$product = wc_get_product(get_the_ID());
$productClass = esc_attr(implode(' ', wc_get_product_class('content-single-product', $product)));

// Check if conditions are met.
if (post_password_required()) {
  echo get_the_password_form();
  return;
}

wc_get_template_part('templates/breadcrumbs');
echo "<div class='content-single-product'>";
  echo '<div class="single-product__summary">';
    echo '<div class="container">';
      wc_get_template_part('templates/single-product/images');
      wc_get_template_part('templates/single-product/add-to-cart/' . $product->get_type());
    echo '</div>';
  echo '</div>';
  wc_get_template_part('templates/single-product/tabs');
  wc_get_template_part('templates/single-product/upsells');
echo '</div>';