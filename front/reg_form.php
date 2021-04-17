<?php 
/* User Registration Process */

if(!function_exists('sunny_guest_user_registration_form_shortcode')){
	function sunny_guest_user_registration_form_shortcode(){

			/*Execute on Front Only*/
			if(is_admin()){
				return;
			}

			$content = "";

			$content .='<div class="container guest_form">';


		 	$content .='<form id="sunny_form_data">';

		 	//firstname
		    $content .='<div class="form-group required">';
	        $content .='<label for="guest-post-title">First Name: </label>';
			$content .='<input type="text" name="su_first_name" class="form-control" id="su_first_name" placeholder="First Name" required>';
			$content .='</div>';

			//lastname
			$content .='<div class="form-group required">';
	        $content .='<label for="guest-post-title">Last Name: </label>';
			$content .='<input type="text" name="su_last_name" class="form-control" id="su_last_name" placeholder="Last Name" required>';
			$content .='</div>';
			
			//email
			$content .='<div class="form-group required">';
	        $content .='<label for="guest-post-title">Email: </label>';
			$content .='<input type="email" name="su_email" class="form-control" id="su_email" placeholder="Email" required>';
			$content .='</div>';

			//password
			$content .='<div class="form-group required">';
	        $content .='<label for="guest-post-title">Password: </label>';
			$content .='<input type="password" name="su_password" class="form-control" id="su_password" placeholder="Password" required>';
			$content .='</div>';

			//confirm_password
			$content .='<div class="form-group required">';
	        $content .='<label for="guest-post-title">Confirm Password: </label>';
			$content .='<input type="password" name="su_confirm_password" class="form-control" id="su_confirm_password" placeholder="Confirm Password" required>';
			$content .='</div>';

			$content .='<div class="form-group">';
			$content .='<label for="feacture_image">Featured Image</label>';
			$content .='<input type="file" multiple="false" class="form-control-file" name="su_user_image" id="su_user_image">';
			$content .='</div>';

			$content .= '<div id="status_block"></div>';
			$content .='<button type="button" class="btn btn-lg btn-danger" id="sunny_save_data">Save Post</button>';
			$content .= '<div class="spinner-border text-warning d-none gpsp_spinner" role="status"> <span class="sr-only">Loading...</span> </div>';

			$content .='</form>';
			$content .='</div>';

			return $content;
	}
}

add_shortcode(SU_USER_SHORTCODE,'sunny_guest_user_registration_form_shortcode');

/* End User Registration Process */