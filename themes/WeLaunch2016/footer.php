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
</main>
<div id="footer-services" class="text-center">
	<div class="row pad-y">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			<img src="<?php echo content_url(); ?>/uploads/2016/02/logo-new.png" class="img-responsive">
			<p class="lead">The only brand communications agency in the world, based on Fitzroy Square in Central London, that has launched brands in the UK, Europe, Australasia, South America, and the Middle East.</p>
		</div>
	</div>
	<div class="row">
		<ul class="home_services-list">
			<li><a href="services/#branding">Branding</a></li>
			<li><a href="services/#digital">Digital</a></li>
			<li><a href="#">Motion</a></li>
			<li><a href="#">Print</a></li>
			<li><a href="#">Strategy</a></li>
			<li><a href="#">Events</a></li>
		</ul>
	</div>
</div>
	<footer>
		<span><b>&copy; We Launch Ltd</b></span>&nbsp;&nbsp;<span>Lower Ground Floor, 5 Fitzroy Square, London W1T 5HH&nbsp;&nbsp;</span><span>T: +44 (0)20 3714 0867&nbsp;&nbsp;</span><span>E: <a href="mailto:enquiries@welaunch.co.uk">enquiries@welaunch.co.uk</a></span>
		<!-- <span><i class="fa fa-twitter"></i><i class="fa fa-instagram"></i><i class="fa fa-facebook"></i></span> -->
	</footer>
</div>

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
</body>
</html>
