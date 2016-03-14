<?php
/* 
Plugin Name: Ajax Load More: SEO
Plugin URI: http://connekthq.com/plugins/ajax-load-more/seo/
Description: Ajax Load More extension to generate unique paging URLs with each query.
Author: Darren Cooney
Twitter: @KaptonKaos
Author URI: http://connekthq.com
Version: 1.3
License: GPL
Copyright: Darren Cooney & Connekt Media
*/


define('ALM_SEO_PATH', plugin_dir_path(__FILE__));
define('ALM_SEO_URL', plugins_url('', __FILE__));
define('ALM_SEO_VERSION', '1.3');
define('ALM_SEO_RELEASE', 'July 5, 2015');




/*
*  alm_seo_install
*  Install the SEO add-on
*
*  @since 1.0
*/

register_activation_hook( __FILE__, 'alm_seo_install' );
function alm_seo_install() {   
   //if Ajax Load More is activated
   if(!is_plugin_active('ajax-load-more/ajax-load-more.php')){	
   	die('You must install and activate <a href="https://wordpress.org/plugins/ajax-load-more/">Ajax Load More</a> before installing the ALM SEO Add-on.');
	}	
}



if( !class_exists('ALMSEO') ):
   class ALMSEO{	   
   	function __construct(){			
   		add_action('alm_seo_installed', array(&$this, 'alm_is_seo_installed'));		
   		add_action('wp_enqueue_scripts', array(&$this, 'alm_seo_enqueue_scripts'));
   		add_action('alm_seo_settings', array(&$this, 'alm_seo_settings'));	
   		add_filter('alm_seo_shortcode', array(&$this, 'alm_seo_shortcode'), 10, 3);		
   	}   	
   	
   	
   	
   	/*
   	*  alm_seo_shortcode
   	*  Build SEO shortcode params and send back to core ALM
   	*
   	*  @since 1.2
   	*/
   	
   	function alm_seo_shortcode($seo, $preloaded, $options){
   		// Get scroll speed and scrolltop
   		   $seo_scroll_speed = '1000';
   		   $seo_scrolltop = '30';
      		if(isset($options['_alm_seo_speed']))
      			$seo_scroll_speed = ''.$options['_alm_seo_speed'];
      
      		if(isset($options['_alm_seo_scrolltop']))
      			$seo_scrolltop = ''.$options['_alm_seo_scrolltop'];
      		
   		   // Enabled Scrolling			
   			$seo_enable_scroll = $options['_alm_seo_scroll'];
      		if(!isset($seo_enable_scroll)){
      			$seo_enable_scroll = 'true';   
            }else{	
         		if($seo_enable_scroll == '1'){
         		   $seo_enable_scroll = 'true';
               }else{
         		   $seo_enable_scroll = 'false';
         		}
      		}
      		
      		// GA send Pageview			
      		if(!isset($options['_alm_seo_ga'])){
      			$seo_send_pageview = 'true';   
            }else{	
               $seo_send_pageview = $options['_alm_seo_ga'];
         		if($seo_send_pageview == '1'){
         		   $seo_send_pageview = 'true';
               }else{
         		   $seo_send_pageview = 'false';
         		}
      		}
      		
      		// Permalink Structure
      		$seo_permalink = 'pretty';
      		if(isset($options['_alm_seo_permalinks'])){
      			$seo_permalink = ''.$options['_alm_seo_permalinks'];
      		}
   		   
   		   // Get $paged var from WP
   		   if ( get_query_var('paged') ) {
              $current_page = get_query_var('paged');
            } elseif ( get_query_var('page') ) {
              $current_page = get_query_var('page');
            } else {
              $current_page = 1;
            }	
            
            // If preloaded then minus 1 page from SEO
            if($preloaded === 'true'){
               $current_page = $current_page - 1;
            }
            
            $return = ' data-seo="'.$seo.'"';		
   			$return .= ' data-seo-start-page="'.$current_page.'"';	
   			$return .= ' data-seo-scroll="'.$seo_enable_scroll.'"';
   			$return .= ' data-seo-scroll-speed="'.$seo_scroll_speed.'"';
   			$return .= ' data-seo-scrolltop="'.$seo_scrolltop.'"';
   			$return .= ' data-seo-permalink="'.$seo_permalink.'"';
   			$return .= ' data-seo-pageview="'.$seo_send_pageview.'"';
   			return $return;
   	} 
   	
   	
   	
   	/*
   	*  alm_seo_enqueue_scripts
   	*  Enqueue our scripts
   	*
   	*  @since 1.0
   	*/
   
   	function alm_seo_enqueue_scripts(){
   		wp_enqueue_script( 'ajax-load-more-seo', plugins_url( '/js/alm-seo.js', __FILE__ ), array('ajax-load-more'),  '1.0', true );
   	}   	
   	
   	
   	
   	/*
   	*  alm_is_seo_installed
   	*  an empty function to determine if seo is true.
   	*
   	*  @since 1.0
   	*/
   	
   	function alm_is_seo_installed(){
   	   //Empty return
   	}   	
   	
   	
   	
   	/*
   	*  alm_seo_settings
   	*  Create the SEO settings panel.
   	*
   	*  @since 1.2
   	*/
   	
   	function alm_seo_settings(){
      	register_setting(
      		'alm_seo_license', 
      		'alm_seo_license_key', 
      		'alm_seo_sanitize_license'
      	);
   	   add_settings_section( 
	   		'alm_seo_settings',  
	   		'SEO Settings', 
	   		'alm_seo_settings_callback', 
	   		'ajax-load-more' 
	   	);
	   	add_settings_field( 
	   		'_alm_seo_permalinks', 
	   		__('SEO Permalinks', ALM_NAME ), 
	   		'_alm_seo_permalinks_callback', 
	   		'ajax-load-more', 
	   		'alm_seo_settings' 
	   	);	
	   	add_settings_field( 
	   		'_alm_seo_ga', 
	   		__('Google Analytics', ALM_NAME ), 
	   		'_alm_seo_ga_callback', 
	   		'ajax-load-more', 
	   		'alm_seo_settings' 
	   	);	
	   	
	   	add_settings_field( 
	   		'_alm_seo_scroll', 
	   		__('Scroll to Page', ALM_NAME ), 
	   		'_alm_seo_scroll_callback', 
	   		'ajax-load-more', 
	   		'alm_seo_settings' 
	   	);	
	   	add_settings_field( 
	   		'_alm_seo_speed', 
	   		__('Scroll Speed', ALM_NAME ), 
	   		'_alm_seo_speed_callback', 
	   		'ajax-load-more', 
	   		'alm_seo_settings' 
	   	);	
	   	add_settings_field( 
	   		'_alm_seo_scrolltop', 
	   		__('Scroll Top', ALM_NAME ), 
	   		'_alm_seo_scrolltop_callback', 
	   		'ajax-load-more', 
	   		'alm_seo_settings' 
	   	);	
   	}	
   	
   } 
   
   
   /* SEO Settings (Displayed in ALM Core) */


	/*
	*  alm_seo_settings_callback
	*  SEO Setting Heading
	*
	*  @since 1.0
	*/
	
	function alm_seo_settings_callback() {
	   $html = '<p>' . __('Customize your installation of the <a href="http://connekthq.com/plugins/ajax-load-more/seo/">Search Engine Optimization</a> add-on.', ALM_NAME) . '</p>';
	   
	   echo $html;
	}
	
	
	
	/*
	*  _alm_seo_permalinks
	*  Select permalink type
	*
	*  @since 1.0
	*/
		
	function _alm_seo_permalinks_callback() {
	 
	    $options = get_option( 'alm_settings' );
	    
	    if(!isset($options['_alm_seo_permalinks'])) 
		   $options['_alm_seo_permalinks'] = 'pretty';
		   
	     
	    $html  = '<p style="padding-bottom: 15px; overflow: hidden;">Select your WordPress <a href="options-permalink.php"><strong>Permalink structure</strong></a>.</p>'; 
	    $html .= '<input type="radio" id="_alm_seo_type_one" name="alm_settings[_alm_seo_permalinks]" value="pretty"' . checked( 'pretty', $options['_alm_seo_permalinks'], false ) . '/>';
	    $html .= '<label for="_alm_seo_type_one">'.__('Pretty Permalinks (mod_rewrite) <br/><span>http://example.com/2012/post-name/</span>', ALM_NAME).'</label><br/>';
	     
	    $html .= '<input type="radio" id="_alm_seo_type_two" name="alm_settings[_alm_seo_permalinks]" value="default"' . checked( 'default', $options['_alm_seo_permalinks'], false ) . '/>';
	    $html .= '<label for="_alm_seo_type_two">'.__('Default (Ugly) <br/><span>http://example.com/?p=N</span>', ALM_NAME).'</label>';
	     
	    echo $html;
	 
	}
	
	
	
	/*
	*  _alm_seo_ga_callback
	*  Send pageviews to Google Analytics
	*
	*  @since 1.2
	*/
	
	function _alm_seo_ga_callback(){
		$options = get_option( 'alm_settings' );
		if(!isset($options['_alm_seo_ga'])) 
		   $options['_alm_seo_ga'] = '1';
		
		$html = '<input type="hidden" name="alm_settings[_alm_seo_ga]" value="0" /><input type="checkbox" id="alm_seo_ga" name="alm_settings[_alm_seo_ga]" value="1"'. (($options['_alm_seo_ga']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="alm_seo_ga">'.__('Send page views to Google Analytics.', ALM_NAME).'<br/><span>Must have a reference to your Google Analytics tracking code on the page.</span></label>';	
		
		echo $html;
	}
	
	
	
	/*
	*  _alm_seo_scroll_callback
	*  Set the speed of auto scroll
	*
	*  @since 1.0
	*/
		
	function _alm_seo_scroll_callback() {
	 
	    $options = get_option( 'alm_settings' );
	    
	    if(!isset($options['_alm_seo_scroll'])) 
		   $options['_alm_seo_scroll'] = '1';
		
		$html = '<input type="hidden" name="alm_settings[_alm_seo_scroll]" value="0" />';
		$html .= '<input type="checkbox" name="alm_settings[_alm_seo_scroll]" id="alm_scroll_page" value="1"'. (($options['_alm_seo_scroll']) ? ' checked="checked"' : '') .' />';
		$html .= '<label for="alm_scroll_page">'.__('Enable window scrolling.<br/><span>If scrolling is enabled, the users window will scroll to the current page on \'Load More\' button click and while interacting with the forward and back browser buttons.</span>', ALM_NAME).'</label>';	
		
		echo $html;
	}
	
	
	
	/*
	*  _alm_seo_speed_callback
	*  Set the speed of auto scroll
	*
	*  @since 1.0
	*/
		
	function _alm_seo_speed_callback() {
	 
	    $options = get_option( 'alm_settings' );
	    
	    if(!isset($options['_alm_seo_speed'])) 
		   $options['_alm_seo_speed'] = '1000';
	     
			
		echo '<label for="alm_settings[_alm_seo_speed]">'.__('Set the scrolling speed of the page in milliseconds. <br/><span>e.g. 1 second = 1000</span>', ALM_NAME).'</label><br/><input type="number" class="sm" id="alm_settings[_alm_seo_speed]" name="alm_settings[_alm_seo_speed]" step="50" min="0" value="'.$options['_alm_seo_speed'].'" placeholder="1000" /> ';	
		  
	}
	
	
	
	/*
	*  _alm_seo_scrolltop_callback
	*  Set the scrlltop value of window scrolling
	*
	*  @since 1.0
	*/
		
	function _alm_seo_scrolltop_callback() {
	 
	    $options = get_option( 'alm_settings' );
	    
	    if(!isset($options['_alm_seo_scrolltop'])) 
		   $options['_alm_seo_scrolltop'] = '30';
	     
			
		echo '<label for="alm_settings[_alm_seo_scrolltop]">'.__('Set the scrolltop position of the window when scrolling to post.', ALM_NAME).'</label><br/><input type="number" class="sm" id="alm_settings[_alm_seo_scrolltop]" name="alm_settings[_alm_seo_scrolltop]" step="1" min="0" value="'.$options['_alm_seo_scrolltop'].'" placeholder="30" /> ';	
		
		?>
		<script>
			// Check if Scroll to Page  != true
			if(!jQuery('input#alm_scroll_page').is(":checked")){ 
		      jQuery('input#alm_scroll_page').parent().parent('tr').next('tr').hide();
		      jQuery('input#alm_scroll_page').parent().parent('tr').next('tr').next('tr').hide();
	    	}
	    	jQuery('input#alm_scroll_page').change(function() {
	    		var el = jQuery(this);
		      if(el.is(":checked")) {
		      	el.parent().parent('tr').next('tr').show();
		      	el.parent().parent('tr').next('tr').next('tr').show();
		      }else{		      
		      	el.parent().parent('tr').next('tr').hide();
		      	el.parent().parent('tr').next('tr').next('tr').hide();
		      }
		   });
		   
	    </script>
	<?php  
	}
   
   
   /*
   *  alm_seo_sanitize_license
   *  Sanitize our license activation
   *
   *  @since 1.3.0
   */
   
   function alm_seo_sanitize_license( $new ) {
   	$old = get_option( 'alm_seo_license_key' );
   	if( $old && $old != $new ) {
   		delete_option( 'alm_seo_license_status' ); // new license has been entered, so must reactivate
   	}
   	return $new;
   }
   
   
   /*
   *  alm_seo_activate_license
   *  Activate the license
   *
   *  @since 1.3.0
   */
   
   function alm_seo_activate_license() {        	
   	
   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_seo_license_activate'] ) ) { 
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_seo_license_nonce', 'alm_seo_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_seo_license_key' ) );
   		
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'activate_license', 
   			'license' 	=> $license, 
   			'item_id'   => ALM_SEO_ITEM_NAME, // the name of our product in EDD
   			'url'       => home_url()
   		);
   		
   		// Call the custom API.
   		$response = wp_remote_get( add_query_arg( $api_params, ALM_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "valid" or "invalid"
   
   		update_option( 'alm_seo_license_status', $license_data->license );
   
   	}
   }
   add_action('admin_init', 'alm_seo_activate_license');
   
   
   
   /*
   *  alm_seo_deactivate_license
   *  Deactivate license
   *
   *  @since 1.3.0
   */
   
   function alm_seo_deactivate_license() {
   
   	// listen for our activate button to be clicked
   	if( isset( $_POST['alm_seo_license_deactivate'] ) ) {
   
   		// run a quick security check 
   	 	if( ! check_admin_referer( 'alm_seo_license_nonce', 'alm_seo_license_nonce' ) ) 	
   			return; // get out if we didn't click the Activate button
   
   		// retrieve the license from the database
   		$license = trim( get_option( 'alm_seo_license_key' ) );
   			
   
   		// data to send in our API request
   		$api_params = array( 
   			'edd_action'=> 'deactivate_license', 
   			'license' 	=> $license, 
   			'item_id'   => ALM_SEO_ITEM_NAME, // the name of our product in EDD
   			'url'       => home_url()
   		);
   		
   		// Call the custom API.
   		$response = wp_remote_get( add_query_arg( $api_params, ALM_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );
   
   		// make sure the response came back okay
   		if ( is_wp_error( $response ) )
   			return false;
   
   		// decode the license data
   		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
   		
   		// $license_data->license will be either "deactivated" or "failed"
   		if( $license_data->license == 'deactivated' )
   			delete_option( 'alm_seo_license_status' );
   
   	}
   }
   add_action('admin_init', 'alm_seo_deactivate_license');
   
     	
   	
   	
   /*
   *  ALMSEO
   *  The main function responsible for returning Ajax Load More SEO.
   *
   *  @since 1.0
   */	
   
   function ALMSEO(){
   	global $ALMSEO;
   
   	if( !isset($ALMSEO) )
   	{
   		$ALMSEO = new ALMSEO();
   	}
   
   	return $ALMSEO;
   }
      
   
   // initialize
   ALMSEO();

endif; // class_exists check


/* Software Licensing */

define('ALM_SEO_ITEM_NAME', '3482' ); // EDD CONSTANT - Item Name
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/vendor/EDD_SL_Plugin_Updater.php' );
}

function alm_seo_plugin_updater() {	
	$license_key = trim( get_option( 'alm_seo_license_key' ) ); // retrieve our license key from the DB
	$edd_updater = new EDD_SL_Plugin_Updater( ALM_STORE_URL, __FILE__, array( 
			'version' 	=> ALM_SEO_VERSION,
			'license' 	=> $license_key,
			'item_id'   => ALM_SEO_ITEM_NAME,
			'author' 	=> 'Darren Cooney'
		)
	);
}
add_action( 'admin_init', 'alm_seo_plugin_updater', 0 );	

/* End Software Licensing */