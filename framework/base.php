<?php
	class qnnp_base {
		public function view($template, $data = []) {
			$template = __DIR__ . DIRECTORY_SEPARATOR . "../template/$template.php";
			if (is_readable($template)) {
				extract($data, EXTR_SKIP);
				require $template;
				echo PHP_EOL;
			}
		}
		
	}
