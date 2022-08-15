<div id="right-slide-bar">

<div class="postList">
   
    <ul>
        <?php query_posts(array( 
            'post_type' => 'post',
                    //'showposts' => 6 ,
            'post_status'=>'publish',
            ) ); 
            ?>
            <?php while (have_posts()) : the_post(); ?>

                <li class="wow rotateInDownRight">
                    <a href="<?php the_permalink() ?>">
                        <span><?php the_title(); ?></span>
                    </a>
                    <sub>
                    <?php $comments_count=wp_count_comments( get_the_ID() ); 
                    echo $comments_count->total_comments;
                    ?></sub>
                </li>

            <?php endwhile; wp_reset_query(); ?>
        </ul>
    </div>
</div>
