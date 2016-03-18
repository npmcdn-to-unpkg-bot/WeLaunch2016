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
<main id="case-study">
	<div class="hero-lg" style="background-image: url('<?php the_field('hero_banner'); ?>');">
		<div class="hero-lg__overlay">
			<?php the_field('hero_copy'); ?>
		</div>
	</div>
	<section>
		<div class="row white-bg" id="case-study-info">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-7" id="case-study-wrap">
				<h3>The Brief</h3>
				<?php the_field('the_brief'); ?>
				<div class="read-more">
					<h3>The Solution</h3>
					<?php the_field('the_solution'); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right">
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
				<h3>Deliverables</h3>
				<div class="deliverables clearfix">
					<?php
					   $terms = get_the_terms($post->ID, "deliverables");
						 if ( !empty( $terms ) && !is_wp_error( $term ) ){
							 foreach ( $terms as $term ) {
							   echo '<span>' . $term->name . ', </span>';

							 }
						 }
					  ?>
				</div>
				<?php
				//$posts = get_field('testimonial');
				//if( $posts ): ?>
				<!-- <h3>Testimonials</h3>
				    <?php //foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        <?php setup_postdata($post); ?>
				        <blockquote>
							<?php //the_field('quote'); ?>
						</blockquote>
				    <?php //endforeach; ?>
				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php  //endif; ?> -->
			</div>
		</div>
	</section>
	<section class="clearfix pad">
		<div class="img-wrap">
			<?php the_field('images'); ?>
		</div>
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
		<h3>Related Projects</h3>
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
