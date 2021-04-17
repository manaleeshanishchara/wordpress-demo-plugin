jQuery(document).ready(function($) { 
    $(document).on("click",'#sunny_save_data', function(){

        /*From Validation Start*/

        var su_first_name = $("input#su_first_name").val();
        var su_last_name = $("input#su_last_name").val();
        var su_email = $("input#su_email").val();
        var su_password = $("input#su_password").val();
        var su_confirm_password = $("input#su_confirm_password").val();
        var file_data = $('#su_user_image').prop('files')[0]; 
        
        var re_email =  /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        
        var error_text = '';

        
        if( su_first_name == ""  || su_first_name == null ){
          error_text = "Please Enter First Name";
        }else if( su_last_name == ""  || su_last_name == null ){
          error_text = "Please Enter Last Name";
        }else if( su_email == ""  || su_email == null ){
          error_text = "Please Enter Valid Email";
        }else if( su_confirm_password == ""  || su_confirm_password == null ){
          error_text = "Please Enter First Name";
        }else if( su_password.length < 6 || su_confirm_password.length < 6 ){
          error_text = "Minimun length of password is 6";
        }else if ( su_password != su_confirm_password ){
          error_text = "Password and confirm password must match";
        }/*else if(file_data == undefined){
            error_text = "Plese Enter file";
        }else if(!allowedExtensions.exec(file_data)) { 
            alert('Invalid file type'); 
            file_data.value = ''; 
            error_text = "Please Enter valid file";
        }*/
        
        /*From Validation End*/

        //console.log(error_text);
        if( error_text == "" ){
          var current_obj = $(this);
          var file_data = $('#su_user_image').prop('files')[0];   
          var form_data = new FormData();                  
          form_data.append('file', file_data);
          form_data.append('data',$("#sunny_form_data").serialize());        

          form_data.append('action', 'sunny_author_form_data');
          form_data.append('_sunny_ajax_nonce', sunny_ajax_object._sunny_ajax_nonce);

          $.ajax({
            method: "POST",
            url: sunny_ajax_object.ajax_url,
            processData: false,
            contentType: false,
            data:form_data,
            beforeSend: function() {
              $(".sunny_spinner").removeClass('d-none');
              current_obj.attr('disabled',true);
            },
            success: function (response) {
                  if(response.success){
                    $("#status_block").html("<div class='alert alert-success'>"+response.data+"</div>").css('color',' #008000');
                  }else{
                    $("#status_block").html("<div class='alert alert-danger'>"+response.data+"</div>").css('color',"#800000");
                  }
            },
            complete: function() {
              $(".sunny_spinner").addClass('d-none');
              current_obj.attr('disabled',false);
            }
          }); 



        }else{
          $("#status_block").html("<div class='alert alert-danger'>"+error_text+"</div>");
        }


                 
    });
});