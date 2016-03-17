<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Name
 */

get_header(); ?>

<div class="hero-lg" style="background-image: url('<?php the_field('hero_img', 151); ?>');">
	<div class="hero-lg__overlay">
		<em>Blog</em>
		<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h1>
	</div>
</div>

<main class="clearfix">
	<div class="container" id="blog">
		<?php if ( have_posts() ) : ?>
		<?php $the_query = new WP_Query( array('posts_per_page' => -1, 'order' => 'DESC') ); ?>
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		<?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
			<section class="col-xs-12" id="post-<?php the_ID(); ?>">
				<div class="media sr">
					<div class="media-left media-middle img-wrap img-responsive" style="background-image: url('<?php echo $image ?>');"></div>
					<div class="media-body">
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
						<a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more...</a>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
		<?php else : ?>

		<h1>Sorry, There's Nothing Here</h1>

		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
