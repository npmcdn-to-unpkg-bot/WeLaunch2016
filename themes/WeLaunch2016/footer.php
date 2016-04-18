<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Name
 */

?>

<?php get_template_part( 'template-parts/footer' ); ?>

<?php wp_footer(); ?>
<script src="http://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<script>
   var iframe = $('#vimeo-player')[0],
	   player = $f(iframe),
	   status = $('.status');

	   player.addEvent('ready', function() {
		   player.api('setVolume', 0);
		   player.api('autoplay', 1);
	   });
</script>
<script>
  new WOW().init();
</script>
</body>
</html>
