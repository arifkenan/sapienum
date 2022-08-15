<div class="click_to_see" id="click_to_see"><i class="fa fa-bars"></i> <div id="click_to_change">More</div>
</div>
<div id="topicbar_sapienum">
<?php 
if(isset($_POST['comment']))
{
?>
<div class="col-md-6 col-sm-6 col-xs-6 leftheadin leftOne active">
<span onclick="get_post_order_single('a');">Last</span>
</div>

<div class="col-md-6 col-sm-6 col-xs-6 leftheadin rightOne">
<span onclick="get_post_order_single('d');">Top</span>
</div>
<?php 
}
else{
?>
<div class="col-md-6 col-sm-6 col-xs-6 leftheadin leftOne ">
<span onclick="get_post_order_single('a');">Last</span>
</div>

<div class="col-md-6 col-sm-6 col-xs-6 leftheadin rightOne active">
<span onclick="get_post_order_single('d');">Top</span>
</div>
<?php } ?>

<div class="sidebar_left">
<ul class="post_list_data scrollbar" id="post_list_data1">
<?php

$order = $_POST['order'];
    if ($order == 'a') {
        $orderby = "ASC";
        session_start();
        $_SESSION['POST_ORDER'] = 'ASC';
        //$session_val=
    } else if ($order == 'd') {
        $orderby = "DESC";
        $_SESSION['POST_ORDER'] = $orderby;
    }
     //$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 0;
     $page = (isset($_POST['page_num'])) ? $_POST['page_num'] : 1;

    //  $args=array(
    //     'post_type' => 'post',        
    //     'orderby' => $_SESSION['POST_ORDER'],        
    //     'paged' => $page,
    //     'posts_per_page'=> '8',
    // );

     $args=array(
        'post_type' => 'post',        
        'orderby' => array('comment_count' => $_SESSION['POST_ORDER']), 
        'paged' => $page,
        'posts_per_page'=> '20',
    );

query_posts($args);

    ?>
    
    <?php while (have_posts()): the_post();?>
        <li class="wow rotateInDownRight">
            <a href="<?php the_permalink()?>"> <span><?php the_title();?></span> </a><sub> <?php $comments_count = wp_count_comments(get_the_ID()); echo $comments_count->total_comments; ?></sub>       </li>
    <?php endwhile;?>   
    <?php wp_reset_query();?>
</ul>
    <div class="select_order_box">

        <?php
         $perpage=20; 
 $args1=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
     $query = new WP_Query($args1);
     $count = $query->post_count;

     $pages = ceil($count / $perpage);
        ?>

    <select id="post_page_selection" name="post_page_selection" class="post_page_selection">
    <?php for($i=1;$i<=$pages;$i++){ ?>

    <option value="<?php echo $i ?>"><?php echo $i; ?></option>
    <?php }?>
</select><div class="total_num_pages select_page_box2">/<?php echo $pages; ?></div>
</div>
</div>
<?php 
if(isset($_POST['comment']))
{
?>
<input type="hidden" name="post_orderby" id="post_orderby" value="a">
<?php 
}
else{
    ?>
    <input type="hidden" name="post_orderby" id="post_orderby" value="d">
    <?php 
}
?>
</div>