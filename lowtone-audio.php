<?php
/*
 * Package Name: Audio
 * Package URI: http://wordpress.lowtone.nl/audio
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
 * @package wordpress\Packages\lowtone\audio
 */

namespace lowtone\audio {

	use lowtone\content\packages\Package;

	// Includes
	
	if (!include_once WP_Package_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content Package is required", E_USER_ERROR) && false;

	Package::init(array(
			Package::INIT_PACKAGES => array("lowtone", "lowtone\\wp"),
			Package::INIT_MERGED_PATH => __NAMESPACE__,
			Package::INIT_SUCCESS => function() {

				// Register embed handler

				wp_embed_register_handler("html5_audio", "#^https?://.+\.(mp3|ogg|wav)$#i", function($matches, $attr, $url, $rawattr) {
					wp_enqueue_script("lowtone_audio", Packages_url("/assets/scripts/jquery.audio" . (!Util::isScriptDebug() ? "-min" : "") . ".js", __FILE__), array("audio", "modernizr"));
					wp_enqueue_style("lowtone_audio", Packages_url("/assets/styles/audio.css", __FILE__));

					return sprintf('<audio preload="auto"><source src="%1$s" /></audio>', sprintf($matches[0]));
				});

			}
		));

}