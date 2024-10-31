<?php
//	add_action(
//		'init',
//		function () {
//			$current_locale = get_locale();
//			if (!empty($current_locale)) {
//				$mo_file = dirname(__FILE__) . '/../languages/' . $current_locale . ".mo";
//				if (@file_exists($mo_file) && is_readable($mo_file)) {
//					load_textdomain('qnnp', $mo_file);
//				}
//			}
//		}
//	);