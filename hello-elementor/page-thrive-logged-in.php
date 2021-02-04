<?php

/**
 * Template Name: Thrive Logged In
 */

  get_header();

  session_start();

  if( array_key_exists( 'id', $_COOKIE)) {

    $_SESSION[ 'id'] = $_COOKIE[ 'id'];

  }

  if( array_key_exists( 'id', $_SESSION)) {

    echo "<p>Logged In! <a href='login?logout=1'>Log out</a></p>";

  } else {
    header( "Location: login");
  }

 
    $votes = get_post_meta($post->ID, "votes", true);
    $votes = ($votes == "") ? 0 : $votes;
?>

    This post has <div id='vote_counter'><?php echo $votes; ?> votes</div><br>

<?php 

    $nonce = wp_create_nonce("my_user_vote_nonce");
    $link = admin_url('admin-ajax.php?action=my_user_vote&post_id='.$post->ID.'&nonce='.$nonce);
    echo '<a class="user_vote" data-nonce="'.$nonce.'" data-post_id="'.$post->ID.'" href="'.$link.'">vote for this article</a>';

?>

