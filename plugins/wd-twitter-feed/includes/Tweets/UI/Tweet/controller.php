<?php
/**
 * @package    twitterfeed
 * @date       Wed Mar 30 2016 00:22:53
 * @version    2.1.4
 * @author     Askupa Software <contact@askupasoftware.com>
 * @link       http://products.askupasoftware.com/twitter-feed/
 * @copyright  2015 Askupa Software
 */

namespace TwitterFeed\Tweets\UI;

/**
 * Implements a single tweet controller. Used by tweet lists objects.
 */
class Tweet extends \Amarkal\Template\Controller
{
    protected $tweet;
    
    protected $params;
    
    public function __construct( $tweet, $params )
    {
        global $twitterfeed_options;
        $this->tweet  = $tweet;
        $this->params = $params;
        $this->intent = 'https://twitter.com/intent/';
        $this->expand_media = $twitterfeed_options['expand_media'] === 'ON';
    }
    
    /**
     * Get the path to the template (script).
     * @return string    The path.
     */
    public function get_script_path() 
    {
        return dirname( __FILE__ ) . '/template.phtml';
    }
    
    public function get_tweet_time()
    {
        $date = new \DateTime($this->tweet->created_at);

        // Show human time if tweet is less than a week old
        if( (current_time('timestamp')-$date->getTimestamp())/(60*60*24) < 7 )
        {
            return human_time_diff( $date->getTimestamp(), current_time('timestamp',1) ).' ago';
        }
        
        // Otherwise use user's time format
        return date_i18n(get_option('date_format'), $date->getTimestamp(), 1);
    }
}
