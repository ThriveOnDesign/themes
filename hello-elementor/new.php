<?php

get_header();

$content = trim(file_get_contents('php://input'));
$decode = json_decode($content, true);



if (array_key_exists (0, $decode)) {
  print_r($decode[0]);
  $room = $decode[0]['room'];
  $userInput = $decode[0]['userInput'];

    $wpdb->insert(
      $electricityLogTable,
      array(
        'timestamp' => current_time('mysql'),
        'room' => $room,
        'reading' => $userInput,
      ),
      array(
        '%s',
        '%s',
        '%f',
      )
    );
  
}



?>