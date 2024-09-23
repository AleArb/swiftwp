<?php
defined('ABSPATH') || exit;

$product = wc_get_product(get_the_ID());
$product_description = $product->get_description();
?>

<div class="single-product__description">
    <div class="h5"><?php echo __( 'Product Description', 'swift'); ?></div>
    <div class="content"><?php echo $product_description; ?></div>
</div>