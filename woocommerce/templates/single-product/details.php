<?php
defined('ABSPATH') || exit;

$product = wc_get_product(get_the_ID());
$product_attributes = $product->get_attributes() ?: [];
?>

<div class="singleProduct__details">
  <div class="title h5"><?php echo __( 'Product Details', 'swift'); ?></div>
  <ul class="items">
    <?php foreach ($product_attributes as $product_attribute) : ?>
      <?php if ($product_attribute->get_visible()) : ?>
        <li class="item">
          <span class="item__label"><?php echo $product_attribute->get_name() . ': '; ?></span>
          <span class="item__value">
            <?php if ($product_attribute->get_options()) : ?>
              <?php echo implode(', ', $product_attribute->get_options()); ?>
            <?php endif; ?>
          </span>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>