<?php

/**
 * Template Name: Thrive electricity log
 */

get_header();

$electricityLogTable = $wpdb->prefix.'thrive_electricity_logs';

/**
 * Dynamically get the page url so that I don't have to hardcode 
 * the path and keep on changing it when switching from developer
 * to production environment
 */
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 

/**
 * get the data that was passed from JS and make the JSON readable for PHP
 */
$content = trim(file_get_contents('php://input'));
$decode = json_decode($content, true);

/**
 * Add each entry to the database. 
 * 
 * TODO: refactor this very verbose code with a loop 
 */
if (!empty($decode[0])) {
  
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

if (!empty($decode[1])) {
  
  $room = $decode[1]['room'];
  $userInput = $decode[1]['userInput'];
  
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

if (!empty($decode[2])) {
  
  $room = $decode[2]['room'];
  $userInput = $decode[2]['userInput'];
  
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

if (!empty($decode[3])) {
  
  $room = $decode[3]['room'];
  $userInput = $decode[3]['userInput'];
  
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

if (!empty($decode[4])) {
  
  $room = $decode[4]['room'];
  $userInput = $decode[4]['userInput'];
  
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

if (!empty($decode[5])) {
  
  $room = $decode[5]['room'];
  $userInput = $decode[5]['userInput'];
  
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

<script>
  /**
   * passing a php variable to JS
   */
  const phpLink = "<?php echo $link;?>";
</script>

<style>

  body{
    /* background-color: #24292e;
    color: #778899; */
  }
  .container {
    max-width: 400px;
    margin: auto;
    margin-top: 50px;
  }
  
  .hide {
    display: none !important;
  }

  form.thrive-elec-input {
    max-width: 400px;
    margin: auto;
    display: grid;
    grid-template-rows: 1fr 2fr;
    border-bottom: 0.5px solid #cecece;
  }

  label {
    align-self: center;
    margin-top: 20px;
    font-size: 18px;
  }

  input {
    margin: 10px 0 40px 0;
  }

  .input-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-gap: 20px;
  }

  .check-list {
    list-style-type: none;
    padding-left: 0;
  }

  .check-list > li {
    font-size: 18px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    margin-bottom: 10px;
    justify-items: center;
  }

  .check-list > li button {
    border: none;
  }

  .send-all {
    text-align: center;
  }

  .send-all p{
    font-size: 20px;
    font-weight: 600;
    margin: 30px 0;
    text-align: center;
  }

</style>

<div class="container">
  <div class="success-msg hide">Thank You! Electricity Readings have been successfully added to the database.</div>
  <ul class='check-list'></ul>
  <div  class="send-all hide">
  <p>Please check all readings before pressing submit below.</p>
  <button id="submit-php">Submit</button>
  </div>
  <form class="rm1-47-form" name="47 Rm1" autocomplete="off" >
    <label for="rmReading">47 Rm 1</label> 
    <div class="input-container">
      <input  type="number" name="rmReading" value=12 required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form>

  <form class="rm2-47-form" name="47 Rm2" autocomplete="off" >
    <label for="rmReading">47 Rm 2</label> 
    <div class="input-container">
      <input type="number" name="rmReading" value=34  required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form> 

  <form class="rm3-47-form" name="47 Rm3" autocomplete="off" >
    <label for="rmReading">47 Rm 3</label> 
    <div class="input-container">
      <input type="number" name="rmReading" value=56  required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form> 

  <form class="rm4-47-form" name="47 Rm4" autocomplete="off" >
    <label for="rmReading">47 Rm 4</label> 
    <div class="input-container">
      <input type="number" name="rmReading" value=78  required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form>

  <form class="rm5-47-form" name="47 Rm5" autocomplete="off" >
    <label for="rmReading">47 Rm 5</label> 
    <div class="input-container">
      <input type="number" name="rmReading" value=9  required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form>

  <form class="rm6-47-form" name="47 Rm6" autocomplete="off" >
    <label for="rmReading">47 Rm 6</label> 
    <div class="input-container">
      <input type="number" name="rmReading" value=10  required>
      <input type="submit" name="submit" value="Enter">
    </div>
  </form>

</div>

<?php

get_footer();

// echo '<pre>';
// var_dump($_POST);
?>

