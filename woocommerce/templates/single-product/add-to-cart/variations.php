<?php

use Swift\Woocommerce;
use Swift\StringHelpers;

$product = wc_get_product(get_the_ID());
$variation = Woocommerce::wc_get_product_variation(get_the_ID());
$variation_attributes = $product->get_variation_attributes();

foreach ($variation_attributes as $variation_attribute_name => $variation_attribute_options) {
  $variation_attribute_id = wc_attribute_taxonomy_id_by_name($variation_attribute_name);
  $variation_attribute_type = get_term_meta($variation_attribute_id, 'attribute_type', true);

  switch ($variation_attribute_type) {
    case 'swatch':
      echo '<div class="singleProduct__variationSwatch">';
        echo '<ul class="options">';
          foreach ($variation_attribute_options as $variation_attribute_option_key => $variation_attribute_option) {
            $term = get_term_by('slug', $variation_attribute_option, $variation_attribute_name);
            $term_name = $term->name;
            $term_slug = $term->slug;
            $active_term_slug = isset($_GET['attribute_' . $variation_attribute_name]) ? $_GET['attribute_' . $variation_attribute_name] : $product->get_default_attributes()[$variation_attribute_name];
            $term_thumbnail_url = wp_get_attachment_image_url(get_term_meta($term->term_id, 'term-thumbnail-id', true), 'thumbnail');
            echo '<li class="option' . ($term_slug == $active_term_slug ? ' option--active' : null) . '">';
              echo '<a href="' . StringHelpers::updateUrlParameters('attribute_' . $variation_attribute_name . '=' . $variation_attribute_option) . '">';
                echo '<picture class="picture-image">';
                  echo '<img class="picture" src="' . $term_thumbnail_url . '" alt="' . $term_name . '" />';
                echo '</picture>';
              echo '</a>';
            echo '</li>';
          }
        echo '</ul>';
      echo '</div>';
      break;
      case 'select':
        $options = get_post_meta($variation->get_id(), 'variation_' . $variation_attribute_name . '_ids', true);
        if ($options) {
          $option_ids = explode(",", $options);
          echo '<div class="singleProduct__variationSelect">';
            echo '<div class="description">';
              echo '<div class="subtitle">' . wc_attribute_label($variation_attribute_name) . '</div>';
              $active_style = get_term_by('slug', $variation->get_attributes()[$variation_attribute_name], $variation_attribute_name);
              echo '<div class="title">' . $active_style->name . '</div>';
            echo '</div>';
            echo '<div class="popup">';
              echo '<div class="popup-overlay"></div>';
              echo '<div class="popup-content">';
                echo '<div class="popup-header">';
                  echo '<div class="h3">' . wc_attribute_label($variation_attribute_name) . '</div>';
                  echo '<button class="icon icon-close" type="button">';
                    echo '<img src="' . get_theme_file_uri('/assets/images/x.svg') . '" alt="' . __('Close', 'swift') . '">';
                  echo '</button>';
                echo '</div>';
                echo '<div class="products">';
                  foreach ($option_ids as $option_id) {
                    $popup_item = wc_get_product($option_id);
                    echo '<div class="' . ($variation->get_id() == $popup_item->get_id() ? 'product is-selected' : 'product') . '">';
                      echo '<div class="product">';
                        echo '<a class="product__link" href="'. $popup_item->get_permalink() . '">';
                          echo '<div class="product__picture">';
                            echo '<img class="product__pictureImage" src="' . wp_get_attachment_image_url($popup_item->get_image_id(), 'thumbnail') . '" alt="' . $popup_item->get_description() . '">';
                          echo '</div>';
                        echo '</a>';
                        if ($variation->get_id() == $popup_item->get_id()) {
                          echo '<div class="icon icon-checked">' . file_get_contents(get_stylesheet_directory_uri() . '/assets/images/checkmark-circle.svg') . '</div>';
                        }
                          echo '<div class="product__content">';
                            $popup_item_attributes = $popup_item->get_attributes();
                            $option_value = get_term_by('slug', $popup_item_attributes[$variation_attribute_name], $variation_attribute_name);
                            echo '<a class="product__title" href="' . $popup_item->get_permalink() . '">' . $option_value->name . '</a>';
                            echo '<div class="product__price">';
                              if ($popup_item->is_on_sale()) {
                                echo '<span class="product__priceAmount">' . strip_tags(wc_price($popup_item->get_regular_price())) . '</span>';
                                echo '<span class="product__priceAmount -sale">' . strip_tags(wc_price($popup_item->get_sale_price())) . '</span>';
                              } else {
                                echo '<span class="product__priceAmount">' . strip_tags(wc_price($popup_item->get_regular_price())) . '</span>';
                              }
                            echo '</div>';
                          echo '</div>';
                      echo '</div>';
                    echo '</div>';
                  }
                echo '</div>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        };
        break;
      }
    }