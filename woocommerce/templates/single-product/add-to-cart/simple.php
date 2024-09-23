<?php
defined('ABSPATH') || exit;

$product = wc_get_product(get_the_ID());

echo '<form class="single-product__add-to-cart" action="' . esc_url(apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ) . '" method="post" enctype="multipart/form-data">';

    echo '<h1 class="singleProduct__title">' . $product->get_name() . '</h1>';

    // Price
    if ($product->get_price()) {
      echo '<div class="singleProduct__price">';
        echo '<span class="singleProduct__priceAmount">' . strip_tags(wc_price($product->get_price())) . '</span>';
        echo ($product->is_on_sale() ? '<span class="price-amount price-amount--old">' . strip_tags(wc_price($product->get_regular_price())) . '</span>' : null);
      echo '</div>';
    }

    echo '<button class="button button__add-to-cart" type="submit" name="add-to-cart" value="' . $product->get_id() . '">' . __( 'Add to Cart', 'swift' ) . '</button>';

echo '</form>';