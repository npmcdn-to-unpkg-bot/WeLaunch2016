<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Name
 */

get_header(); ?>

<main class="container" id="single-service__digtal">
	<section class="clearfix sr">
		<div class="row">
			<div class="single-service__2up eq-height">
				<div class="single-service__content">
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
			</div><!--end 2up-->
		</div>
	</section>

	<section class="clearfix sr">
		<div class="no-gutter">
			<div class="single-service__2up">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/wl_digital-1.jpg" >
			</div>
			<div class="single-service__2up">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/wl_digital-2.jpg">
			</div>
		</div>
	</section>

	<section id="single-service__features">
		<div class="row">
			<article class="single-service__3up">
				<img src="http://placehold.it/75x75" class="center-block">
				<h4>Web Design & Development</h4>
				<p>We focus on mobile-first and responsive web platforms, designed & built to the highest standard by our in-house team. We use the latest CMS and eCommerce platforms for a high-performance, hassle-free web experience.</p>
			</article>
			<article class="single-service__3up">
				<img src="http://placehold.it/75x75" class="center-block">
				<h4>Social & Email Marketing</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam luctus, eros nec porta aliquet, augue arcu finibus odio, ut cursus augue felis quis magna. Maecenas a lobortis dolor. Nulla facilisi. </p>
			</article>
			<article class="single-service__3up">
				<img src="http://placehold.it/75x75" class="center-block">
				<h4>SEO & Analytics</h4>
				<p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam luctus, eros nec porta aliquet, augue arcu finibus odio, ut cursus augue felis quis magna. Maecenas a lobortis dolor. Nulla facilisi.</p>
			</article>
		</div><!-- end row -->
	</section>

	<section id="service-related">
		<div class="text-center pad-y">
			<h3 class="section-title">Related Case Studies</h3>
		</div>
		<?php $posts = get_field('service_casestudies'); ?>
		<?php if( $posts ): ?>
		<div class="clearfix">
		<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
			<a class="folio-item" href="<?php the_permalink(); ?>">
				<div class="folio-item__inner" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>"></div>
			</a>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post article so the rest of the page works correctly ?>
		</div>
		<?php endif; ?>
	</section>

</main>

<?php
get_footer();
