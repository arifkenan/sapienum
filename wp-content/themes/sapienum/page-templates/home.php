<?php
/*
 * Template name: Home
 */

get_header(); 

    $liked_ips = get_comment_meta( $comment_id, 'cld_ips', true );
    $obj = new LikeDislike();
     $user_ip = $obj->get_user_IP();
    if ( empty( $liked_ips ) ) {
        $liked_ips = array();
    }
   $current_user = wp_get_current_user();
    // $this->print_array($liked_ips);
    $user_ip_check = (in_array( $user_ip, $liked_ips )) ? 1 : 0;



?>

<section class="middleContent">
	<div class="container newcont">
        <div class="leftSidebar">             
            <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>
		<div class="rightSec">
             <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
			<div class="middleSec">

                <?php 
                //$paged = get_query_var('paged');

                query_posts(array( 
            'post_type' => 'post',
                    //'showposts' => 6 ,
            'post_status'=>'publish'            
            ) ); 
            ?>
            <?php while (have_posts()) : the_post(); ?>
              
                <div class="commentBox">
                    <h2><a href="<?php the_permalink() ?>">
                        <?php the_title(); ?>
                    </a></h2>
                    <p><?php the_content(); ?>                       
                    </p>

                    <?php 
                    $title=urlencode(get_the_title());
                    $url=urlencode(get_the_permalink());
                    $summary=urlencode('');
                    $image=urlencode('');
                    $like_count = get_comment_meta(get_the_ID(),'cld_like_count',true);
                    $comment_id = get_the_ID();
                    $CheckPostCreated =  get_post(get_the_ID());
                    $CheckPostCreated->post_author;
                    
                    ?>
                    <div class="listDetail cld-like-wrap cld-common-wrap">
                        <ul class="socialLike">
                            <li>
                                <a onClick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://www.twitter.com/share?url=<?php echo $url; ?>" target="_blank" data-toggle="tooltip" ><i class="fa fa-twitter"></i></a>
                            </li>
                            <?php if(is_user_logged_in()){ ?>
                            <li>
                             <a href="javascript:void(0);" data-comment-id="<?php echo get_the_ID(); ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['cld_' . $comment_id] )) ? 'cld-prevent' : ''; ?> " data-restriction="ip" data-trigger-type="like" data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-up"></i></a>
                                <a href="javascript:void(0);" data-trigger-type="dislike" data-restriction="ip"  data-comment-id="<?php echo get_the_ID(); ?>" class="cld-like-trigger cld-like-dislike-trigger <?php echo ($user_ip_check == 1 || isset( $_COOKIE['cld_' . $comment_id] )) ? 'cld-prevent' : ''; ?> "  data-user-ip="<?php echo $user_ip; ?>" data-ip-check="<?php echo $user_ip_check; ?>"><i class="fa fa-chevron-down"></i></a>
                                 
                             <span class="cld-like-count-wrap cld-count-wrap"><?php echo (empty( $like_count )) ? 0 : number_format( $like_count ); ?></span>
                            </li>
                            </li>
                            <?php } ?>
                            
                        </ul>
                        <ul class="dateTime">
                            <li><?php echo get_the_date(); ?></li>                   
                            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></li>
                            <li>
                                <figure>
                                <div class="dropdown">
                                  <button class="dropbtn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/dot.png"  alt="dot" ></button>
                                  <div class="dropdown-content">
                                  <?php if($CheckPostCreated->post_author==$current_user->ID): ?>
                                    <a href="<?php echo get_permalink(202); ?>?topicid=<?php echo $comment_id; ?>">Correct</a>
                                   <?php endif  ?>
                                   <?php if($CheckPostCreated->post_author!=$current_user->ID): ?>
                                    <a href="<?php echo get_permalink(217); ?>?complaintID=<?php echo $comment_id; ?>">Complaint</a>
                                    <?php endif  ?>
                                    <?php if($CheckPostCreated->post_author==$current_user->ID): ?>
                                    <a href="javascript:void(0)" onclick="return ConfirmDelete('<?php echo get_the_ID(); ?>');">Delete</a>
                                    <?php endif  ?>
                                  </div>
                                </div>
                                </figure>
                                
                            </li>
                        </ul>
                    </div>

                </div>
            <?php
            endwhile; 
            //wp_reset_query(); 

            ?>
             <div class="nav">
                <?php 

                the_posts_pagination( array(
                    'prev_text' => sapienum_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'sapienum' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'sapienum' ) . '</span>' . sapienum_get_svg( array( 'icon' => 'arrow-right' ) ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'sapienum' ) . ' </span>',
                ) );
                ?>
                </div>

                   
        <div class="footer" >

        <?php wp_nav_menu( array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            ) ); ?>
        </div><!-- #colophon -->
			</div>
     
			<div class="GoogleAddSec">
				 <?php get_sidebar(); ?>
			</div>
        
            </div>
<style>
/* Style The Dropdown Button */
.dropbtn {
   /* background-color: #4CAF50;*/
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 50px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>

<script>
function ConfirmDelete(DeleteID)
{
 var x = confirm("Are you sure you want to delete?");
  if(x){
   var ajaxurl   = "<?php echo admin_url('admin-ajax.php'); ?>";
    jQuery.ajax({
        type: "POST",
        url : ajaxurl,
        data: { action:'custom_delete_action', DeleteID: DeleteID },
    }).done(function( result ) {
        alert("Topic deleted successfully");
        location.reload();
    });
} else {
     return false;
}
}
</script>  
<?php get_footer();
