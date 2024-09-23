<?php

namespace Swift\Woocommerce;

/**
 * Disable WooCommerce default styles.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Woocommerce template hooks.
 */
remove_all_actions('woocommerce_before_main_content');
remove_all_actions('woocommerce_sidebar');
remove_all_actions('woocommerce_before_shop_loop');
remove_all_actions('woocommerce_shop_loop');
remove_all_actions('woocommerce_before_shop_loop_item');
remove_all_actions('woocommerce_before_shop_loop_item_title');
remove_all_actions('woocommerce_shop_loop_item_title');
remove_all_actions('woocommerce_after_shop_loop_item_title');
remove_all_actions('woocommerce_after_shop_loop_item');
# remove_all_actions('woocommerce_before_single_product');
remove_all_actions('woocommerce_before_single_product_summary');
remove_all_actions('woocommerce_single_product_summary');
remove_all_actions('woocommerce_product_thumbnails');
remove_all_actions('woocommerce_before_add_to_cart_form');
remove_all_actions('woocommerce_before_add_to_cart_button');
remove_all_actions('woocommerce_after_add_to_cart_button');
remove_all_actions('woocommerce_after_add_to_cart_form');
remove_all_actions('woocommerce_after_single_product_summary');
remove_all_actions('woocommerce_after_single_product');

/**
 * Custom meta.
 */
add_action('woocommerce_after_add_attribute_fields', function (): void {
  ?>
  <div class="form-field">
    <label for="attribute_type">Type</label>
    <select name="attribute_type">
      <option value="select" selected>Select</option>
      <option value="swatch">Swatch</option>
    </select>
    <p class="description">Determines the way product attribute is displayed in the product variation picker.</p>
  </div>
  <?php
});

/**
 * Adds attribute "Type" field to product attributes edit screen.
 */
add_action('woocommerce_after_edit_attribute_fields', function(): void {
  ?>
  <tr class="form-field form-required">
    <th scope="row" valign="top">
        <label for="attribute_type">Type</label>
    </th>
    <td>
      <select name="attribute_type">
        <option value="select" <?php echo (get_term_meta($_GET['edit'], 'attribute_type', true) == 'select' ? 'selected' : null); ?>>Select</option>
        <option value="swatch" <?php echo (get_term_meta($_GET['edit'], 'attribute_type', true) == 'swatch' ? 'selected' : null); ?>>Swatch</option>
      </select>
      <p class="description">Determines the way product attribute is displayed in the product variation picker.</p>
    </td>
  </tr>
  <?php
});

/**
 * Hook for adding attribute meta.
 */
add_action('woocommerce_attribute_added', function($attribute_id): void {
  add_term_meta($attribute_id, 'attribute_type', sanitize_text_field($_POST['attribute_type']));
});

/**
 * Hook for updating attribute meta.
 */
add_action('woocommerce_attribute_updated', function($attribute_id): void {
  update_term_meta($attribute_id, 'attribute_type', sanitize_text_field($_POST['attribute_type']));
});

/**
 * Hook for deleting attribute meta.
 */
add_action('woocommerce_attribute_deleted', function($attribute_id): void {
  delete_term_meta($attribute_id, 'attribute_type');
});

/**
 * Add attribute term fields.
 */
add_action('pa_color_add_form_fields', function (): void {
  ?>
  <div class="form-field term-thumbnail-wrap">
    <label>Thumbnail</label>
      <div class="term-thumbnail-container" style="float: left; margin-right: 10px;">
        <img src="/wp-content/uploads/woocommerce-placeholder-240x240.png" width="60px" height="60px">
      </div>
      <div style="line-height: 60px;">
        <input type="hidden" id="term-thumbnail-id" name="term-thumbnail-id">
        <button type="button" class="upload_image_button button">Upload/Add image</button>
        <button type="button" class="remove_image_button button" style="display: none;">Remove image</button>
      </div>
    <div class="clear"></div>
  </div>
  <?php
});

/**
 * Add attribute term fields.
 */
