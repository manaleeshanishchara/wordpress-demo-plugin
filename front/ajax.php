<?php 

/*Save Form using AJAX*/
add_action( 'wp_ajax_nopriv_sunny_author_form_data', 'sunny_author_form_data' );
add_action( 'wp_ajax_sunny_author_form_data', 'sunny_author_form_data' );

if(!function_exists('sunny_author_form_data')){

	function sunny_author_form_data() {
		
		$nonce = $_POST['_sunny_ajax_nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'sunny_form_nonce' ) ){
	  		wp_die('No Cheating!');
		}	

		parse_str($_POST['data'],$post_data);
		

		global $wpdb;

		$user_insert = array();
		$user_insert['first_name'] = sanitize_text_field($post_data['su_first_name']);
		$user_insert['last_name'] = sanitize_text_field($post_data['su_last_name']);
		$user_insert['email'] = sanitize_email($post_data['su_email']);
		$user_insert['password'] = base64_encode($post_data['su_password']);
		
		$query = "SELECT * FROM ".$wpdb->prefix."temp_user WHERE email='".$user_insert['email']."'";
		$row = $wpdb->get_row($query,ARRAY_A);

		if(username_exists($user_insert['email'])||!empty($row)){
			wp_send_json_error("Email Already Exists. Please Enter Different Email!");
		}

		$uploadedfile = $_FILES['file'];

		if(!empty($uploadedfile)){

		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}			 
		 
		$upload_overrides = array(
		    'test_form' => false
		);
		 
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		
		if(empty($movefile['error'])){

			$filename = $movefile['file']; 
			// The ID of the post this attachment is for.
			//$parent_post_id = $post_insert_id;		 
			// Check the type of file. We'll use this as the 'post_mime_type'.
			$filetype = wp_check_filetype( basename( $filename ), null );		 
			// Get the path to the upload directory.
			$wp_upload_dir = wp_upload_dir();

			// Prepare an array of post data for the attachment.
			$attachment = array(
			    'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
			    'post_mime_type' => $filetype['type'],
			    'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			    'post_content'   => '',
			    'post_status'    => 'inherit'
			);
			 
			// Insert the attachment.
			$attach_id = wp_insert_attachment( $attachment, $filename );
			 
			// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			 
			// Generate the metadata for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			 
			$user_insert['image'] = $attach_id;
			
		}

	}

		if($wpdb->insert($wpdb->prefix."temp_user",$user_insert)){
			wp_send_json_success("User Added Succesfully Please wait for the admin approval!");
		}else{
			wp_send_json_error("Error!");
		}


		
	}
}

/*End Save Form using AJAX*/
