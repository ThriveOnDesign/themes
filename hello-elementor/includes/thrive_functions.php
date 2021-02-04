<?php


  
/**
 * Step 1: Pass Nonce & Ajax URL via localized script
 * Step 2 is in the JavaScript file
 */
function thrive_front_end_scripts() {
    wp_enqueue_script( 'thrive_js', get_template_directory_uri().'/assets/js/thrive-javascript.js', array( 'jquery' ), '', true );

    wp_localize_script( 'thrive_js', 'myAjaxObj', array(
      'ajax_url'  => admin_url( 'admin-ajax.php' ),
      // 'nonce'  => wp_create_nonce( 'nonce_name' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'thrive_front_end_scripts' );


/**
 * Step 3: Hook PHP Ajax function into WordPress Ajax hook
 * 
 * The data from the JavaScript is being passed back to here and now we can do something with it
 */

add_action( 'wp_ajax_my_ajax_hook', 'do_something');

function do_something( ) {
  // check_ajax_referer( 'nonce_name' );

  // Sanatize the text
  //   $reading47Rm1 = ( ! empty( $_POST['47Rm1'])) ? sanitize_text_field( $_POST['47Rm1'] ) : '';
  $saniReading = ( ! empty( $_POST['reading'])) ? sanitize_text_field( $_POST['reading']) : '';
  $electricityLogTable = $wpdb->prefix.'thrive_electricity_logs';

  // check if "reading array key exists on $_POST then write to database.
  
     $wpdb->insert(
      $electricityLogTable,
      array(
        'timestamp' => current_time('mysql'),
        'room' => '47Rm1',
        'reading' => $saniReading,
      ),
      array(
        '%s',
        '%s',
        '%f',
      )
    );
  
  // if ( array_key_exists ( 'reading', $_POST )){
  //    $wpdb->insert(
  //     $electricityLogTable,
  //     array(
  //       'timestamp' => current_time('mysql'),
  //       'room' => '47Rm1',
  //       'reading' => $saniReading,
  //     ),
  //     array(
  //       '%s',
  //       '%s',
  //       '%f',
  //     )
  //   );
  // };


  wp_send_json_success( array(
    "Marco" => "Polo"
  ));
}

?>