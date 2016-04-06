<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Name
 */

get_header(); ?>

<div class="hero-lg" style="background-image: url('http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg');">
	<div class="hero-lg__overlay">
		<h1><?php the_title(); ?></h1>
	</div>
</div>
<main class="container">
	<section class="clearfix sr">
		<div class="no-gutter">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
				<div class="pad">
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="http://placehold.it/600x384" class="img-responsive pull-right" id="feature-two-up">
			</div>
		</div>
	</section>

	<?php $posts = get_field('service_casestudies'); ?>
	<?php if( $posts ): ?>
	<div class="row">
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		<?php setup_postdata($post); ?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				<a href="<?php the_permalink(); ?>">
					<div class="folio-item" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');">
						<div class="folio-item-overlay">
							<h4><?php the_title(); ?></h4>
							<p>
								<?php echo wp_trim_words( get_field('short_description'), 20, '...' ); ?>
							</p>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	</div>
	<?php endif; ?>

	<?php if( get_field('service_highlights') ): ?>
	<section class="clearfix sr">
		<div class="pad">
			<div class="service-features">
				<?php while( have_rows('service_highlights') ): the_row(); ?>
				<object><p class="lead"><strong><?php the_sub_field('feature'); ?></strong></p></object>
			<?php endwhile; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="clearfix sr">
		<div class="no-gutter">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="http://placehold.it/600x384" class="img-responsive pull-right" id="feature-two-up">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<img src="http://placehold.it/600x384" class="img-responsive pull-right" id="feature-two-up">
			</div>
		</div>
	</section>

</main>






<?php
get_footer();
