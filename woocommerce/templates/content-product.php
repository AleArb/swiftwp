<?php

$product = wc_get_product($args['product_id']);

if (empty($product) || !$product->is_visible() || !$product->is_purchasable()) {
  return;
}

$product_id = $args['product_id'];
$product_class = esc_attr(implode(' ', wc_get_product_class('content-product', $product)));
$productTitle = $product->is_type('variation') ? wc_get_product($product->get_parent_id())->get_name() : $product->get_name();
$productSubtitle = $product->is_type('variation') ? $product->get_description() : null;
$product_permalink = $product->get_permalink();
$product_image_url = $product->get_image_id() ? wp_get_attachment_image_url($product->get_image_id(), 'medium') : null;
$product_regular_price = $product->get_regular_price() ?: null;
$product_sale_price = $product->get_sale_price() ?: null;

?>

<div class="product" data-id="<?php echo $product_id; ?>" data-title="<?php echo $productTitle; ?>" data-price="<?php echo $product_price; ?>">
  <a href="<?php echo $product_permalink; ?>">
    <div class="product__picture">
      <img class="product__picture-image" src="<?php echo $product_image_url; ?>">
    </div>
  </a>
  <div class="product__content">
    <a class="product__title" href="<?php echo $product_permalink; ?>"><?php echo $productTitle; ?></a>
    <div class="product__price">
      <?php if ($product->is_on_sale()) : ?>
        <span class="product__priceAmount"><?php echo strip_tags(wc_price($product_regular_price)); ?></span>
        <span class="product__priceAmount -sale"><?php echo strip_tags(wc_price($product_sale_price)); ?></span>
      <?php else : ?>
        <span class="product__priceAmount"><?php echo strip_tags(wc_price($product_regular_price)); ?></span>
      <?php endif; ?>
    </div>
  </div>
</div>