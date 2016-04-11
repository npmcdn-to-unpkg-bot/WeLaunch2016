<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Name
 */

get_header(); ?>

<div class="lg-hero" style="background-image: url('http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg');">
	<div class="lg-hero__overlay">
		<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h1>		
	</div>
</div>
<main class="container" id="single-service__digtal">
	<section class="clearfix sr">
		<div class="row">
			<div class="single-service__2up eq-height">
				<div class="single-service__content">
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
			</div>
			<div class="single-service__2up">
				<img src="http://placehold.it/600x388" class="img-responsive eq-height" id="feature-two-up">
			</div>
		</div>
	</section>

	<?php if( get_field('service_highlights') ): ?>
	<section class="service-features">
		<?php while( have_rows('service_highlights') ): the_row(); ?>
			<article><p class="lead"><strong><?php the_sub_field('feature'); ?></strong></p></article>
		<?php endwhile; ?>
	</section>
	<?php endif; ?>

	<section class="clearfix sr">
		<div class="no-gutter">
			<div class="single-service__2up">
				<img src="http://placehold.it/600x384" class="img-responsive pull-right" id="feature-two-up">
			</div>
			<div class="single-service__2up">
				<img src="http://placehold.it/600x384" class="img-responsive pull-right" id="feature-two-up">
			</div>
		</div>
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
			<a class="folio-item" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>">
				<div class="folio-item-overlay">
					<h4><?php the_title(); ?></h4>
					<p>
						<?php echo wp_trim_words( get_field('short_description'), 20, '...' ); ?>
					</p>
				</div>
			</a>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post article so the rest of the page works correctly ?>
		</div>
		<?php endif; ?>
	</section>

</main>






<?php
get_footer();
