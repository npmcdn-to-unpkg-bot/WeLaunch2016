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

<div class="lg-hero" style="background-image: url('<?php the_field('hero_img'); ?>');'">
	<div class="lg-hero__overlay">		
		<h1><?php the_field('hero_header'); ?></h1>
	</div>
</div>

<main class="container">
	<section id="home-latest">
		<div class="no-gutter clearfix">
		<?php $the_query = new WP_Query( array('post_type' => 'service', 'posts_per_page' => -1, 'order' => 'DESC') ); ?>
		<?php $count = 0; ?>
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<a href="<?php the_permalink(); ?>" class="panel panel-services block-<?php echo $count++; ?> eq-height">
					<div class="panel-body">
						<h4><?php the_title(); ?></h4>
						<!-- <p><?php //echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?></p> -->	
						<p><?php the_excerpt(); ?></p>	
					</div>
				</a>
			<?php ++$count; endwhile; ?>
		</div>
		<div class="lg-pad-y text-center">
		<a href="<?php echo home_url(); ?>/work" class="btn btn-primary">See Our Full Portfolio</a>
	</div>
	</section>
</main>


<?php
get_footer();
