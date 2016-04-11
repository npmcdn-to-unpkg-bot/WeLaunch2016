<header>
	<nav class="navbar" role="navigation">
	  <div class="container">
	    <a class="menu-link" href="#"><i class="fa fa-bars"></i></a>
	    <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo content_url(); ?>/uploads/2016/03/we-launch-logox2-1.png" class="img-responsive"></a>
	    <?php
	        wp_nav_menu( array(
	            'menu'              => 'primary',
	            'theme_location'    => 'primary',
	            'depth'             => 2,
	            'container'         => 'div',
	            'menu_class'        => 'nav navbar-right',
	            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	            'walker'            => new wp_bootstrap_navwalker())
	        );
	    ?>
	    </div>
	</nav>
</header>
