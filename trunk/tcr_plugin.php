<?php
/*
Plugin Name: Capital Letters
License: GPL
Version: 1.0.1
Plugin URI: http://thecellarroom.net/plugins
Author: The Cellar Room Limited
Author URI: http://www.thecellarroom.net
Donation URI: http://thecellarroom.net/plugins
Copyright (c) 2013 The Cellar Room Limited
Description: Simply auto uppercases the first letter of the first word after finding a full stop in your post content.
auto fixes post titles too. No options or settings, works out of the box, simply just activate.
*/
###################################################################################
defined( 'ABSPATH' ) or die();

function TCR_CL_replace_content($content)
{
$content=preg_replace_callback( '|(?:\.)(?:\s*)(\w{1})|Ui',create_function('$matches', 'return ". ".strtoupper($matches[1]);'),ucfirst($content)); 
return $content;
}
add_filter('the_content','TCR_CL_replace_content');


function lowertitle($title)  {
$title = strtolower($title);
return $title;
}

function fixtitle($title) {
$smallwordsarray = array( 'of','a','the','and','an','or','nor','but','is','if','then','else','when', 'at','from','by','on','off','for','in','out','over','to','into','with' ); 
$words = explode(' ', $title); 
foreach ($words as $key => $word) {
if ($key == 0 or !in_array($word, $smallwordsarray)) $words[$key] = ucwords($word); 
} 
$newtitle = implode(' ', $words); return $newtitle; }

add_filter('title_save_pre','lowertitle');
add_filter('the_title','lowertitle');
add_filter('title_save_pre','fixtitle');
add_filter('the_title','fixtitle');

}

###################################################################################

?>
