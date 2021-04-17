<?php

function sunny_enqueuing_admin_scripts($hook){		
	/*echo "<h3 align='center'>".$hook."</h3>";*/ 
	if($hook == 'toplevel_page_su-custom-users'){
		wp_register_style('bootstrap_css',plugins_url('css/bootstrap.min.css',__DIR__));
		wp_enqueue_style('bootstrap_css');	

		wp_register_style('dataTables.bootstrap4.min',plugins_url('css/dataTables.bootstrap4.min.css',__DIR__));
		wp_enqueue_style('dataTables.bootstrap4.min');	

		wp_register_style('custom-css',plugins_url('css/custom.css',__DIR__));
		wp_enqueue_style('custom-css');	


		wp_register_script('bootstrap-jquery',plugins_url('js/bootstrap.min.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('bootstrap-jquery');

		wp_register_script('jquery.dataTables.min',plugins_url('js/jquery.dataTables.min.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('jquery.dataTables.min');

		wp_register_script('dataTables.bootstrap4.min',plugins_url('js/dataTables.bootstrap4.min.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('dataTables.bootstrap4.min');

		

		wp_register_script('bootbox-js',plugins_url('js/bootbox.min.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('bootbox-js');

		wp_register_script('admin-custom-js',plugins_url('js/admin-custom.js',__DIR__),array('jquery'), null, '');
		wp_enqueue_script('admin-custom-js');

		wp_localize_script('admin-custom-js', 'sunny_ajax_object',array(
			'_sunny_ajax_nonce' => wp_create_nonce('sunny_form_nonce'),
		    'ajax_url' => admin_url('admin-ajax.php'),	    
		));

	}
} 
add_action( 'admin_enqueue_scripts', 'sunny_enqueuing_admin_scripts' );