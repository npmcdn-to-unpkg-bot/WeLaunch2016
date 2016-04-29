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
<?php if ( get_field('hero_banner') ): ?>
	<div class="lg-hero" style="background-image: url('<?php the_field('hero_banner'); ?>');">
		<div class="lg-hero__overlay">
			<?php if ( get_field('hero_copy') ): ?>
				<?php the_field('hero_copy'); ?>
			<?php else: ?>
				<h1><?php the_title() ?></h1>
			<?php endif; ?>
			<!-- <a class="fa fa-chevron-down" href="#case-study-info"></a> -->
		</div>
	</div>
<?php else: ?>
<br>
<?php endif; ?>

<main id="case-study" class="container">
	<section>
		<div class="row" id="case-study-info">
			<div class="case-study__content">
				<h3>The Brief</h3>
				<?php the_field('the_brief'); ?>
			</div>
			<div class="case-study__sectors">
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


			<?php  while ( have_rows('content') ) : the_row(); ?>

			<?php if( get_sub_field('full_image') ): ?>
				<div class="row">
					<img src="<?php the_sub_field('full_image'); ?>" class="img-responsive">
				</div>
			<?php endif; ?>


			<?php if( get_sub_field('2col_left') ): ?>
				<div class="row">
					<div class="case-study__2up">
						<img src="<?php the_sub_field('2col_left'); ?>" class="img-responsive">
					</div>
			<?php endif; ?>
			<?php if( get_sub_field('2col_right') ): ?>
					<div class="case-study__2up">
						<img src="<?php the_sub_field('2col_right'); ?>" class="img-responsive">
					</div>
				</div>
			<?php endif; ?>


			<?php if( get_sub_field('text_box') ): ?>
				<div class="row case-study__txtblock">
					<?php the_sub_field('text_box'); ?>
				</div>
			<?php endif; ?>


			<?php endwhile; ?>

			<?php else: ?>
			<div class="case-study__content pad">
				<h3>The Solution</h3>
				<?php the_field('the_solution'); ?>
			</div>
			<div class="img-container">
				<?php the_field('images'); ?>
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
	      'posts_per_page' => 3,
	      'ignore_sticky_posts' => 1,
	      'orderby' => 'rand',
	      'post__not_in'=>array($post->ID)
	   ) ); ?>

	<section class="container-fluid grey">
		<div class="lg-pad-y text-center">
			<p class="section-title">Related Case Studies</p>
		</div>
		<div class="row">
	   <?php if($second_query->have_posts()) {
	     while ($second_query->have_posts() ) : $second_query->the_post(); ?>

			 <a class="folio-item" href="<?php the_permalink(); ?>">
				 <!-- <div class="folio-item__inner" style="background-image: url('<?php //$image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>"></div> -->
				 <?php the_post_thumbnail(); ?>
			 </a>

	   <?php endwhile; wp_reset_query();
	   } ?>
	   </div>
   </section>
</main>

<?php
get_footer();
