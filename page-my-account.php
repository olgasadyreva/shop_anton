<?php
/*
Template name: My Account
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f7881023872591732a072e8" data-wf-site="5f61f4d1741820a756fe13e1">
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
			<div class="bc-text"><a href="/" class="bc-link">Главная</a> <span class="bc-sep">/</span> <span><?php the_title(); ?></span></div>
		</div>
		<div class="page-section">
			<div class="container">
				<div class="account-box">
					<?php if( !is_user_logged_in() ){ ?>
					<div data-duration-in="300" data-duration-out="100" class="account-tabs w-tabs">
						<div class="account-tab-menu w-tab-menu"><a data-w-tab="Tab 1" class="account-tab-link w-inline-block w-tab-link w--current"><div class="account-tab-title">Войти в аккаунт</div></a><a data-w-tab="Tab 2" class="account-tab-link w-inline-block w-tab-link"><div class="account-tab-title">Регистрация</div></a><a data-w-tab="Tab 3" class="account-tab-link w-inline-block w-tab-link"><div class="account-tab-title">Восстановить пароль</div></a></div>
						<div class="w-tab-content">
							<div data-w-tab="Tab 1" class="account-tab-pane w-tab-pane">
								<div class="w-form">
									<form id="login_form" name="login_form" data-name="login_form" class="form" method="post" action="/index.php">
<label for="name" class="checkout-label">Введите логин или email*</label>
<input type="text" class="w-input" maxlength="256" name="login" data-name="login" placeholder="" id="name">
<label for="email" class="checkout-label">Пароль*</label>
<input type="password" class="w-input" maxlength="256" name="password" data-name="password" placeholder="" id="email" required="">
<input type="submit" value="Войти" data-wait="Please wait..." class="add-btn w-button"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
							</div>
							<div data-w-tab="Tab 2" class="account-tab-pane w-tab-pane">
								<div class="w-form">
									<form id="register_form" name="register_form" data-name="register_form" class="form" method="post" action="/index.php">
<label for="name-2" class="checkout-label">Email*</label>
<input type="text" class="w-input" maxlength="256" name="email" data-name="email" placeholder="" id="name-2">
<input type="submit" value="Зарегистрироваться" data-wait="Please wait..." class="add-btn w-button"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
							</div>
							<div data-w-tab="Tab 3" class="account-tab-pane w-tab-pane w--tab-active">
								<div class="w-form">
									<form id="recover_form" name="recover_form" data-name="recover_form" data-subject="Новый пароль" data-message="Ваш новый пароль:" class="form" method="post" action="/index.php">
<label for="name-3" class="checkout-label">Email*</label>
<input type="text" class="w-input" maxlength="256" name="email" data-name="email" placeholder="" id="name-2">
<input type="submit" value="Сбросить пароль" data-wait="Please wait..." class="add-btn w-button"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if( is_user_logged_in() ){ ?>
					<div data-duration-in="300" data-duration-out="100" class="account-tabs w-tabs">
						<div class="account-tab-menu w-tab-menu"><a data-w-tab="Tab 1" class="account-tab-link w-inline-block w-tab-link w--current"><div class="account-tab-title">МОИ ДАННЫЕ</div></a><a data-w-tab="Tab 2" class="account-tab-link w-inline-block w-tab-link"><div class="account-tab-title">МОИ ЗАКАЗЫ</div></a><a data-w-tab="Tab 3" class="account-tab-link w-inline-block w-tab-link"><div class="account-tab-title">МОИ ФАЙЛЫ</div></a></div>
						<div class="w-tab-content">
							<div data-w-tab="Tab 1" class="account-tab-pane w-tab-pane">
								<div class="w-form">
									<form id="update_billing" name="update_billing" data-name="update_billing" class="form" action="/index.php" data-action="update_billing">
										<h3 class="h3 account">КОНТАКТНАЯ ИНФОРМАЦИЯ</h3>
										<div class="order-row">
											<div class="account-col">
<label for="billing_first_name" class="checkout-label">Имя*</label>
<input type="text" class="w-input" maxlength="256" name="billing_first_name" data-name="billing_first_name" placeholder="" id="billing_first_name" value="<?php echo get_user_meta(get_current_user_id(), 'billing_first_name', true) ?>"></div>
											<div class="account-col">
<label for="billing_last_name" class="checkout-label">Фамилия</label>
<input type="email" class="w-input" maxlength="256" name="billing_last_name" data-name="billing_last_name" placeholder="" id="billing_last_name" required="" value="<?php echo get_user_meta(get_current_user_id(), 'billing_last_name', true) ?>"></div>
<label for="billing_address_" class="checkout-label">Адрес*</label>
<input type="text" class="w-input" maxlength="256" name="billing_address_1" data-name="billing_address_1" placeholder="" id="billing_address_" value="<?php echo get_user_meta(get_current_user_id(), 'billing_address_1', true) ?>">
											<div class="account-col">
<label for="billing_email" class="checkout-label">Email*</label>
<input type="text" class="w-input" maxlength="256" name="billing_email" data-name="billing_email" placeholder="" id="billing_email" value="<?php echo get_user_meta(get_current_user_id(), 'billing_email', true) ?>"></div>
											<div class="account-col">
<label for="billing_phone" class="checkout-label">Телефон*</label>
<input type="text" class="w-input" maxlength="256" name="billing_phone" data-name="billing_phone" placeholder="" id="billing_phone" value="<?php echo get_user_meta(get_current_user_id(), 'billing_phone', true) ?>"></div>
										</div>
<input type="submit" value="Сохранить изменения" data-wait="Please wait..." class="add-btn w-button"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
								<div class="w-form">
									<form id="update_password" name="update_password" data-name="update_password" class="form" action="/index.php" data-action="update_password">
										<h3 class="h3 account">сменить пароль</h3>
										<div class="order-row">
<label for="password_current" class="checkout-label">Текущий пароль*</label>
<input type="text" class="w-input" maxlength="256" name="password_current" data-name="password_current" placeholder="" id="password_current"></div>
										<div class="order-row">
<label for="password_" class="checkout-label">Новый пароль*</label>
<input type="text" class="w-input" maxlength="256" name="password_1" data-name="password_1" placeholder="" id="password_"></div>
										<div class="order-row">
<label for="password_-2" class="checkout-label">Подтвердить новый пароль*</label>
<input type="text" class="w-input" maxlength="256" name="password_2" data-name="password_2" placeholder="" id="password_-2"></div>
<input type="submit" value="Сохранить изменения" data-wait="Please wait..." class="add-btn w-button"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
								<div class="center"><a href="<?php echo wp_logout_url(home_url()) ?>" class="add-btn w-button">Выйти из аккаунта</a></div>
							</div>
							<div data-w-tab="Tab 2" class="account-tab-pane w-tab-pane w--tab-active">
								<div class="orders-list">
									<?php $orders = get_posts(apply_filters('woocommerce_my_account_my_orders_query', array(
	'numberposts' =>$order_count, 'meta_key' => '_customer_user', 'meta_value' => get_current_user_id(), 'post_type' => wc_get_order_types('view-orders'), 'post_status' => array_keys(wc_get_order_statuses()) ))); foreach($orders as $customer_order) { $order = wc_get_order($customer_order); $item_count = $order->get_item_count(); ?>
									<div class="order-item">
										<div data-w-id="cd8c4989-e6ab-ab71-c8ea-115aa0590a64" class="order-info">
											<div class="order-title">Заказ #<span><?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number(); ?></span><span class="order-toggle"> </span></div>
											<div class="order-info-box">
												<div class="order-date">
													<?php echo date( 'd.m.Y', strtotime( $order->order_date ) ); ?></div>
												<div class="order-status">
													<?php echo wc_get_order_status_name( $order->get_status() ); ?></div>
												<div class="opder-total">
													<?php echo $order->get_formatted_order_total() ?></div>
											</div>
										</div>
										<div style="height:0PX" class="order-details">
											<div class="order-products">
												<?php global $post; $n = 0; $items = $order->get_items(); foreach( $items as $item ){ $post = get_post($item["product_id"]); $n += 1; ?>
												<div class="order-row">
													<div class="order-photo" style="background-image: url('<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id($item['variation_id'] ? $item['variation_id'] : $item['product_id']), 'medium'); if(empty($img)) $img = wp_get_attachment_image_src(get_post_thumbnail_id($item['product_id']), 'medium'); echo $img[0]; ?>');"></div><a href="<?php echo $item->get_product()->get_permalink($item); ?>" class="order-cell link w-inline-block"><h3 class="h3 on-order"><?php echo $item['name'] ?></h3></a>
													<div class="order-cell">
														<div class="order-attr">цена: <span class="order-attr-value"><?php echo wc_price($item['line_total']/$item['qty']); ?></span></div>
														<div class="order-attr _2">количество: <span class="order-attr-value"><?php echo $item['qty'] ?></span></div>
														<div class="order-attr">сумма: <span class="order-attr-value"><?php echo wc_price($item['line_total']) ?></span></div>
													</div>
												</div>
												<?php } ?>
											</div>
											<div class="order-custom-info">
												<div class="order-attr">вид доставки: <span class="order-attr-value"><?php echo $order->get_shipping_to_display() ?></span></div>
											</div>
											<div class="order-custom-info">
												<div class="order-attr">вид оплаты: <span class="order-attr-value"><?php echo $order->get_payment_method_title() ?></span></div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
							<div data-w-tab="Tab 3" class="account-tab-pane w-tab-pane">
								<?php $downloads = WC()->customer->get_downloadable_products(); if ( $downloads ) : ?>
								<div class="account-files">
									<?php foreach ( $downloads as $download ) : ?><a href="<?php echo esc_url( $download['download_url'] ) ?>" class="account-file"><?php echo $download['download_name'] ?></a>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php } ?>
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