<?php
/**
 *   Template Name: Thrive Form
 */


ob_start();
get_header(); 
$user_id = get_current_user_id();
$existing_first_name = ( get_user_meta( $user_id, 'first-name', true)) ? get_user_meta( $user_id, 'first-name', true) : '';
$existing_last_name = ( get_user_meta( $user_id, 'last-name', true)) ? get_user_meta( $user_id, 'last-name', true) : '';
$existing_phone_number = ( get_user_meta( $user_id, 'phone-number', true)) ? get_user_meta( $user_id, 'phone-number', true) : '';
?>

<style>
form {
    margin: auto;
    padding-top: 100px;
    width: 200px;
}
</style>

<form action="" method="post">
    <label for="fname"> First Name: 
        <input type="text" id="fname" name="fname" value='<?php echo $existing_first_name; ?>' >
    </label> <br> <br>
    <label for="lname"> Last Name:
        <input type="text" id="lname" name="lname" value='<?php echo $existing_last_name; ?>' >
    </label> <br> <br>
    <label for="phone"> Phone Number: 
        <input type="text" id="phone" name="phone" value='<?php echo $existing_phone_number; ?>' >
    </label><br> <br>
    <input type="submit" name="submit" value="Submit">
</form>
<?php



// check to see if a function by that name already exists this is done to prevent conflicts
if ( ! function_exists( 'wf_insert_update_user_meta' ) ) {
    function wf_insert_update_user_meta( $user_id, $meta_key, $meta_value ) {
        // if the meta key does not exist then create it
        $meta_key_not_exists = add_user_meta( $user_id, $meta_key, $meta_value, true );

        // if meta key already exists then update the values
        if ( ! $meta_key_not_exists ) {
            update_user_meta( $user_id, $meta_key, $meta_value );
            return true;
        }
    }
} 

// if ( isset( $_POST['submit'])) {
//     // creating variables and sanitizing data for each piece of information submitted by the user.
//     $first_name = ( ! empty( $_POST['fname'] ) ) ? sanitize_text_field( $_POST['fname']) : '';
//     $last_name = ( ! empty( $_POST['lname'] ) ) ? sanitize_text_field( $_POST['lname']) : '';
//     $phone_number = ( ! empty( $_POST['phone'] ) ) ? sanitize_text_field( $_POST['phone']) : '';

//     wf_insert_update_user_meta( $user_id, 'first-name', $first_name);
//     wf_insert_update_user_meta( $user_id, 'last-name', $last_name);
//     wf_insert_update_user_meta( $user_id, 'phone-number', $phone_number);

//     $location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     wp_safe_redirect( $location );
//     exit;    
// }

$table_name = $wpdb->prefix."thrive_tenants";

if ( isset( $_POST['submit'])) {
    // creating variables and sanitizing data for each piece of information submitted by the user.
    $first_name = ( ! empty( $_POST['fname'] ) ) ? sanitize_text_field( $_POST['fname']) : '';
    $last_name = ( ! empty( $_POST['lname'] ) ) ? sanitize_text_field( $_POST['lname']) : '';
    $phone_number = ( ! empty( $_POST['phone'] ) ) ? sanitize_text_field( $_POST['phone']) : '';

    $wpdb->insert(
        $table_name, 
        array(
            'firstName' => $first_name,
            'lastName' => $last_name,
            'phoneNumber' => $phone_number,
            ),
            array(
                '%s',
                '%s',
                '%s',
            )
    );

    $location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    wp_safe_redirect( $location );
    exit;    
}



// echo '<pre>';
// print_r( $wpdb );

?>