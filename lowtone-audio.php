<?php
/*
 * Plugin Name: Audio
 * Plugin URI: http://wordpress.lowtone.nl/audio
 * Description: Embed audio in Posts.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2011-2012, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\plugins\lowtone\audio
 */

namespace lowtone\audio {

	// Init Lowtone Util
	
	if (!include_once(WP_CONTENT_DIR . "/libs/lowtone/lowtone.php"))
		trigger_error("Lowtone Util not found", E_USER_ERROR);

	// Register embed handler

	wp_embed_register_handler("html5_audio", "#^https?://.+\.(mp3|ogg|wav)$#i", function($matches, $attr, $url, $rawattr) {
		wp_enqueue_script("lowtone_audio", plugins_url("/assets/scripts/jquery.audio.js", __FILE__), array("audio", "modernizr"));
		wp_enqueue_style("lowtone_audio", plugins_url("/assets/styles/audio.css", __FILE__));

		return sprintf('<audio preload="auto"><source src="%1$s" /></audio>', sprintf($matches[0]));
	});

}