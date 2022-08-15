<?php
/*
 * Template name: Message
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
					<h2>mesajlar</h2>
					<ul class="messageList">
						<li>
							<p>
								fenerbahçe'nin gençleştirme operasyonunun ilk ayağı olan 29 yaşındaki futbolcu.
								<span>göndermek: 09/04/2017 <strong>tarih: <a href="#"> user name</a></strong></span>
							</p>
						</li>
						<li>
							<p>
								fenerbahçe'nin gençleştirme operasyonunun ilk ayağı olan 29 yaşındaki futbolcu.
								<span>göndermek: 09/04/2017 <strong>tarih: <a href="#"> user name</a></strong></span>
							</p>
						</li>
						<li>
							<p>
								fenerbahçe'nin gençleştirme operasyonunun ilk ayağı olan 29 yaşındaki futbolcu.
								<span>göndermek: 09/04/2017 <strong>tarih: <a href="#"> user name</a></strong></span>
							</p>
						</li>
						<li>
							<p>
								fenerbahçe'nin gençleştirme operasyonunun ilk ayağı olan 29 yaşındaki futbolcu.
								<span>göndermek: 09/04/2017 <strong>tarih: <a href="#"> user name</a></strong></span>
							</p>
						</li>
					</ul>
					<form class="messageForm">
						<div class="form-group">
							<textarea class="form-control" placeholder="Enter your message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" class="btnSub" value="mesaj">
						</div>
					</form>
				</div>
			</div>
			<div class="GoogleAddSec">
				<figure>
					<?php 
					$image = get_field('add_image', 'option');
					if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</figure>
			
		</div>

		<?php get_footer();
