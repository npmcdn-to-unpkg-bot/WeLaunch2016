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
<!-- <div class="lg-hero" style="background-image: url('<?php //the_field('hero_img'); ?>');">
	<div class="lg-hero__overlay">
		<h1><?php //the_field('hero_header'); ?></h1>
	</div>
</div> -->
<main class="container">
	<section class="clearfix" id="contact-main">
		<div class="row">
			<div class="contact-main__block">
				<div class="contact-main__content">
					<h3>Where We Are</h3>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

	<section id="contact-info">
		<div class="row">
			<div class="contact-info__block eq-height">
				<div class="contact-info__content">
					<?php the_field('say_hello_copy'); ?>
					<p><a href="http://www.twitter.com/welaunch" target="_blank" class="fa fa-twitter"></a><a href="http://www.facebook.com/welaunch.co.uk" target="_blank" class="fa fa-facebook"></a><a href="http://www.instagram.com/welaunch" target="_blank" class="fa fa-instagram"></a></p>
				</div>
			</div>
			<div class="contact-map__wrapper">
				<iframe id="contact-map" class="eq-height" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.4449576302623!2d-0.1418344839403428!3d51.52339817963782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d4bf959f1f%3A0x9b1d82a50226feb2!2sWe+Launch!5e0!3m2!1sen!2suk!4v1457004981924" width="100%" height="462" frameborder="0" style="border:0;margin-bottom:-6px;" allowfullscreen></iframe>
			</div>
		</div><!-- end row -->
	</section>

	<section class="clearfix" id="contact-form">
		<div class="lg-pad-y">
			<div class="row">
				<div class="contact-form__wrapper">
					<h3 class="section-title">Start Your Project</h3>
					<?php echo do_shortcode('[contact-form-7 id="2470" title="Contact"]'); ?>
				</div>
			</div>
		</div>
	</section>

</main>



<?php
get_footer();
