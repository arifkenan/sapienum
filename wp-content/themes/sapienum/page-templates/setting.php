<?php
/*
 * Template name: Setting
 */

get_header(); ?>

<section class="middleContent">
	<div class="container newcont">
        <div class="leftSidebar">
         <?php get_template_part( 'template-parts/sidebar/left-navigation');  ?>
        </div>

		<div class="rightSec">
        <div class="col-md-12 col-sm-12 col-xs-12 lefthead"><span>&nbsp;</span></div>
			<div class="middleSec">
				<div class="settingSec">
					<h2>Ayarlar</h2>
					<div class="form-group">
						<label>Şifre değiştir</label>
						<input type="text" class="form-control" placeholder="Yeni Şifre">
					</div>
					<div class="btnRow">
						<input type="submit" class="btnSub" value="Yeni Şifre">
					</div>
					<div lass="btnRow">
						<input type="submit" class="btnSub" value="Bu işlevle">
					</div>
				</div>
			</div>
			<div class="GoogleAddSec">
				<figure>
					<?php 
					$image = get_field('add_image');
					if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</figure>
		</div>

		<?php get_footer();
