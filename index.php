<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="page-header">
    <?php get_template_part('templates/header'); ?>
  </header>
  <main class="page-content">
    <?php get_template_part('templates/content'); ?>
  </main>
  <footer class="page-footer">
    <?php get_template_part('templates/footer'); ?>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
