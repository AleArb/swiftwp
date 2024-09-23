<?php

use Swift\Woocommerce;

$product = wc_get_product(get_the_ID());

if ($product->is_type('variable')) {
  $product = Woocommerce::wc_get_product_variation(get_the_ID());
}

$placeholder_image_url = get_theme_file_uri('/assets/images/placeholder-image.webp');
$product_thumbnail = $product->get_image_id() ?: null;
$product_gallery = $product->get_gallery_image_ids() ?: array();
$product_images = array_unique(array_merge($product_thumbnail ? array($product_thumbnail) : array(), $product_gallery));


// Check if conditions are met
if ( !$product_images ) {
    echo '<div class="h1">Error: Product images are missing</div>';
    return;
}

echo '<div class="single-product__images">';
    echo '<div class="carousel">';
        echo '<div class="carousel-slides">';
            echo '<div class="carousel-arrows">';
                echo '<button class="carousel-arrow carousel-arrow-left">';
                    echo '<img src="' . get_theme_file_uri('/assets/images/chevron-left.svg') . '" alt="">';
                echo '</button>';
                echo '<button class="carousel-arrow carousel-arrow-right">';
                    echo '<img src="' . get_theme_file_uri('/assets/images/chevron-right.svg') . '" alt="">';
                echo '</button>';
            echo '</div>';
            echo '<ul class="items">';
                foreach ($product_images as $product_image_key => $product_image) {
                    echo '<li class="item" data-item-key="' . $product_image_key . '">';
                        echo '<picture class="picture">';
                            echo '<img class="picture-image" src="' . wp_get_attachment_image_url( $product_image, 'large' ) . '" alt="">';
                        echo '</picture>';
                    echo '</li>';
                }
            echo '</ul>';
        echo '</div>';
        echo '<div class="carousel-thumbnails">';
            echo '<ul class="items">';
                foreach ($product_images as $product_image_key => $product_image) {
                    echo '<li class="' . ($product_image_key == 0 ? 'item item--active' : 'item') . '" data-item-key="' . $product_image_key . '">';
                        echo '<picture class="picture">';
                            echo '<img class="picture-image" src="' . wp_get_attachment_image_url( $product_image, 'thumbnail' ) . '" alt="">';
                        echo '</picture>';
                    echo '</li>';
                }
            echo '</ul>';
        echo '</div>';
    echo '</div>';
echo '</div>';