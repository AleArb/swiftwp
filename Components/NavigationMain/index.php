<site-component name="NavigationMain">
  <div class="container">
    <a href="#"><?php echo __('Up to 70% sitewide sale', 'swift'); ?></a>
  </div>
</site-component>
<site-component name="headerMain">
  <div class="container">
    <?php
      wp_nav_menu(array(
        'theme_location' => 'primary_menu',
      ));
    ?>
    <a class="logo" href="<?php echo home_url(); ?>">
      <img class="logo-image" width="183" height="20" src="<?php echo get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : get_theme_file_uri('/assets/images/logo.svg'); ?>" fetchpriority="high" alt="<?php echo get_bloginfo('name'); ?>">
    </a>
    <ul class="actions">
      <li class="item">
        <img class="search-image" src="<?php echo get_theme_file_uri('/assets/images/search.svg'); ?>" width="20" height="20" fetchpriority="high" alt="Search">
      </li>
      <li class="item">
        <img class="wishlist-image" src="<?php echo get_theme_file_uri('/assets/images/wishlist.svg'); ?>" width="20" height="20" fetchpriority="high" alt="Wishlist">
      </li>
      <li class="item">
        <img class="cart-image" src="<?php echo get_theme_file_uri('/assets/images/cart.svg'); ?>" width="20" height="20" fetchpriority="high" alt="Cart">
      </li>
    </ul>
  </div>
</site-component>