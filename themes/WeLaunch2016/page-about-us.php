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

<div class="lg-hero" id="" style="background-image: url('<?php the_field('hero_img', 183); ?>');">
	<div class="lg-hero__overlay">
		<!-- <h1>We work with people, brands and organisations that inspire us</h1> -->
		<h1><?php the_field('hero_header', 183); ?></h1>
	</div>
</div>

<main id="about-us" class="container">
	<section class="clearfix sr">
			<div class="about-us__content">
				<h3>About Us</h3>
				<?php the_field('about_us'); ?>
			</div>
			<div class="about-us__content" style="padding:0;">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/row1_welaunch_aboutus.jpg">
			</div>
		</div>
	</section>
	<section class="clearfix sr" id="about-us-team">
		<div class="no-gutter">
			<!-- <aside style="background-image:url('<?php //the_field('team_img'); ?>');" class="img-block eq-height"></aside> -->
			<aside class="aside-img__carousel eq-height">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/row2_welaunch_aboutus.jpg">
				</aside>
				<div class="about-us-team__block eq-height">
					<div class="about-us-team__content">
						<h3>Our Team</h3>
						<?php the_field('team_copy'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="clearfix sr">
			<div class="about-us__content">
				<h3>Join Us</h3>
				<p>We know that it takes the best people to create truly inspiring, stand-out brands and communications. That’s why we’re always looking to meet new people that can work with us to bring our projects to life in the best possible ways. If you have a passion for delivering unique, relevant and distinctive solutions that work in the real world, then we’d love to hear from you.</p>												
				<p><strong><a href="<?php echo home_url(); ?>/contact">Drop us a line</a> with your CV and some examples of work and we’ll get back to you as soon as we can.</strong></p>
			</div>
			<div class="about-us__content" style="padding:0;">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/row3_welaunch_aboutus.jpg">
			</div>
		</div>
	</section>

	<section class="sr" id="about-us-clients">
		<div class="clearfix pad">

			<div class="text-center">
				<h2>Clients we work with</h2>
			</div>

			<div class="row">
				<?php
				$posts = get_field('clients');
				if( $posts ): ?>
				    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        <?php setup_postdata($post); ?>
				        <div class="client-logo__wrap">
							<article>
								<?php //the_post_thumbnail('full', array( 'class'	=> 'img-responsive')); ?>
								<img src="<?php the_field('logo'); ?>" class="img-responsive client-logo">
							</article>
						</div>
				    <?php endforeach; ?>
				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php  endif; ?>
			</div> <!-- end col -->

		</div>
	</section>


	<section class="clearfix pad" id="testimonials" style="background-image:url('<?php echo content_url(); ?>/uploads/2016/04/sayagata-400px.png');">
		<div class="text-center"><h2>What They Say</h2></div>
		<?php $posts = get_field('testimonials');
		if( $posts ): ?>
		<div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
		    <div class="carousel-inner" role="listbox">
				<?php $i = 0; ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>
					<div class="item <?php if($i === 0) { ?> active <?php } ?>">
						<article class="testimonial-item__wrap" >
							<div class="testimonial-item__content">
								<blockquote><?php the_field('quote'); ?></blockquote>
								<p class="testimonial-name"><strong><?php the_field('name'); ?></strong> - <?php the_field('position_company'); ?></p>
							</div>
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
