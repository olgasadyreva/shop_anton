<head>
		<meta charset="utf-8">
		<meta content="Главная" property="og:title">
		<meta content="Главная" property="twitter:title">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
		<script type="text/javascript">WebFont.load({  google: {    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]  }});</script>
		<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif]-->
		<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
		<meta name="author" content="wtw">
		<!-- HEAD CODE -->
		<?php wp_head(); ?>
		<?php if(function_exists('the_field')) { the_field('head_code', 'option'); } ?>
		<?php if(file_exists(dirname( __FILE__ ).'/header_code.php')){ include_once 'header_code.php'; } ?>
	</head>