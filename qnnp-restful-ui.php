<?php
	
	/*
	Plugin Name: [qnnp] Restful UI
	Plugin URI: https://main.qnnp.me/plugins/restful-ui.html
	Description: Use the UI interface to test WP-JSON friendly.
	Version: 2020.12.09
	Author: qnnp
	Text Domain: qnnp
	Domain Path: /languages
	Author URI: https://main.qnnp.me
	License: GPLv2 or later.
	*/
	
	$qnnp_restful_ui_application_dir = __DIR__ . "/application";
	if (file_exists($qnnp_restful_ui_application_dir)) {
		$applications = opendir($qnnp_restful_ui_application_dir);
		while ($application = readdir($applications)) {
			if (preg_match('/\.php$/i', $application)) {
				require __DIR__ . "/application/$application";
			}
		}
	}
	