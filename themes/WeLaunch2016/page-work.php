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
<main class="container">
	<section class="work-filter" >
		<div class="row">
			<h4>Filter By</h4>
			<span class="fa fa-chevron-up" id="filter-toggle" data-toggle="collapse" data-target="#list-wrap"></span>
		</div>
		<div class="row collapse in" id="list-wrap" aria-expanded="true">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>Discipline</p>
				<ul class="work-filter-list clearfix">
					<li><a class="filter-btn" data-filter="*">All</a></li>
					<li><a class="filter-btn" data-filter=".Branding">Branding</a></li>
					<li><a class="filter-btn" data-filter=".Digital">Digital</a></li>
					<li><a class="filter-btn" data-filter=".Motion">Motion</a></li>
					<li><a class="filter-btn" data-filter=".Print">Print</a></li>
					<li><a class="filter-btn" data-filter=".Strategy">Strategy</a></li>
					<li><a class="filter-btn" data-filter=".Strategy">Engagement</a></li>
					<li><a class="filter-btn" data-filter=".Events">Internal Comms</a></li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<p>Sector</p>
				<ul class="work-filter-list clearfix">
					<!-- List all Industry Sectors -->
					<?php
					$taxonomy = 'industry_sectors';
					$tax_terms = get_terms($taxonomy);
					?>
					<?php
					foreach ($tax_terms as $tax_term) {
					echo '<li>' . '<a class="filter-btn" href="" data-filter=".'. $tax_term->slug. '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</section>

	<!-- Portfolio Blocks -->
	<section class="pad" id="work-grid">
	<div id="portfolio" class="row filter-grid">
		<?php $the_query = new WP_Query( array('post_type' => 'casestudy', 'posts_per_page' => -1, 'order' => 'DESC') ); ?>
		<?php query_posts($query_string . '&cat=-163'); ?>
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		<?php $terms = get_the_terms($post->ID, "industry_sectors"); ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 <?php the_field('discipline'); ?> <?php foreach ( $terms as $term ) { echo $term->slug . ' '; } ?> <?php echo get_the_time('Y'); ?>">
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
		<?php endwhile; ?>
	</div>
	</section>
</main>
<?php
get_footer();
