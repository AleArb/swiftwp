<?php

use Swift\Woocommerce;

$product = wc_get_product(get_the_ID());
$variation = Woocommerce::wc_get_product_variation(get_the_ID());
$variation_price = $variation->get_price();
$variation_price_old = $variation->get_regular_price();
$variation_description = $variation->get_description();

$attributes = $product->get_variation_attributes();
?>
<form class="single-product__add-to-cart" action="<?php echo esc_url( apply_filters('woocommerce_add_to_cart_form_action', $variation->get_permalink()) ); ?>" method="post" enctype="multipart/form-data">

  <h1 class="singleProduct__title"><?php echo $product->get_name(); ?></h1>

  <div class="singleProduct__subtitle"><?php echo $variation->get_description(); ?></div>

  <?php if ( $variation->get_price() ) : ?>
    <div class="singleProduct__price">
      <?php if ( $variation->is_on_sale() ) : ?>
        <span class="singleProduct__priceAmount"><?php echo strip_tags( wc_price( $variation->get_regular_price() ) ); ?></span>
        <span class="singleProduct__priceAmount -sale"><?php echo strip_tags( wc_price( $variation->get_sale_price() ) ); ?></span>
      <?php else : ?>
        <span class="singleProduct__priceAmount"><?php echo strip_tags( wc_price( $variation->get_regular_price() ) ); ?></span>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php wc_get_template_part('templates/single-product/add-to-cart/variations'); ?>

    <button class="button button__add-to-cart" type="submit" name="add-to-cart" value="<?php echo $variation->get_id(); ?>"><?php echo __('Add to Cart', 'swift'); ?></button>

    <div class="singleProduct__shipping"><?php echo ($variation->is_in_stock() ? 'In stock - ships in 2-3 days from Dublin' : 'Ships in 3-4 weeks from Dublin'); ?></div>

</form>