<?php

add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {
	//create new top-level menu
	add_menu_page('PA Configurações', 'Petit Andy Configurações', 'administrator', __FILE__, 'petit_settings_page', get_template_directory_uri() . '/assets/img/petitconfig.jpg');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
  register_setting('plugin_options', 'plugin_options', 'validate_setting');
  add_settings_field('logo', 'Logo:', 'logo_setting', __FILE__, 'main_section'); // LOGO
}

function petit_settings_page() { ?>
  <div class="wrap">
    <h2>Configurations</h2>

    <form method="post" action="options.php" enctype="multipart/form-data">
        <?php settings_fields( 'plugin_options' ); ?>

        <h3>Blog</h3>

        <table class="form-table">
          <tr valign="top">
            <th scope="row">Favicon</th>
            <td>
              <input type="file" name="logo" />
              <?php
                $has_image = get_option('plugin_options');
                if (!(empty($has_image))) {
                  echo "Has image";
                } else {
                  echo "Has not any image here";
                }
              ?>
            </td>
          </tr>
        </table>

        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e('Salvar') ?>" />
        </p>

    </form>
  </div>
<?php }

function validate_setting($plugin_options) {
  $keys = array_keys($_FILES);
  $i = 0; foreach ( $_FILES as $image ) {
    // if a files was upload
    if ($image['size']) {
      // if it is an image
      if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
        $override = array('test_form' => false);
        // save the file, and store an array, containing its location in $file
        $file = wp_handle_upload( $image, $override );
        $plugin_options[$keys[$i]] = $file['url'];
      } else {
        // Not an image.
        $options = get_option('plugin_options');
        $plugin_options[$keys[$i]] = $options[$logo];
        // Die and let the user know that they made a mistake.
        wp_die('No image was uploaded.');
      }
    }   // Else, the user didn't upload a file.
    // Retain the image that's already on file.
    else {
      $options = get_option('plugin_options');
      $plugin_options[$keys[$i]] = $options[$keys[$i]];
    }
    $i++;
  }
  return $plugin_options;
}

?>
