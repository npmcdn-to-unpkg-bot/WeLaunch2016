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

<main class="container" id="blog-wrap">
	<div class="container" id="blog">
		<?php if ( have_posts() ) : ?>
		<?php $the_query = new WP_Query( array('posts_per_page' => -1, 'order' => 'DESC') ); ?>
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		<?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
			<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="post-<?php the_ID(); ?>">
				<div class="panel eq-height sr">
					<div class="panel-heading img-responsive" style="background-image: url('<?php echo $image ?>');"></div>
					<div class="panel-body">
						<h2><?php the_title(); ?></h2>
						<p><?php the_excerpt(); ?></p>
						<a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more...</a>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
		<?php else : ?>

		<h1>Sorry, There's Nothing Here</h1>

		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
