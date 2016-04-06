<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Name
 */

get_header(); ?>
<?php if( get_field('blog_hero') ) { ?>
	<div class="hero-lg" id="blog-hero" style="background-image: url('<?php the_field('blog_hero'); ?>');">
<?php } else { ?>
	<div class="hero-lg" id="blog-hero" style="background-image: url('<?php echo content_url(); ?>/uploads/2016/03/WeLaunch_Background_news.png');">
<?php } ?>
</div>
<main class="container">
	<div class="row">
		<section class="clearfix" id="blog-content">
			<a href="<?php echo home_url('/news'); ?>" class="blog-bk-tag">Back to Blog</a>
			<div class="text-center">
				<h1><?php the_title(); ?></h1>
				<p class="small"><strong><?php name_posted_on(); ?></strong></p>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
				<?php the_post_thumbnail(); ?>
				<?php the_content(); ?>
				<div class="text-center">
					<div class="addthis_sharing_toolbox"></div>
				</div>
			</div>
		</section>
	</div>
</main>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56cc87cc7ac60ce4"></script>
<?php
get_footer();
