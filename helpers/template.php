<?php
	class Template {
		private $content;
		private $template;
		private $context;
		public $blocks;

		function __construct($template_file, $context = array()) {		
			$this->content = file_get_contents($template_file);
			if($context) {
				$this->context = $context;
			}
			if(preg_match("/^{% extends '(?<template>.*)' %}/", $this->content, $base)) {
				$this->template = new Template($_SERVER['DOCUMENT_ROOT']."/".$base['template'], $context);
				$this->blocks = $this->template->blocks;
			}
			else {
				$this->template = $this;
			}

			preg_match_all("/{% block (?<name>\w+) %}(?<content>.*){% endblock (\k'name') %}/sU", $this->content, $blocks, PREG_SET_ORDER);
			foreach($blocks as $block) {
				$this->blocks[$block['name']] = $block['content'];
			}
		}

		function __toString()
		{
			$page = $this->template->raw_template();

			if ($this->blocks) {
				foreach($this->blocks as $name => $content) {
					$page = preg_replace(
						"/{% block ".$name." %}(.*){% endblock ".$name." %}/s",
						$content,
						$page
					);
				}
			}

			if($this->context) {
				foreach($this->context as $key=>$value) {
					$page = preg_replace(
						"/{{\s*(".$key.")\s*}}/",
						$value,
						$page
					);
				}
			}
			
			preg_match_all(
				"/{% include '(?<included>.*)' %}/",
				$page,
				$includes,
				PREG_SET_ORDER
			);
			foreach($includes as $include) {
				$page = str_replace($include[0], file_get_contents($_SERVER['DOCUMENT_ROOT']."/".$include['included']), $page);
			}

			return $page;
		}

		function raw_template() {
			return $this->content;
		}

		function render() {
			echo strval($this);
		}
	}
?>
