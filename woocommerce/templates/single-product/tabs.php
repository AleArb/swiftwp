<?php
defined('ABSPATH') || exit;

echo '<div class="single-product__tabs">';
    echo '<div class="container">';
        wc_get_template_part('templates/single-product/description');
        wc_get_template_part('templates/single-product/details');
    echo '</div>';
echo '</div>';