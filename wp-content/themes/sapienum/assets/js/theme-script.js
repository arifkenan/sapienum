jQuery(document).ready(function($) {
    $( "#tabs_pm" ).tabs();
    
    $('#loading_img').show();
    var order = $('#post_orderby').val();
    var page_id = $('#current_sapienum_post_id').val();
    var page_num= jQuery("#post_page_selection").val();

    //console.log(order);
    jQuery.ajax({
    type: "post",
    url: theme_ajax.url,
    data: {action:'fetch_post_sapienum', order:order, page_id:page_id, page_num:page_num},
    success: function (data) {
        jQuery('#post_list_data, #post_list_data1').html(data);
        $('#loading_img').hide();
        //$("#loader-img").hide();
    }
    });
    // $(".loadmore_post").click(function(){

    //     $('#loading_img').show();
        
    //    var page_number = $('#pageNumber').val();
    //    var ppp = $('#ppp').val();

    //     var order = $('#post_orderby').val();
    //     $("#pageNumber").val(parseInt(page_number)+1);
    //      $("#ppp").val(parseInt(ppp)+2);
    //     jQuery.ajax({
    // type: "post",
    // url: theme_ajax.url,
    // data: {action:'fetch_post_sapienum', order:order, page_num:page_number, ppp:ppp},
    // success: function (data) {
    //     $('#post_list_data').append(data);
        
    //     $('#loading_img').hide();
    // }
    // });


    // });

    jQuery("#post_page_selection").change(function() {
            var page_num= jQuery("#post_page_selection").val();
            var order = $('#post_orderby').val();
            jQuery.ajax({
            type: "post",
            url: theme_ajax.url,
            data: {action:'fetch_post_sapienum', order:order, page_num:page_num},
            success: function (data) {
            $('#post_list_data, #post_list_data1').html(data);

            $('#loading_img').hide();
            }
            });
        });


    /*Login user screen*/
    var redirect_page_url= $('form#rsUserLoginform #redirect_page_url').val(); 
            $('#rsUserLoginform').validate({ // initialize the plugin
        rules: {         
            username: {
                required: true,                
            },            
              password: {
        required: true,
      }
        },
        messages: {     
      username: {
        required: "Please enter a email address",
      },      
      password: {
        required: "Please enter a password"
      }
    },
        submitHandler: function (form) {
            // console.log($(form).serialize());
            // console.log(theme_ajax.url);
            $.ajax({            
                type: "post",                
                url: theme_ajax.url,
                dataType: 'json',
                data: $(form).serialize(),
                success: function (data) {
                    if (data.loggedin == true){
                    $('form#rsUserLoginform p.status').text(data.message);
                    console.log(redirect_page_url);
                    document.location.href = redirect_page_url;

                }
                else{
                     $('form#rsUserLoginform p.status').html('<span style="color:red;">'+data.message+'</span>');
                }
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });
    /*user registration user screen*/
    $('#rsUserRegistration').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email:true,
            },
            user_dob: {
                required: true,
                validDOB: true,
               
            },
              user_password: {
        required: true,      
        user_password_check: true,
      },
      user_confrm_password: {
        required: true,
        minlength: 6,
        alphanumeric: true,
        equalTo: "#user_password",
      },
      privacy_policy:{
        required: true,
      },
        },
        messages: {
      name: "Please enter your name",
      email: {
        required: "Please enter a email address",
        minlength: "Please enter a valid email address"
      },
      user_dob: {
         required: "Please enter date of birth",
        validDOB: "Sorry, you must be 18 years of age to apply"        
      },
      user_password: {
        required: "Please enter a password",
        minlength: "Your password must be at least 5 characters long",
        alphanumeric: "Password must be alphanumeric"
      },
      user_confrm_password: {
        required: "Please enter a confirm password ",
        minlength: "Your confirm password must be at least 5 characters long",
        equalTo:"Password and confirm password are not same",
        alphanumeric: "Confirm Password must be alphanumeric"
      }
    },
        submitHandler: function (form) {
            // console.log($(form).serialize());
            // console.log(theme_ajax.url);
            $.ajax({            
                type: "post",            
                action : "user_registration",
                url: theme_ajax.url,
                data: $(form).serialize(),
                success: function (responseData) {
                    $('#messageResponse').html(responseData);

                },
                error: function (responseData) {
                    console.log('Ajax request not recieved!');
                }
            });
            return false; // blocks redirect after submission via ajax
        }
    });

});

    function get_post_order_single(order){
        if(order=='a'){
            jQuery('.leftOne').addClass('active');
            jQuery('.rightOne').removeClass('active');
        }
        else{
            jQuery('.leftOne').removeClass('active');
            jQuery('.rightOne').addClass('active');
        }        
        jQuery.ajax({
            type: "post",
            url: theme_ajax.url,
            data: {action:'fetch_post_sapienum', order:order},
            success: function (data) {
                jQuery('#post_list_data1').html(data);
            }
        });
    }
    function get_post_order(order){
        jQuery("#pageNumber").val(2);
        jQuery("#ppp").val(4);
        jQuery('#loading_img').show();
        if(order=='a'){
            jQuery('.leftOne').addClass('active');
            jQuery('.rightOne').removeClass('active');
        }
        else{
            jQuery('.leftOne').removeClass('active');
            jQuery('.rightOne').addClass('active');
        }
        jQuery.ajax({
            type: "post",
            url: theme_ajax.url,
            data: {action:'fetch_post_sapienum', order:order},
            success: function (data) {
                jQuery('#post_list_data').html(data);
                jQuery('#loading_img').hide();
                
            }
        });

    }
    function submitmessage(){
        var userid = $('#to_email_ID').val();
        var refersh_url= theme_ajax.site_url+'/'+'private-message/?pm-action=new_message&pm_recipient='+userid;
        //console.log(refersh_url);

        var comment_text = document.getElementById('comment_value').value;
        if(comment_text==""){
        $('#msg').show();
          return false;
        }
        $('#msg').show();
        //
        jQuery.ajax({
            type: "post",
            url: theme_ajax.url,
            data: $('#message_form').serialize(),
            success: function (data) {
                document.location.href = refersh_url;
                $('#message_html').html(data);
                $('#msg').hide();
                $('#message_form')[0].reset();
            }
        });
      return true;
    }
    function ConfirmDelete(DeleteID){
        var x = confirm("Are you sure you want to delete?");
          if(x){
            jQuery.ajax({
                type: "POST",
                url: theme_ajax.url,
                data: { action:'comment_delete_action', DeleteID: DeleteID },
            }).done(function( result ) {
                alert("Topic deleted successfully");
                location.reload();
            });
        } else {
             return false;
        }
    }
    function change_color(col){
        if ( col == 'red'){
            document.getElementById("text_comment").style.color = '#f00'; 
        }
        if ( col == 'green'){
            document.getElementById("text_comment").style.color = '#0f0'; 
        }
        if ( col == 'yellow'){
            document.getElementById("text_comment").style.color = '#ffff00'; 
        }
        if ( col == 'white'){
            document.getElementById("text_comment").style.color = '#fff'; 
        }
    }


jQuery(document).ready(function($){
    $("#click_to_see").click(function(){
        $("#topicbar_sapienum").toggle();
        //$("#click_to_change").html("Less");
    }).toggle(function() {
        $('#click_to_change').text('Less');
        //console.log("show");
    }, function() {
        $('#click_to_change').text('More');
        //console.log("hide");
    }); 
});





