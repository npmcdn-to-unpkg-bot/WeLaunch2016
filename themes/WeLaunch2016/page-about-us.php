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

<div class="lg-hero" id="" style="background-image: url('<?php echo content_url(); ?>/uploads/2016/01/about-us.jpg');">
	<div class="lg-hero__overlay">
		<h1>We Work With People, Brands and Organisations That Inspire Us</h1>
	</div>
</div>

<main id="about-us" class="container">
	<section class="clearfix sr">
			<div class="about-us__content">
				<h3>About Us</h3>
				<?php the_field('about_us'); ?>
			</div>
		</div>
	</section>
	<section class="clearfix sr" id="about-us-team">
		<div class="no-gutter">
			<aside style="background-image:url('<?php the_field('team_img'); ?>');" class="img-block eq-height"></aside>
				<div class="about-us-team__block eq-height">
					<div class="about-us-team__content">
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

			<div class="row">
				<?php
				$posts = get_field('clients');
				if( $posts ): ?>
				    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        <?php setup_postdata($post); ?>
				        <div class="client-logo__wrap">
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
