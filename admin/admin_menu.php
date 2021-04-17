<?php 

if (!defined('ABSPATH')) {
	exit;
}

/** Step 2 (from text above). */
add_action( 'admin_menu', 'sunny_plugin_menu' );

/** Step 1. */
function sunny_plugin_menu() {
	add_menu_page( 'Su Users', 'Su Users', 'manage_options', 'su-custom-users', 'sunny_plugin_options' );
}

/** Step 3. */
function sunny_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	global $wpdb;
	$query = "SELECT * FROM ".$wpdb->prefix."temp_user WHERE status=0";
	$results = $wpdb->get_results($query,ARRAY_A);

	?>
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>Sr. No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Image</th>
				<th>Timestamp</th>
				<th>Approve</th>
			</tr>
		</thead>
		<tbody>

	<?php
	if(!empty($results)){
		$i = 1;
		foreach ($results as $key => $value) {
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $value['first_name']; ?></td>
				<td><?php echo $value['last_name']; ?></td>
				<td><?php echo $value['email']; ?></td>
				<td>
					<?php 
					$url = wp_get_attachment_url($value['image']);
					if(!empty($url)){
						?>
						<img src="<?php echo $url; ?>" class="img-fluid2"  alt="IMAGE"/> 
						<?php
					}
					?>
					
				</td>
				<td><?php echo $value['timestamp']; ?></td>				
				<td><button data-userid="<?php echo $value['id']; ?>" class="btn btn-success approve_user">Approve</button></td>
			</tr>
			<?php
			$i++;
		}
		
	}

	?>

	</tbody>
	</table>
	<?php

}

