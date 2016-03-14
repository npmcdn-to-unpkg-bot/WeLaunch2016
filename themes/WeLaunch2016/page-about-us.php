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

	<div class="hero-lg" id="" style="background-image: url('http://localhost/WeLaunch/wp-content/uploads/2016/01/about-us.jpg');">
		<div class="hero-lg__overlay">
			<em><?php the_title(); ?></em>
			<h1>We Work With People, Brands and Organisations That Inspire Us</h1>
		</div>
	</div>
<main id="about-us" class="container">
	<section class="clearfix sr">
		<div class="no-gutter">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
				<div class="pad-lg">
					<h3>About Us</h3>
					<?php the_field('about_us'); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="<?php the_field('about_us_img'); ?>" class="img-responsive pull-right" id="feature-two-up">
			</div>
		</div>
	</section>
	<section class="sr" id="about-us-clients">
		<div class="clearfix pad">

			<div class="text-center">
				<h2>Who we've worked with</h2>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
				<?php
				$posts = get_field('clients');
				if( $posts ): ?>
				    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        <?php setup_postdata($post); ?>
				        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
							<a href="<?php the_permalink(); ?>">
								<?php //the_post_thumbnail('full', array( 'class'	=> 'img-responsive')); ?>
								<img src="<?php the_field('logo'); ?>" class="img-responsive client-logo">
							</a>
						</div>
				    <?php endforeach; ?>
				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php  endif; ?>
			</div> <!-- end col -->

		</div>
	</section>
	<section class="clearfix sr" id="feature-two-up">
		<div class="no-gutter">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 white-bg pull-right">
				<div class="pad">
					<h3>Our Team</h3>
					<?php the_field('team_copy'); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="<?php the_field('team_img'); ?>" class="img-responsive" id="feature-two-up">
			</div>
		</div>
	</section>

	<section class="clearfix pad" id="testimonials">
		<?php
		$posts = get_field('testimonials');
		if( $posts ): ?>
		<div class="text-center">
			<h3>What They Say</h3>
		</div>
			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
				<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4 testimonial-panel" >
					<img src="<?php the_field('image'); ?>" class="img-wrap img-responsive">
					<blockquote><?php the_field('quote'); ?></blockquote>
					<p class="testimonial-name"><strong><?php the_field('name'); ?></strong> - <?php the_field('position_company'); ?></p>
				</article>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php  endif; ?>
	</section>

</main>
<?php
get_footer();
