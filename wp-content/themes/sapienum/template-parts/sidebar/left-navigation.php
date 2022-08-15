<div class="click_to_see" id="click_to_see"><i class="fa fa-bars"></i> <div id="click_to_change">More</div>
<input type="hidden" name="text_toggle" value="Less" id="text_toggle">
</div>
<div id="topicbar_sapienum">
<div class="col-md-6 col-sm-6 col-xs-6 leftheadin leftOne">
<span onclick="get_post_order('a');">Last</span>
</div>

<div class="col-md-6 col-sm-6 col-xs-6 leftheadin rightOne active">
<span onclick="get_post_order('d');">Top</span>
</div>

<div class="sidebar_left">
    <?php
    $perpage=20;

    $args=array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
     $query = new WP_Query($args);
     $count = $query->post_count;
     $pages = ceil($count / $perpage);
     //print_r($query);
    ?>
    <ul class="post_list_data scrollbar list-group" id="post_list_data">

    </ul>
    <div class="select_order_box">

    <select id="post_page_selection" name="post_page_selection" class="post_page_selection">
    <?php for($i=1;$i<=$pages;$i++){ ?>

    <option value="<?php echo $i ?>"><?php echo $i; ?></option>
    <?php }?>
</select><div class="total_num_pages select_page_box2">/<?php echo $pages; ?></div>
</div>
</div>
<?php session_start();?>
<input type="hidden" name="post_orderby" id="post_orderby" value="d">
</div>