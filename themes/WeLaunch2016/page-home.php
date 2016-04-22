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

<!-- Hero Carousel -->
<div id="home">
	<?php if( get_field('hero') ): ?>
		<div id="hero-carousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
				<?php
				$ii=0;
				while( have_rows('hero') ): the_row();
					if ($ii == 0) {
						echo '<li data-target="#hero-carousel" data-slide-to="0" class="active animated fadeIn"></li>';
					} else {
						echo '<li data-target="#hero-carousel" data-slide-to="'.$ii.'" class="animated fadeIn"></li>';
					}
				$ii++;
				endwhile; ?>
		    </ol>
		    <div class="carousel-inner" role="listbox">
    		<?php $i = 0; ?>
			<?php while(has_sub_field('hero')): ?>
		        <div class="item <?php if($i === 0) { ?> active <?php } ?>">
		        	<div class="lg-hero" style="background-image: url('<?php the_sub_field('hero_image'); ?>');">
								<div class="lg-hero__overlay">
			        		<div class="animated fadeInLeft container">
										<?php the_sub_field('hero_copy'); ?>
									</br>
								<?php if($i === 0) { ?>
									<a href="<?php echo home_url('/work'); ?>" class="btn btn-primary invert">See more</a>
								<?php } else { ?>
									<a href="<?php the_sub_field('button_link'); ?>" class="btn btn-primary invert">View Project</a>
								<?php } ?>
			        		</div>
						</div>
		        	</div>
		        </div>
		    <?php ++$i; endwhile; ?>

		    </div>
		</div>
	<?php endif; ?>
</div>
<main id="home-wrapper" class="container" style="background-color:white;">
	<!-- Portfolio Blocks -->
	<div id="portfolio" class="row">
		<?php $posts = get_field('featured_projects'); ?>
		<?php if( $posts ): ?>
		<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<?php setup_postdata($post); ?>
				<a class="folio-item" href="<?php the_permalink(); ?>">
					<div class="folio-item__inner" style="background-image: url('<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'large', true);echo $image_url[0];  ?>');" href="<?php the_permalink(); ?>"></div>
				</a>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>
	</div>
	<div class="pad-y text-center">
		<p class="section-title">Latest News</p>
	</div>

	<section id="home-latest">
		<div class="no-gutter clearfix">
		<?php $the_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC') ); ?>
		<?php $count = 0; ?>
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<a href="<?php the_permalink(); ?>" class="panel panel-latest block-<?php echo $count++; ?> eq-height">
					<div class="panel-body">
						<h4><?php the_title(); ?></h4>
						<p><?php echo wp_trim_words( get_the_excerpt(), 40, '...' ); ?><?php //the_excerpt(); ?></p>
					</div>
				</a>
			<?php ++$count; endwhile; ?>
		</div>
	</section>
	<div class="lg-pad-y text-center">
		<a href="<?php echo home_url(); ?>/work" class="btn btn-primary">See Our Full Portfolio</a>
	</div>
</main>

<?php
get_footer();
