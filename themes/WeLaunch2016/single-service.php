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

	<?php if( have_rows('service_content') ): ?>
		<?php while( have_rows('service_content') ): the_row(); ?>


			<?php if ( get_sub_field('left_image')): ?>
				<section class="clearfix">
					<div class="single-service__2up">
						<img src="<?php the_sub_field('left_image'); ?>">
					</div>
			<?php endif; ?>
			<?php if ( get_sub_field('right_image')): ?>
					<div class="single-service__2up">
						<img src="<?php the_sub_field('right_image'); ?>">
					</div>
				</section>
			<?php endif; ?>

			<?php if( have_rows('3_icons_up') ): ?>
				<section id="single-service__features">
						<div class="row">
							<?php while( have_rows('3_icons_up') ): the_row(); ?>
								<article class="single-service__3up">
									<img src="<?php the_sub_field('icon'); ?>" class="center-block">
									<?php the_sub_field('desciption'); ?>
								</article>
							<?php endwhile; ?>
						</div>
				</section>
			<?php endif; ?>

			<?php if ( get_sub_field('wysiwyg')): ?>
				<?php the_sub_field('wysiwyg'); ?>
			<?php endif; ?>

		<?php endwhile; ?>
	<?php endif; ?>

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
