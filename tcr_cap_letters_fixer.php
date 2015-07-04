<?php
/*
Plugin Name: Capital Letters
Description: Simply auto uppercases the first letter of the first word after finding a full stop in your post content.
auto fixes post titles too. No options or settings, works out of the box, simply just activate.
License: GPL
Version: 1.0.2
Plugin URI: http://thecellarroom.uk
Author: The Cellar Room Limited
Author URI: http://www.thecellarroom.uk
Donation URI: http://thecellarroom.uk
Copyright (c) 2013 The Cellar Room Limited
*/
	defined( 'ABSPATH' ) or die();

	/*************************************************************************/

	if ( ! class_exists( 'tcr_cap_letters' ) ) :

		class tcr_cap_letters {

			function __construct() {

				add_filter('title_save_pre'     , array( $this, 'lowertitle') );
				add_filter('the_title'          , array( $this, 'lowertitle') );
				add_filter('title_save_pre'     , array( $this, 'fixtitle') );
				add_filter('the_title'          , array( $this, 'fixtitle') );
				add_filter('the_content'        , array( $this, 'TCR_CL_replace_content') );
			}

			function TCR_CL_replace_content($content)  {
			$content=preg_replace_callback( '|(?:\.)(?:\s*)(\w{1})|Ui',create_function('$matches', 'return ". ".strtoupper($matches[1]);'),ucfirst($content));
			return $content;

			}

			function lowertitle($title)  {

			$title = strtolower($title);
			return $title;

			}

			function fixtitle($title) {
			$small_words_array = array( 'of','a','the','and','an','or','nor','but','is','if','then','else','when', 'at','from','by','on','off','for','in','out','over','to','into','with' );
			$words = explode(' ', $title);
			foreach ($words as $key => $word) {
			if ($key == 0 or !in_array($word, $small_words_array)) $words[$key] = ucwords($word);
			}
			$new_title = implode(' ', $words);

				return $new_title;

			}

		}

	new tcr_cap_letters;

endif;