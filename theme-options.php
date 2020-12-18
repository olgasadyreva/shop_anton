<?php
/*
Template name: Options
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f8d8f39c32c3ff7aa68ad1b" data-wf-site="5f61f4d1741820a756fe13e1">
	<?php get_template_part("header_block", ""); ?>
	<body>
		<script id="query_vars">
var query_vars = '<?php global $wp_query; echo serialize($wp_query->query) ?>';
		</script>
		<div class="section">
			<div class="w-container">
				<div class="footer-menu">
					<h3 f_tab="Контакты">Контакты</h3><a href="#" class="contact-footer"><?php echo get_field('adres_magazina', 'options') ?></a><a href="tel:+<?php echo preg_replace("/(\D)/", "", get_field('telefon', 'options')) ?>" class="contact-footer phone"><?php echo get_field('telefon', 'options') ?></a><a href="mailto:<?php echo get_field('email', 'options') ?>" class="contact-footer email"><?php echo get_field('email', 'options') ?></a><a href="#" class="contact-footer time"><?php echo get_field('vremya_raboty', 'options') ?></a></div>
				<h3 f_tab="Другие настройки">Другие настройки</h3>
				<div class="logo-text">
					<?php echo get_field('opisanie_sajta', 'options') ?>
				</div>
			</div>
		</div>
		<!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
		<?php get_template_part("footer_block", ""); ?>