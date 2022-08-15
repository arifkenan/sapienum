<?php
/*
 * Template name: Registration
 */

get_header();?>


<section class="middleContent login-register">
    <div class="container newcont">
        <div class="leftSidebar">
         <?php get_template_part('template-parts/sidebar/left-navigation');?>
        </div>

        <div class="rightSec">
        <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
            <div class="middleSec">
                <div class="register">
                    <h2>New User Registration</h2>
                     <form method="post" id="rsUserRegistration">
                        <input type="hidden" name="action" value="user_registration">
                        <?php
// if(isset($_SERVER['HTTP_REFERER']))
// {
$http_reffer = home_url('my-account');
//}
?>
                        <input type="hidden" name="http_reffer" value="<?php echo $http_reffer; ?>">
                        <div id="messageResponse" class="alert-box"></div>
                        <?php
// to make our script safe, it's a best practice to use nonce on our form to check things out
if (function_exists('wp_nonce_field')) {
    wp_nonce_field('rs_user_registration_action', 'rs_user_registration_nonce');
}

?>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" name="date" id="user_dob" class="user_dob" />
                        </div>
                        <div class="form-group formRadio">
                            <label>Gender</label>
                            <p>
                                <input type="radio" id="woman" value="1" name="radio-choice" >
                                <label for="woman"><i>Woman</i></label>
                            </p>
                            <p>
                                <input type="radio" id="male" value="2"  name="radio-choice" checked>
                                <label for="male"><i>Male</i></label>
                            </p>


                        </div>
                        <div class="form-group details">
                            <p>
                                <!-- <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/p-img.png" alt="p-img"> -->
                                we recommend that your <strong>password is different from the passwords</strong> you <strong>use on other sites in </strong>terms of your account security .
                            </p>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="user_password" id="user_password">
                            <!-- <div class="optionPass">
                                <p><small>at least 1 lower case</small></p>
                                <p><small>at least 1 upper case</small></p>
                                <p><small>at least 1 digit</small></p>
                                <p><small>at least 8 characters</small></p>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Confirm Password (again)</label>
                            <input type="password" class="form-control" name="user_confrm_password" id="user_confrm_password">

                        </div>


                             <div class="form-group">
                            <input type="checkbox" id="privacy_policy" name="privacy_policy">
                            <label for="privacy_policy">I have read the <a href="<?php echo site_url('terms-of-use'); ?>">regular terms of use</a></label>
                            </div>


                        <div class="form-group">
                            <input type="submit" value="Register Here" id="submit" class="btn btnInviaFull btnLogin">
                        </div>
                    </form>

                </div>

            </div>
            <script type="text/javascript">

            jQuery(document).ready(function($) {

                jQuery('.user_dob').datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-80:+0", // this is the option you're looking for
                });

                jQuery.validator.addMethod(
        "validDOB",
        function(value, element) {
            var from = value.split("-"); // DD MM YYYY
            // var from = value.split("/"); // DD/MM/YYY
            var day = from[0];
            var month = from[1];
            var year = from[2];
            var age = 18;
            var mydate = new Date();
            mydate.setFullYear(year, month-1, day);
            var currdate = new Date();
            var setDate = new Date();
            setDate.setFullYear(mydate.getFullYear() + age, month-1, day);
            if ((currdate - setDate) > 0){
                 //console.log(value);
                return true;
            }else{
                return false;
            }
        },
        //"Sorry, you must be 18 years of age to apply"
    );
 jQuery.validator.addMethod("user_password_check",function(value,element){
return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/i.test(value);
},"Passwords are 8-16 characters with uppercase letters, lowercase letters and at least one number.");



            });

            </script>

            <?php get_footer();
