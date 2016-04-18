<?php
/**
 * @package    twitterfeed
 * @date       Wed Mar 30 2016 00:22:53
 * @version    2.1.4
 * @author     Askupa Software <contact@askupasoftware.com>
 * @link       http://products.askupasoftware.com/twitter-feed/
 * @copyright  2015 Askupa Software
 */

namespace TwitterFeed\Parser;

/**
 * Tweet
 * 
 * The Tweet object is used throughout the plugin as a means to store and 
 * retrieve tweet data
 */
class Tweet 
{
    private $params;
    
    public function __construct( array $params ) 
    {
        $this->params = $params;
    }
    
    public function __get($name) 
    {
        return $this->params[$name];
    }
}