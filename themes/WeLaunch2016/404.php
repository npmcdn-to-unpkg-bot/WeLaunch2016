<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Name
 */

get_header(); ?>

<main id="four-oh-four" class="container">
	<div class="row">
		<section class="four-oh-four__wrap">
			<div class="img-wrap">
				<img src="<?php echo content_url(); ?>/uploads/2016/04/404.png">
			</div>
			<div class="content-wrap">
				<h1>Oops! We couldn't find what you were looking for.</h1>
				<p><strong>Try searching for something instead...</strong></p>
				<?php echo get_search_form(); ?>
			</div>
		</section>	  
	</div>
	<?php //Get array of terms
	$terms = get_the_terms( $post->ID , 'industry_sectors', 'string');
	//Pluck out the IDs to get an array of IDS
	$term_ids = wp_list_pluck($terms,'term_id');

	//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
	//Chose 'AND' if you want to query for posts with all terms
	  $second_query = new WP_Query( array(
	      'post_type' => 'casestudy',	     
	      'posts_per_page' => 3,
	      'ignore_sticky_posts' => 1,
	      'orderby' => 'rand',
	      'post__not_in'=>array($post->ID)
	   ) ); ?>

	<section class="row">
		<div class="pad-y text-center">
			<p class="section-title">Our Case Studies</p>
		</div>
		<div class="row">
	   <?php if($second_query->have_posts()) {
	     while ($second_query->have_posts() ) : $second_query->the_post(); ?>

			 <a class="folio-item" href="<?php the_permalink(); ?>">
				 <div class="folio-item__inner" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>"></div>
			 </a>

	   <?php endwhile; wp_reset_query();
	   } ?>
	   </div>
   </section>
      
</main>
	
<?php
get_footer();
