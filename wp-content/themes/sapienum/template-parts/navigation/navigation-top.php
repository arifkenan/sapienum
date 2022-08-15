<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.2
 */

?>



<?php wp_nav_menu( array(
    'theme_location' => 'main',
    'menu_id'        => 'main-menu',
    'menu_class' => 'dropdown-menu ajax_menu', // add classes for the dropdown
    'container'  => '', // don't wrap the menu in <div>
     'items_wrap' => my_nav_wrap(),
    ) ); 

function my_nav_wrap() {
  // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
  // open the <ul>, set 'menu_class' and 'menu_id' values
  $wrap  = '<ul id="%1$s" class="%2$s">';
  // get nav items as configured in /wp-admin/
  $wrap .= '%3$s';
  $wrap .= '</ul>';
  // return the result
  //return $wrap;
}


?>

<script type="text/javascript">
     jQuery(document).ready(function ($) {
        $(function () {
            $('#main-menu li a').click(function (e) {
                e.preventDefault();
                $('a').removeClass('active');
                $(this).addClass('active');
                $('#loader-img').show();
                var href = $('#main-menu li a.active').attr('href');
                console.log(href);
                var a1_text = $('#main-menu li a.active').text();
                $('.leftSidebar h1').html(a1_text);

                $.ajax({           
                type: "post",                
                url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",                
                data: {action:'fetch_category_post_sapienum', cat:href},
                success: function (data) {                   
                    $('#post_list_data').html(data);
                    //$("#loader-img").hide();
                }                
            });
            return false; // blocks redirect after submission via ajax
            });
        });
    });
</script>