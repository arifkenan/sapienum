<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.2
 */

?>
<script type="text/javascript">
jQuery(document).ready(function () {
	jQuery('.mobile_nav').click(function(){
		jQuery('.leftSidebar ul').slideToggle();
	})
})	
function myFunction(x) {
    x.classList.toggle("fa-thumbs-down");
}

jQuery('.cld-like-dislike-trigger').click(function () {
    jQuery('body').addClass('wait');
    var ajax_flag = 0;
    if (ajax_flag == 0) {
    var restriction = jQuery(this).data('restriction');
    var trigger_type = jQuery(this).data('trigger-type');
    var comment_id = jQuery(this).data('comment-id');
    var selector = jQuery(this);
    var ajaxurl   = "<?php echo admin_url('admin-ajax.php'); ?>";

    
    var user_ip = jQuery(this).data('user-ip');
    var ip_check = jQuery(this).data('ip-check');
    var like_dislike_flag = 1;

    if (restriction == 'ip' && ip_check == '1') {
        like_dislike_flag = 0;
        
    }
    if (like_dislike_flag == 1) {
    jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                comment_id: comment_id,type:trigger_type,user_ip:user_ip,
                action: 'cld_comment_ajax_action'
            },
            beforeSend: function (xhr) {
                ajax_flag = 1;
            },
            success: function (res) {
                jQuery('body').removeClass('wait');
                ajax_flag = 0;
                res = jQuery.parseJSON(res);
                if (res.success) {
                    var latest_count = res.latest_count;
                    selector.closest('.cld-common-wrap').find('.cld-count-wrap').html(latest_count);
                }
            }

        })

    return false;
   }
  }
  jQuery('.cld-like-dislike-wrap br,.cld-like-dislike-wrap p').remove();
 });

</script>


<?php wp_footer(); ?>

</body>
</html>
