jQuery(document).ready(function($) { 

	$('#example').DataTable();

	$(document).on("click",'.approve_user', function(){

		var user_id = $(this).data('userid');
		var current_obj = $(this);
		bootbox.confirm({
		    title: "Are you sure to create user ?",
		    message: "This user will be created as subsciber",
		    buttons: {
		        cancel: {
		            label: '<i class="fa fa-times"></i> Cancel'
		        },
		        confirm: {
		            label: '<i class="fa fa-check"></i> Approve'
		        }
		    },
		    callback: function (result) {	        
		      
	          var form_data = new FormData();                  
	          form_data.append('user_id',user_id); 
	          form_data.append('action', 'sunny_create_wordpress_user');
	          form_data.append('_sunny_ajax_nonce', sunny_ajax_object._sunny_ajax_nonce);
		    $.ajax({
	            method: "POST",
	            url: sunny_ajax_object.ajax_url,
	            processData: false,
	            contentType: false,
	            data:form_data,
	            beforeSend: function() {
	              current_obj.attr('disabled',true);
	            },
	            success: function (response) {
	                if(response.success==true){
	                	bootbox.alert("User Created Successfully");
	                	current_obj.closest("tr").remove();
	                }else{
	                	bootbox.alert("Error while creating user !");
	                }
	            },
	            complete: function() {
	              current_obj.attr('disabled',false);
	            }
	          });


		    }
		});

	});	

});