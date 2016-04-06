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

<div class="hero-lg" style="background-image: url('<?php the_field('hero_banner'); ?>');">
	<div class="hero-lg__overlay">
		<?php the_field('hero_copy'); ?>
	</div>
</div>

<main id="case-study" class="container">
	<section>
		<div class="row white-bg" id="casestudy-info">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
				<h3>The Brief</h3>
				<?php the_field('the_brief'); ?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-right">
				<h3>Industry Sectors</h3>
				<div class="sectors clearfix">
					<?php
					   $terms = get_the_terms($post->ID, "industry_sectors");
						if ( !empty( $terms ) && !is_wp_error( $term ) ){
							 foreach ( $terms as $term ) {
							   echo '<span><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></span>';

							}
						}
					?>
				</div>
			</div>
		</div>
	</section>

	<section id="casestudy-content">
		<?php if( have_rows('content') ): ?>

		<div class="row">
			<?php  while ( have_rows('content') ) : the_row(); ?>

			<?php if( get_sub_field('text_box') ): ?>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
					<div class="lg-pad">
						<?php the_sub_field('text_box'); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if( get_sub_field('full_image') ): ?>
				<div class="col-xs-12">
					<img src="<?php the_sub_field('full_image'); ?>" class="img-responsive">
				</div>
			<?php endif; ?>

			<?php if( get_sub_field('2col_left') ): ?>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<img src="<?php the_sub_field('2col_left'); ?>" class="img-responsive">
				</div>
			<?php endif; ?>

			<?php if( get_sub_field('2col_right') ): ?>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<img src="<?php the_sub_field('2col_right'); ?>" class="img-responsive">
				</div>
			<?php endif; ?>

			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</section>






	<?php //Get array of terms
	$terms = get_the_terms( $post->ID , 'industry_sectors', 'string');
	//Pluck out the IDs to get an array of IDS
	$term_ids = wp_list_pluck($terms,'term_id');

	//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
	//Chose 'AND' if you want to query for posts with all terms
	  $second_query = new WP_Query( array(
	      'post_type' => 'casestudy',
	      'tax_query' => array(
	                    array(
	                        'taxonomy' => 'industry_sectors',
	                        'field' => 'id',
	                        'terms' => $term_ids,
	                        'operator'=> 'IN' //Or 'AND' or 'NOT IN'
	                     )),
	      'posts_per_page' => 6,
	      'ignore_sticky_posts' => 1,
	      'orderby' => 'rand',
	      'post__not_in'=>array($post->ID)
	   ) ); ?>

	<section class="container-fluid grey">
		<div class="lg-pad-y text-center">
			<a class="section-title">Related Projects</a>
		</div>
		<div class="row">
	   <?php if($second_query->have_posts()) {
	     while ($second_query->have_posts() ) : $second_query->the_post(); ?>

		      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
		        <a href="<?php the_permalink(); ?>">
					<div class="folio-item" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');">
						<div class="folio-item-overlay">
							<h4>
								<?php the_title(); ?>
							</h4>
							<p style="color:white;">
								<?php echo wp_trim_words( get_field('short_description'), 25, '...' ); ?>
							</p>
						</div>
					</div>
				</a>
		    </div>
	   <?php endwhile; wp_reset_query();
	   } ?>
	   </div>
   </section>
</main>












<?php
get_footer();
