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
<section class="work-filter clearfix">
	<ul class="work-filter-list">
		<!-- <li><strong>Filter By:</strong></li> -->
		<li class="active"><a class="filter-btn" data-filter="*">All</a></li>
		<li><a title="Discipline" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="true">Discipline <span class="caret"></span></a>
			<ul role="menu" class="dropdown-menu discipline" role="tablist" >
				<li><a class="filter-btn" data-filter=".Branding">Branding</a></li>
				<li><a class="filter-btn" data-filter=".Digital">Digital</a></li>
				<li><a class="filter-btn" data-filter=".Motion">Motion</a></li>
				<li><a class="filter-btn" data-filter=".Print">Print</a></li>
				<li><a class="filter-btn" data-filter=".Strategy">Strategy</a></li>
				<li><a class="filter-btn" data-filter=".Strategy">Engagement</a></li>
				<li><a class="filter-btn" data-filter=".Events">Destination</a></li>
				<li><a class="filter-btn" data-filter=".Events">Internal Comms</a></li>
			</ul>
		</li>
		<li>
			<a title="Sector" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="true">Sector <span class="caret"></span></a>
			<ul role="menu" class="dropdown-menu discipline" role="tablist" >
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
		</li>
		<!-- <li>
			<a title="Sector" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" aria-expanded="true">Yearly <span class="caret"></span></a>
			<ul role="menu" class="dropdown-menu discipline" role="tablist" >
				<li><a class="filter-btn" data-filter=".2016">2016</a></li>
				<li><a class="filter-btn" data-filter=".2015">2015</a></li>
				<li><a class="filter-btn" data-filter=".2014">2014</a></li>
				<li><a class="filter-btn" data-filter=".2013">2013</a></li>
			</ul>
		</li> -->
	</ul>
</section>

<!-- Portfolio Blocks -->
<section class="pad">
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
