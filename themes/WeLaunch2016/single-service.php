<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Name
 */

get_header(); ?>

<div class="hero-lg" style="background-image: url('http://localhost/WeLaunch/wp-content/uploads/2014/08/hero-filler.jpg');">
	<div class="hero-lg__overlay">
		<h1><?php the_title(); ?></h1>
	</div>
</div>
<main class="container white-bg text-center pad">
	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 pad-y">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'name' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'name' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</main>

<?php
get_footer();
