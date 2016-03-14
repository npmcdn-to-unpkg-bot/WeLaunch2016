<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Name
 */

get_header(); ?>
<div class="pad-y text-center" id="title">
	<h1>About Us</h1>
	<div class="short-divider"></div>
	<p></p>
</div>
<!-- <img src="http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg" class="img-responsive"> -->
<!-- <section class="container pad-y">
	<h2>Lorem Ipsum</h2>
	<p class="lead">We’re structured to enable you to access the most experienced teams and talent at a fraction of the cost of traditional, lumbering, big-overhead agencies. We’re lean and nimble; quick to react and quick to create. And we pride ourselves on delivering to brief. To budget. To time.</p>

	<p class="lead">We ask the right questions. We develop deep understanding. We share your ambitions of who and where you want to be. And create long-term partnerships long after the initial work is delivered.</p>
</section> -->
<!-- <img src="http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg" class="img-responsive">
<img src="http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg" class="img-responsive" style="width:50%;float: left;margin-top:5px;">
<img src="http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg" class="img-responsive" style="width:50%;float:left;margin-top:5px;">
<section class="container pad-y" style="clear:both;">
	<h2>Team</h2>
	<p class="lead">You choose people that will enhance your business. So do we.</strong></p>

	<p class="lead">With over 50 years combined experience in launching multi-channel brands across all sectors, we bring together the very best designers, directors, writers, strategists, photographers, illustrators and moving image makers to make it happen in the best possible ways – combining insight and creativity with an inherent understanding of the real world.</p>

	<p class="lead">We love what we do and how we do it. Our best work comes when we’re able to share a passion for a subject matter with a client – a united goal that bears fruit with our close partnership approach. We appreciate that your knowledge of your industry is as valuable to the finished result as our ability to deliver stunning and engaging work.</p>
</section> -->

<?php if( get_field('features') ): ?>
	<?php while(has_sub_field('features')): ?>
	
	<section class="container pad-y">
		<h2><?php the_sub_field('title'); ?></h2>
		<?php the_sub_field('copy'); ?>
	</section>
	<img src="<?php the_sub_field('full_image'); ?>" class="img-responsive">

	<?php endwhile; ?>
<?php endif; ?>











<?php
get_footer();
