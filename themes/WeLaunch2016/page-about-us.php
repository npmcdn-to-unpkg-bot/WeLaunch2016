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
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="pad">
					<h3>About Us</h3>
					<div class="about-us-content">
						<?php the_field('about_us'); ?>
					</div>
				</div>
			</div>
			<!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="<?php //the_field('about_us_img'); ?>" class="img-responsive pull-right" id="feature-two-up">
			</div> -->
		</div>
	</section>
	<section class="clearfix sr" id="about-us-team">
		<div class="no-gutter">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<aside style="background-image:url('<?php the_field('team_img'); ?>');" class="img-block eq-height"></aside>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="content-block eq-height">
					<div class="pad">
						<h3>Our Team</h3>
						<?php the_field('team_copy'); ?>
					</div>
				</div>
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


	<section class="clearfix pad" id="testimonials" style="background-image:url('<?php echo content_url(); ?>/uploads/2016/04/sayagata-400px.png');">
		<div class="text-center"><h3>What They Say</h3></div>
		<?php $posts = get_field('testimonials');
		if( $posts ): ?>
		<div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
		    <div class="carousel-inner" role="listbox">
				<?php $i = 0; ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>
					<div class="item <?php if($i === 0) { ?> active <?php } ?>">
						<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2" >
							<img src="<?php the_field('image'); ?>" class="img-wrap img-responsive">
							<blockquote><?php the_field('quote'); ?></blockquote>
							<p class="testimonial-name"><strong><?php the_field('name'); ?></strong> - <?php the_field('position_company'); ?></p>
						</article>
					</div>
				<?php ++$i; endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			</div>
		</div>
		<?php  endif; ?>
	</section>

</main>
<?php
get_footer();
