<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Name
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<section class="tumblr-wrap">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<div class="text-center">
		<a href="http://welaunch.tumblr.com" target="_blank" class="btn btn-primary">View Tumblr</a>
	</div>
</section>
<div class="twitter-wrap">
	<h2>Twitter</h2>
	<?php echo do_shortcode('[statictweets skin="default" resource="usertimeline" user="welaunch" list="" query="" count="5" retweets="on" replies="on" show="username,screenname,avatar,time,actions,media"/] '); ?>
</div>
