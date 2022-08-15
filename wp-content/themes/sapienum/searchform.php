<?php
/**
 * Template for displaying search forms in Sapienum
 *
 * @package WordPress
 * @subpackage sapienum
 * @since 1.0
 * @version 1.0
 */

?>

<?php $unique_id = esc_attr(uniqid('search-form-'));?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<!-- <label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php //echo _x( 'Search for:', 'label', 'sapienum' ); ?></span>
	</label> -->
	<div class="form-group">
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="Title, #entry @username" value="<?php echo get_search_query(); ?>" name="s" />
	</div>
	<button type="submit" class="search-submit"><?php echo sapienum_get_svg(array('icon' => 'search')); ?><span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'sapienum'); ?></span></button>
</form>