add_action('pa_color_edit_form_fields', function (): void {
  ?>
  <tr class="form-field term-thumbnail-wrap">
    <th scope="row" valign="top">
      <label>Thumbnail</label>
    </th>
    <td>
      <div class="term-thumbnail-container" style="float: left; margin-right: 10px;">
        <img src="<?php echo (get_term_meta($_GET['tag_ID'], 'term-thumbnail-id', true) ? wp_get_attachment_image_url(get_term_meta($_GET['tag_ID'], 'term-thumbnail-id', true), 'thumbnail') : '/wp-content/uploads/woocommerce-placeholder-240x240.png'); ?>" width="60px" height="60px">
      </div>
      <div style="line-height: 60px;">
        <input type="hidden" id="term-thumbnail-id" name="term-thumbnail-id" value="<?php echo get_term_meta($_GET['tag_ID'], 'term-thumbnail-id', true); ?>">
        <button type="button" class="upload_image_button button">Upload/Add image</button>
        <button type="button" class="remove_image_button button" style="display: none;">Remove image</button>
      </div>
      <div class="clear"></div>
    </td>
  </tr>
  <?php
});

/**
 * Hook for creating attribute term meta.
 */
add_action('created_term', function ($term_id): void {
  add_term_meta($term_id, 'term-thumbnail-id', sanitize_text_field($_POST['term-thumbnail-id']), true);
});

/**
 * Hook for editing attribute term meta.
 */
add_action('edited_term', function ($term_id): void {
  update_term_meta($term_id, 'term-thumbnail-id', sanitize_text_field($_POST['term-thumbnail-id']));
});

/**
 * Product variation meta fields.
 */
add_action('woocommerce_product_after_variable_attributes', function ($loop, $variation_data, $variation): void
{
  // Add "Additional images" meta field to product variations.
  echo '<div class="variation-images">';
    echo '<input type="hidden" name="variation_image_ids[' . $loop . ']" value="' . implode(",", wc_get_product($variation->ID)->get_gallery_image_ids()) . '">';
  echo '</div>';

  // Add input field for variation ids that have "Select" attribute type.
  $variation_object = wc_get_product($variation->ID);
  $variation_attributes = $variation_object->get_attributes();

  foreach ($variation_attributes as $variation_attribute_name => $variation_attribute_value) {
    $variation_attribute_id = wc_attribute_taxonomy_id_by_name($variation_attribute_name);
    $variation_attribute_type = get_term_meta($variation_attribute_id, 'attribute_type', true);

    switch ($variation_attribute_type) {
      case 'select':
        echo '<div class="form-row variation-' . $variation_attribute_name . '">';
        echo '<label for="variation_' . $variation_attribute_name . '_ids[' . $loop . ']">Variation ids for "' . wc_attribute_label($variation_attribute_name) . '" options</label>';
        echo '<input type="text" name="variation_' . $variation_attribute_name . '_ids[' . $loop . ']" value="' . get_post_meta($variation->ID, 'variation_' . $variation_attribute_name . '_ids', true) . '">';
        echo '</div>';
      break;
    }
  }
}, 10, 3);

/**
 * Save product variation meta.
 */
add_action('woocommerce_save_product_variation', function ($variation_id, $loop): void
{
  $variation = wc_get_product($variation_id);
  $gallery_image_ids = array_map('intval', explode(',', $_POST['variation_image_ids'][$loop]));
  $variation->set_gallery_image_ids($gallery_image_ids);
  $variation->save();

  $variation_object = wc_get_product($variation_id);
  $variation_attributes = $variation_object->get_attributes();

  foreach ($variation_attributes as $variation_attribute_name => $variation_attribute_value) {
    $variation_attribute_id = wc_attribute_taxonomy_id_by_name($variation_attribute_name);
    $variation_attribute_type = get_term_meta($variation_attribute_id, 'attribute_type', true);

    switch ($variation_attribute_type) {
      case 'select':
        if (isset($_POST['variation_' . $variation_attribute_name . '_ids'][$loop])) {
          update_post_meta($variation_id, 'variation_' . $variation_attribute_name . '_ids', sanitize_text_field($_POST['variation_' . $variation_attribute_name . '_ids'][$loop]));
        }
      break;
    }
  }
}, 10, 2);