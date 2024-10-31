<?php
	if (!class_exists('qnnp_base')) {
		require __DIR__ . '/../framework/base.php';
	}
	add_action('admin_menu', 'qnnp_restful_ui_menu', 2);
	function qnnp_restful_ui_menu() {
		if (current_user_can('application_developer') || current_user_can('administrator')) {
			if (is_plugin_active('qnnp/qnnp.php')) {
				$parent_slug = 'qnnp';
				$menu_title  = __('开发接口文档', 'qnnp');
				$page_title  = __('开发接口文档', 'qnnp');
			} else {
				$parent_slug = 'tools.php';
				$menu_title  = __('Restful UI', 'qnnp');
				$page_title  = __('Restful UI', 'qnnp');
			}
			// 权限限定 administrator｜application_developer
			$cab = current_user_can('administrator') ? 'administrator' : 'application_developer';
			add_submenu_page(
				$parent_slug,
				$page_title,
				$menu_title,
				$cab,
				'qnnp-restful-ui',
				function () {
					$asset = json_decode(file_get_contents(__DIR__ . '/../public/build/asset-manifest.json'));
					$index = file_get_contents(__DIR__ . '/../public/build/index.html');
					preg_match_all('/(<script>[\s\S]*\)<\/script>)/', $index, $mainScript, PREG_PATTERN_ORDER);
					foreach ($asset->entrypoints as $entrypoint) {
						if (preg_match('/(^static\/js\/)/', $entrypoint)) {
							if (!preg_match('/(^static\/js\/runtime)/', $entrypoint)) {
								wp_enqueue_script($entrypoint, plugins_url("/qnnp-restful-ui/public/build/$entrypoint"));
							}
						}
						if (preg_match('/(^static\/css\/)/', $entrypoint)) {
							wp_enqueue_style($entrypoint, plugins_url("/qnnp-restful-ui/public/build/$entrypoint"));
						}
					}
					$nonce    = wp_create_nonce('wp_rest');
					$rest_api = get_rest_url();
					echo $mainScript[0][0];
					echo "<script>window.qnnp_restful_ui_nonce = '$nonce';window.qnnp_restful_ui_api_root='$rest_api';</script><div id='root'></div>";
					
				},
				2
			);
		}
	}
	