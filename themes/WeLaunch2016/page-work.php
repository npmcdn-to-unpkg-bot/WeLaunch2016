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
			<span class="fa fa-chevron-up" id="filter-toggle"></span>
		</div>
		<div class="row collapse" id="list-wrap" aria-expanded="true">
			<div class="work-filer__discipline">
				<p>Discipline</p>
				<ul class="work-filter-list clearfix">
					<li><a class="filter-btn" data-filter="*">All</a></li>
					<li><a class="filter-btn" data-filter=".Branding">Branding</a></li>
					<li><a class="filter-btn" data-filter=".Digital">Digital</a></li>
					<li><a class="filter-btn" data-filter=".Motion">Motion</a></li>
					<li><a class="filter-btn" data-filter=".Print">Print</a></li>
					<li><a class="filter-btn" data-filter=".Strategy">Strategy</a></li>
					<li><a class="filter-btn" data-filter=".Strategy">Engagement</a></li>
					<li><a class="filter-btn" data-filter=".Destination">Destination</a></li>
					<li><a class="filter-btn" data-filter=".Events">Internal Comms</a></li>
				</ul>
			</div>
			<div class="work-filer__sector">
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
	<section id="work-grid">
	<div id="portfolio" class="row filter-grid">
		<?php $the_query = get_field('work_case_studies'); ?>
		<?php //$the_query = new WP_Query( array('post_type' => 'casestudy', 'posts_per_page' => -1, 'order' => 'DESC') ); ?>
		<?php query_posts($query_string . '&cat=-163'); ?>
		<?php if( $the_query): ?>
		<?php foreach( $the_query as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
		<?php $terms = get_the_terms($post->ID, "industry_sectors"); ?>	
			<a class="folio-item filter-item <?php the_field('discipline'); ?> <?php foreach ( $terms as $term ) { echo $term->slug . ' '; } ?> <?php echo get_the_time('Y'); ?>"href="<?php the_permalink(); ?>">
				<!-- <div class="folio-item__inner" style="background-image: url('<?php //$image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>"></div> -->
				<?php the_post_thumbnail(); ?>
			</a>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>
	</div>
	</section>
</main>
<?php
get_footer();
