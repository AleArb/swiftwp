<?php
defined('ABSPATH') || exit;

$menu_locations = get_nav_menu_locations();
$footer_menu_1 = wp_get_nav_menu_object($menu_locations['footer_menu_1']);
$footer_menu_2 = wp_get_nav_menu_object($menu_locations['footer_menu_2']);
$footer_menu_3 = wp_get_nav_menu_object($menu_locations['footer_menu_3']);

// $menu_1_items = wp_get_nav_menu_items($menu_locations['footer_menu_1']);
// print_r($menu_1_items);

?>

<site-component name="footerMain">
  <div class="container">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'footer_menu_1',
    ));
    wp_nav_menu(array(
      'theme_location' => 'footer_menu_2',
    ));
    wp_nav_menu(array(
      'theme_location' => 'footer_menu_3',
    ));
    ?>
    <nav class="socials">
      <ul class="items">
        <li class="item">
          <a href="https://www.instagram.com/skandisofa/" target="_blank">
            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/assets/images/instagram.svg'); ?>
          </a>
        </li>
        <li class="item">
          <a href="https://www.facebook.com/profile.php?id=61560762485628" target="_blank">
            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/assets/images/facebook.svg'); ?>
          </a>
        </li>
        <li class="item">
          <a href="https://www.pinterest.co.uk/skandisofa/" target="_blank">
            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/assets/images/pinterest.svg'); ?>
          </a>
        </li>
        <li class="item">
          <a href="https://www.linkedin.com/company/104671639/admin/page-posts/published/" target="_blank">
            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/assets/images/linkedin.svg'); ?>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</site-component>
<site-component name="footerBottom">
  <div class="container">
    <div class="question"><?php echo __('All rights reserved © 2024 Skandi & Sofa', 'swift'); ?></div>
    <?php
    wp_nav_menu(array(
      'theme_location' => 'legal',
    ));
    ?>
  </div>
</site-component>