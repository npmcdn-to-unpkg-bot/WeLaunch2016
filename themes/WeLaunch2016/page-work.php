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
<div class="hero-lg" style="background-image: url('<?php echo content_url(); ?>/uploads/2016/02/wl-services-banner.jpg');">
	<div class="hero-lg__overlay">
		<em><?php the_title(); ?></em>
		<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </h1>
	</div>
</div>
<section class="work-filter hidden-xs">
	<ul class="work-filter-list" role="tablist" >
		<li class="active"><a class="filter-btn btn btn-primary" data-filter="*">All</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".branding">Branding</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".digital">Digital</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".motion">Motion</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".print">Print</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".strategy">Strategy</a></li>
		<li><a class="filter-btn btn btn-primary" data-filter=".events">Events</a></li>
	</ul>
</section>

<!-- Portfolio Blocks -->
<section>
<div id="portfolio" class="row filter-grid">
	<?php $the_query = new WP_Query( array('post_type' => 'casestudy', 'posts_per_page' => -1, 'order' => 'DESC') ); ?>
	<?php query_posts($query_string . '&cat=-163'); ?>
	<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
		<?php $filter = Array('digital', 'branding', 'motion', 'print', 'strategy', 'events'); ?> <!-- Testing only -->
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 <?php echo $filter[array_rand($filter)]; ?>">
		<a href="<?php the_permalink(); ?>">
			<div class="folio-item" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');">
				<div class="folio-item-overlay">
					<h4><?php the_title(); ?></h4>
					<p>
						<?php echo wp_trim_words( get_field('short_description'), 25, '...' ); ?>
					</p>
				</div>
			</div>
		</a>
	</div>
	<?php endwhile; ?>
</div>
</section>
<?php
get_footer();
