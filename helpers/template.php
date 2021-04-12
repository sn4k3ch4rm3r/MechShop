<?php
	class Template
	{
		private $template;
		private $assigned = array();

		function __construct($template) {
			$this->template = file_get_contents($template);
		}

		function set($key, $value) {
			$this->assigned[$key] = $value;
		}

		function toString() {
			foreach ($this->assigned as $key => $value) {
				$key = "/{{\s*".$key."\s*}}/i";
				$this->template = preg_replace($key, $value, $this->template);
			}
			return $this->template;
		}

		function render() {
			echo $this->toString();
		}
	}
?>