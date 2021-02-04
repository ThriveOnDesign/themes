<?php

/**
 *  Template Name: Thrive Login
 */

 get_header();

 session_start();
 
 $error = "";

 if ( array_key_exists( "logout", $_GET)) {
    
    unset( $_SESSION);
    session_destroy ();
    setcookie( "id", "", time() - 60*60);
    $_COOKIE["id"] = "";
  
 } else if( array_key_exists( "id", $_SESSION) OR array_key_exists( "id", $_COOKIE) ) {

    header( "Location: loggedin");

 }

 if ( array_key_exists( "submit",  $_POST )) {
  $email = ( ! empty( $_POST['email'] ) ) ? sanitize_text_field( $_POST['email'] ) : '';
  $password = ( ! empty( $_POST['password'] ) ) ? sanitize_text_field( $_POST['password'] ) : '';
  $userTable = $wpdb->prefix.'thrive_users';
  

  $queryEmail = $wpdb->get_results ( "SELECT * from $userTable WHERE email = '$email'");
  
  
  if ( ! $_POST["email"]) {
    $error .= "An email address is required.<br>";
  }
  
  if ( ! $_POST["password"]) {
    $error .= "A password is required.<br>";
  }
  
  if ( $error != "") {
    $error = '<p>There were errors in your form:</p><br>'.$error;
  } else {
    $rowCount = $wpdb->get_var("SELECT COUNT(*) from $userTable where email = '$email'");
    if ( $rowCount > 0 ) {
      $error = "That email address already exists";
    } else {
      if( 

        $wpdb->insert(
          $userTable, 
          array(
            'email' => $email,
            'password' => $password,
          ),
          array(
            '%s',
            '%s',
            )
          )

      ) {
        $latestId = $wpdb->insert_id;
        $saltedPassword = md5(md5($latestId.$_POST['password']));
        
        $wpdb->update(
          $userTable,
          array(
            'password' => $saltedPassword,
          ),
          array(
            'id' => $latestId,
          )
        );

        $_SESSION[ 'id'] = $latestId;
        
        if( $_POST[ 'stayLoggedIn'] == '1') {

          setcookie( "id", $latestId, time() + 60*60*24*365 );

        }

        header( 'Location: loggedin');
        
      }


    }
  }


  
}

 ?>
  <style>
 
  </style>
  
  <div id="error"><?php echo $error; ?></div>

  <form action="" method="post">
      <input type="email" name="email" placeholder="Your Email">
      <input type="password" name="password" placeholder="Password">
      <input type="checkbox" name="stayLoggedIn" value=1 >
      <input type="submit" name="submit" value="Sign Up!">
  </form>


 <?php

  

  echo '<pre>';
  print_r($_GET);
  print_r($_POST);
?>