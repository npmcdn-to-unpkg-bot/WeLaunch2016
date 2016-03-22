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
<div class="hero-lg" style="background-image: url('<?php the_field('hero_img'); ?>');">
	<div class="hero-lg__overlay">
		<h1><?php the_field('hero_header'); ?></h1>
	</div>
</div>
<main class="container">
	<section class="clearfix" id="contact-form">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="pad">
					<h2>Where We Are</h2>
					<p>Based on Fitzroy Square in the heart of London’s Fitzrovia, we’re only a three minute walk from Warren Street and Great Portland Street tube stations. Goodge Street tube is less then five minutes away with Tottenham Court Road and Oxford Circus tubes a ten minute walk. Pop in for a chat to see how we can help your business – grab a bite to eat from the restaurants on Charlotte Street or a coffee from the eclectic cafes on Warren Street and visit our salubrious studio.</p>
					<p><strong>By Tube</strong>: Warren Street, Goodge Street & Great Portland Street.</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="map-wrap">
				<iframe id="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.4449576302623!2d-0.1418344839403428!3d51.52339817963782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d4bf959f1f%3A0x9b1d82a50226feb2!2sWe+Launch!5e0!3m2!1sen!2suk!4v1457004981924" width="100%" height="462" frameborder="0" style="border:0;margin-bottom:-6px;" allowfullscreen></iframe>
			</div>
		</div>
	</section>



	<section class="clearfix" id="contact-info">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-right">
				<div class="pad">
					<h2>Say Hello</h2>
					<p>+44 (0)20 3714 0867</p>
					<p><a href="mailto:enquiries@welaunch.co.uk">enquiries@welaunch.co.uk</a></p>
					<p>Lower Ground Floor,</br> 5 Fitzroy Square,</br> London W1T 5HH</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="<?php echo content_url(); ?>/uploads/2016/03/wl-contact-hello.jpg" class="pull-right img-responsive" id="feature-two-up">
			</div>
		</div>
	</section>
</main>



<?php
get_footer();
