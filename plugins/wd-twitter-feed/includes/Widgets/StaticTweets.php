<?php
/**
 * @package    twitterfeed
 * @date       Wed Mar 30 2016 00:22:53
 * @version    2.1.4
 * @author     Askupa Software <contact@askupasoftware.com>
 * @link       http://products.askupasoftware.com/twitter-feed/
 * @copyright  2015 Askupa Software
 */

namespace TwitterFeed\Widgets;

class StaticTweets extends \TwitterFeed\Widgets\Widget
{
    public function get_components() 
    {
        return array_merge( 
            self::get_common_widget_components(), 
            self::get_common_tweet_ui_components('statictweets') 
        );
    }

    public function get_name() 
    {
        return 'Static Tweets [TF]';
    }

    public function render( $instance )
    {
        echo \TwitterFeed\static_tweets( $instance );
    }
}