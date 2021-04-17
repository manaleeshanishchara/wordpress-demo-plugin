<?php 

/*Save Form using AJAX*/
add_action( 'wp_ajax_nopriv_sunny_create_wordpress_user', 'sunny_create_wordpress_user' );
add_action( 'wp_ajax_sunny_create_wordpress_user', 'sunny_create_wordpress_user' );

if(!function_exists('sunny_create_wordpress_user')){

	function sunny_create_wordpress_user() {
		
		$nonce = $_POST['_sunny_ajax_nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'sunny_form_nonce' ) ){
	  		wp_die('No Cheating!');
		}
	
		global $wpdb;
		$ID = sanitize_text_field($_POST['user_id']);
		$query = "SELECT * FROM ".$wpdb->prefix."temp_user WHERE id=".$ID;
		$row = $wpdb->get_row($query,ARRAY_A);		


		$userdata = array();
		$userdata['user_login'] = $row['email'];
		$userdata['user_pass'] = base64_decode($row['password']);
		$userdata['first_name'] = $row['first_name'];
		$userdata['last_name'] = $row['last_name'];
 		
 		$user = wp_insert_user( $userdata ); 		
 		if(empty($user->errors)){
 			$user_insert['image'] = $post_data['su_first_name'];
 			$update['status'] = 1;
 			$where['id'] = $ID;
	 		$wpdb->update($wpdb->prefix."temp_user",$update,$where);
 			wp_send_json_success( 'User Created Successfully!' );
 		}else{
			wp_send_json_error("Error!");
 		}
 		

	}
}

/*End Save Form using AJAX*/
