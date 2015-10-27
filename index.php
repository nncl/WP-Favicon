<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>WP Infinite Scroll</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <?php wp_head(); ?>
  </head>
  <body>
    <?php
      $ca_favicon = get_option('ca_favicon');
    ?>

    <?php $options = get_option('plugin_options'); ?>
    <img src="<?php echo $options['logo']; ?>" alt="Logo" />

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>
