<?php
/*
Template name: Checkout
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f75b9e7278e8a17d8fb40b5" data-wf-site="5f61f4d1741820a756fe13e1">
	<?php get_template_part("header_block", ""); ?>
	<body class="body">
		<script id="query_vars">
var query_vars = '<?php global $wp_query; echo serialize($wp_query->query) ?>';
		</script>
		<div data-collapse="medium" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
			<div class="navbar-container w-container">
				<div class="nav-content"><a href="#" class="brand w-nav-brand"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f7774e997b8677afb084_Logo.svg" loading="lazy" alt=""></a>
					<nav role="navigation" class="w-nav-menu">
						<?php if( $menu_items = wp_get_nav_menu_items('Главное меню') ) { $menu_list = ''; $current_class = '';
        foreach ( (array)$menu_items as $key =>$menu_item ) { if($menu_item->url === get_home_url(null, $wp->request).'/'){$current_class = ' w--current';} else {$current_class = '';} if($menu_items[$key+1]->menu_item_parent != 0 && $menu_items[$key]->menu_item_parent == 0){ $target = $menu_item->target ? $menu_item->target : '_self'; $menu_list .= '
						<div data-ix="" class="nav-link navdropdown w-dropdown">
							<div class="nav-link w-dropdown-toggle">
								<div>'.$menu_item->title.'</div>
								<div class="icon-navdrop w-icon-dropdown-toggle"></div>
							</div>
							<nav class="w-dropdown-list">'; }else{ if($menu_items[$key]->menu_item_parent == 0){ $target = $menu_item->target ? $menu_item->target : '_self'; $link_class = 'nav-link w-nav-link';}else{$link_class = 'w-dropdown-link';} $menu_list .= '<a class="'.$link_class.$current_class.'" title="'.$menu_item->attr_title.'" target="'.$target.'" href="'.$menu_item->url.'">'.$menu_item->title.'</a> '; if($menu_items[$key+1]->menu_item_parent == 0 && $menu_items[$key]->menu_item_parent != 0){ $menu_list .= '</nav>
						</div>'; } } } echo $menu_list; } ?></nav>
					<div class="nav-system">
						<div data-w-id="7ab8f7c4-6667-5003-fd00-d028f6a5f605" class="system-item search-icon"></div><a href="/my-account" class="system-item icon-user w-inline-block"></a><a href="/cart" class="system-item icon-cart w-inline-block"><div class="count-product" data-wc="cart_count"><?php echo WC()->cart->cart_contents_count ?></div></a></div>
				</div>
				<div class="menu-button w-nav-button">
					<div class="w-icon-nav-menu"></div>
				</div>
			</div>
			<div class="search-cont">
				<form action="<?php echo get_home_url() ?>/index.php#results" class="search full w-form" method="get" id="search" name="search" data-name="search" data-action="search">
<input type="search" class="search-input w-input" maxlength="256" name="s" placeholder="Поиск" id="search" required="" data-name="s" value="<?php echo get_search_query() ?>">
<input type="submit" value="" class="search-button w-button"></form>
			</div>
		</div>
		<div class="breadcrumbs">
			<div class="bc-text"><a href="/" class="bc-link">Главная</a> <span class="bc-sep">/</span> страница</div>
		</div>
		<div class="page-section">
			<div class="container">
				<div class="checkout-box">
					<?php if(strpos($_SERVER['REQUEST_URI'], 'order-received') === false){ ?>
					<div class="w-form">
						<form id="checkout_form" name="checkout_form" data-name="checkout_form" class="form checkout woocommerce-checkout" data-action="checkout_form" action="/checkout" enctype="multipart/form-data">
							<h3 class="h3 on-checkout">КОНТАКТНАЯ ИНФОРМАЦИЯ</h3>
<label for="name" class="checkout-label">Имя*</label>
<input type="text" class="w-input" maxlength="256" name="billing_first_name" data-name="billing_first_name" placeholder="" id="billing_first_name" value="<?php echo get_user_meta(get_current_user_id(), 'billing_first_name', true) ?>">
<label for="email" class="checkout-label">Email*</label>
<input type="email" class="w-input" maxlength="256" name="billing_email" data-name="billing_email" placeholder="" id="billing_email" required="" value="<?php echo get_user_meta(get_current_user_id(), 'billing_email', true) ?>">
<label for="email-2" class="checkout-label">Телефон*</label>
<input type="email" class="w-input" maxlength="256" name="billing_phone" data-name="billing_phone" placeholder="" id="billing_phone" required="" value="<?php echo get_user_meta(get_current_user_id(), 'billing_phone', true) ?>">
							<h3 class="h3 on-checkout">СПОСОБ ДОСТАВКИ</h3>
							<div class="delivery-box">
								<?php foreach (WC()->session->get('shipping_for_package_0')['rates'] as $method){ ?>
<label class="w-radio">
<input type="radio" name="shipping_method[0]" value="<?php echo $method->id; ?>" class="w-form-formradioinput w-radio-input"><span class="w-form-label"><?php echo $method->label ?></span></label>
								<?php } ?>
							</div>
<label for="email-3" class="checkout-label">Адрес доставки*</label>
<input type="email" class="w-input" maxlength="256" name="billing_address_1" data-name="billing_address_1" placeholder="" id="billing_address_1" required="" value="<?php echo get_user_meta(get_current_user_id(), 'billing_address_1', true) ?>">
							<h3 class="h3 on-checkout">Способы оплаты</h3>
							<div class="payment-box">
								<?php foreach (WC()->payment_gateways->get_available_payment_gateways() as $method){ ?>
<label class="payment-padio w-radio">
<input type="radio" data-name="payment_method" name="payment_method" value="<?php echo $method->id; ?>" class="w-form-formradioinput w-radio-input"><span class="payment-label w-form-label"><span class="payment-title"><?php echo $method->title ?></span><br><span class="payment-desc">Оплата пластиковой картой на сайте</span></span></label>
								<?php } ?>
							</div>
							<h3 class="h3 on-checkout">Комментарий к заказу</h3>
<textarea name="order_comments" maxlength="5000" id="order_comments" class="textarea w-input" value="" data-name="order_comments"></textarea>
<input type="submit" value="Оформить заказ" data-wait="Please wait..." class="add-btn w-button">
							<?php wp_nonce_field('woocommerce-process_checkout', '_wpnonce', false, true ); ?>
						</form>
						<div class="w-form-done">
							<div>Thank you! Your submission has been received!</div>
						</div>
						<div class="w-form-fail">
							<div>Oops! Something went wrong while submitting the form.</div>
						</div>
					</div>
					<?php } else { ?>
					<div class="order-complete">Ваш заказ № <strong><?php echo basename(dirname($_SERVER['REQUEST_URI'])) ?></strong> успешно оформлен.</div>
					<?php } ?>
				</div>
				<div style="display:none;">
					<?php echo do_shortcode("[woocommerce_checkout]");?>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				<div class="w-row">
					<div class="w-col w-col-4">
						<div class="footer-left-box"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f7780c58dbf901d06b1b_Logo_white-1.svg" loading="lazy" alt="" class="footer-logo">
							<div class="logo-text">
								<?php echo get_field('opisanie_sajta', 'options') ?>
							</div>
						</div>
					</div>
					<div class="w-col w-col-2">
						<h3 class="footer-h3">Наш сервис</h3>
						<div class="footer-menu"><a href="#" class="footer-link">Помощь</a><a href="#" class="footer-link">Контакты</a><a href="#" class="footer-link">Магазин</a><a href="#" class="footer-link">Личный кабинет</a></div>
					</div>
					<div class="w-col w-col-2">
						<h3 class="footer-h3">Информация</h3>
						<div class="footer-menu"><a href="#" class="footer-link">О нас</a><a href="#" class="footer-link">Оплата</a><a href="#" class="footer-link">Доставка</a><a href="#" class="footer-link">Возврат товара</a></div>
					</div>
					<div class="w-col w-col-4">
						<h3 class="footer-h3">Контакты</h3>
						<div class="footer-menu"><a href="#" class="contact-footer"><?php echo get_field('adres_magazina', 'options') ?></a><a href="tel:+<?php echo preg_replace("/(\D)/", "", get_field('telefon', 'options')) ?>" class="contact-footer phone"><?php echo get_field('telefon', 'options') ?></a><a href="mailto:<?php echo get_field('email', 'options') ?>" class="contact-footer email"><?php echo get_field('email', 'options') ?></a><a href="#" class="contact-footer time"><?php echo get_field('vremya_raboty', 'options') ?></a></div>
					</div>
				</div>
			</div>
		</div>
		<!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
		<?php get_template_part("footer_block", ""); ?>