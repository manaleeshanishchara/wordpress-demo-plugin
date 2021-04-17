<?php
/* Add CSS/JS on front side */

if(!function_exists('sunny_custom_style_and_css')){
	function sunny_custom_style_and_css($hook) {
		wp_register_script('front-custom-js',plugins_url('js/front-custom.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('front-custom-js');
		wp_localize_script('front-custom-js', 'sunny_ajax_object',array(
			'_sunny_ajax_nonce' => wp_create_nonce('sunny_form_nonce'),
		    'ajax_url' => admin_url('admin-ajax.php'),	    
		));
		
	}
}
add_action('wp_enqueue_scripts', 'sunny_custom_style_and_css');

/* End CSS/JS on front side */