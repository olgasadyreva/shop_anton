<?php
/*
Template name: Catalog
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f71dd8d024529b736d23055" data-wf-site="5f61f4d1741820a756fe13e1">
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
			<div class="bc-text"><a href="/" class="bc-link">Главная</a> <span class="bc-sep">/</span> <a href="/shop" class="bc-link">каталог</a><span class="bc-sep">/</span><span><?php the_archive_title(); ?></span></div>
		</div>
		<div class="page-section">
			<div class="container">
				<div class="shop-row">
					<div class="filter-col">
						<div class="aside-content">
							<h2 class="h2-aside">Категории</h2>
							<div class="aside-row">
								<?php $group = 0; $term_index = 0; $term_query = new WP_Term_Query(array('taxonomy' =>'product_cat')); if(is_array($term_query->terms)){foreach( $term_query->terms as $term ){ $group === 0 ? $group = 1 : $group++; $term_index++; ?> <a id="a" href="<?php echo get_term_link($term->term_id, $term->taxonomy); ?>" class="aside-link w-inline-block"><div><?php echo isset($term_query) ? $term->name : get_queried_object()->name ?></div><div>(<span><?php echo $term->count ?></span>)</div></a>
								<?php }} unset($term_query); ?>
							</div>
						</div>
						<div class="w-form">
							<form id="search_filter_ajax" name="search_filter_ajax" data-name="search_filter_ajax" action="<?php echo get_home_url() ?>/index.php#results" method="get" data-action="search_filter_ajax">
<input type="hidden" name="post_type" value="product">
								<div class="filter-box">
									<h2 class="h2-aside">цена</h2>
									<div class="price-range">
										<?php $range_value = get_range_meta_value('','_price','min'); ?>
<input type="text" class="price-input w-input" maxlength="256" name="min_pm__price" data-name="min_pm__price" id="min_pm__price" required="" value="<?php echo $_GET['min_pm__price'] != '' ? $_GET['min_pm__price'] : $range_value ?>" data-value="<?php echo $range_value ?>">
										<?php $range_value = get_range_meta_value('','_price','max'); ?>
<input type="text" class="price-input _2 w-input" maxlength="256" name="max_pm__price" data-name="max_pm__price" id="max_pm__price" required="" value="<?php echo $_GET['max_pm__price'] != '' ? $_GET['max_pm__price'] : $range_value ?>" data-value="<?php echo $range_value ?>"></div>
									<div class="price-box">
										<div class="price-slider" data-range-slider="_price" data-ui-slider="10"></div>
									</div>
								</div>
								<div class="filter-box">
									<h2 class="h2-aside">цвет</h2>
									<div class="attrs-list">
										<?php $term_query = get_terms(array('taxonomy' =>'pa_color', 'hide_empty' => true)); foreach ( $term_query as $term ) { ?>
<label class="w-checkbox attr-checkbox" data-taxonomy="pa_color">
<input type="checkbox" id="pa_color_<?php echo $term->slug ?>" name="pa_color[]" data-name="pa_color[]" class="w-checkbox-input checkbox" value="<?php echo($term->slug); if(is_array($_GET['pa_color']) && in_array($term->slug, $_GET['pa_color']) || strpos($_SERVER['REDIRECT_URL'], '/'.$term->slug.'/') !== false) echo('" checked = "checked'); ?>"><div class="attr-color" for="checkbox" style="background-color: <?php echo get_field('cvet', isset($term_query) ? $term->taxonomy.'_'.$term->term_id : get_queried_object()->taxonomy.'_'.get_queried_object()->term_id) ?>;"></div><span class="attr-label w-form-label" for="checkbox"><?php echo $term->name ?></span></label>
										<?php } unset($term_query); ?>
									</div>
								</div>
								<div class="filter-box">
									<h2 class="h2-aside">Размер</h2>
									<div class="attrs-list">
										<?php $term_query = get_terms(array('taxonomy' =>'pa_size', 'hide_empty' => true)); foreach ( $term_query as $term ) { ?>
<label class="w-checkbox attr-checkbox size" data-taxonomy="pa_size">
<input type="checkbox" id="pa_size_<?php echo $term->slug ?>" name="pa_size[]" data-name="pa_size[]" class="w-checkbox-input checkbox" value="<?php echo($term->slug); if(is_array($_GET['pa_size']) && in_array($term->slug, $_GET['pa_size']) || strpos($_SERVER['REDIRECT_URL'], '/'.$term->slug.'/') !== false) echo('" checked = "checked'); ?>"><span class="attr-label w-form-label" for="checkbox-2"><?php echo $term->name ?></span></label>
										<?php } unset($term_query); ?>
									</div>
								</div>
								<div class="filter-box">
									<h2 class="h2-aside">поиск по тексту</h2>
<input type="text" class="text-input w-input" maxlength="256" name="s" data-name="s" placeholder="Введите текст для поиска" id="field-3" value="<?php echo get_search_query() ?>">
									<h2 class="h2-aside">поиск по артикулу</h2>
<input type="text" class="text-input w-input" maxlength="256" name="pm__sku" data-name="pm__sku" placeholder="Введите артикул для поиска" id="pm__sku" value="<?php echo $_GET['pm__sku']; ?>">
									<h2 class="h2-aside">сортировать</h2>
<select id="search_sort" name="sort" class="w-select" data-name="sort"><option value="<?php echo 'date.desc'; if( $_GET['sort'] === 'date.desc') echo('" selected="selected'); ?>">По дате</option><option value="<?php echo 'title.asc'; if( $_GET['sort'] === 'title.asc') echo('" selected="selected'); ?>">По названию</option><option value="<?php echo 'meta_value_num._price.asc'; if( $_GET['sort'] === 'meta_value_num._price.asc') echo('" selected="selected'); ?>">По цене (сначала дешевле)</option><option value="<?php echo 'meta_value_num._price.desc'; if( $_GET['sort'] === 'meta_value_num._price.desc') echo('" selected="selected'); ?>">По цене (сначала дороже)</option>
</select>
									<h2 class="h2-aside">показывать по</h2>
<select id="search_posts_per_page" name="posts_per_page" class="w-select" data-name="posts_per_page"><option value="<?php echo '4'; if( $_GET['posts_per_page'] === '4' || get_option('posts_per_page')=== '4') echo('" selected="selected'); ?>">4</option><option value="<?php echo '8'; if( $_GET['posts_per_page'] === '8' || get_option('posts_per_page')=== '8') echo('" selected="selected'); ?>">8</option><option value="<?php echo '12'; if( $_GET['posts_per_page'] === '12' || get_option('posts_per_page')=== '12') echo('" selected="selected'); ?>">12</option><option value="<?php echo '16'; if( $_GET['posts_per_page'] === '16' || get_option('posts_per_page')=== '16') echo('" selected="selected'); ?>">16</option>
</select></div>
<input type="submit" value="Отобрать" data-wait="Please wait..." class="filter-btn w-button">
<input type="submit" value="Очистить" data-wait="Please wait..." class="reset-btn w-button" data-action="reset_filter"></form>
							<div class="w-form-done">
								<div>Thank you! Your submission has been received!</div>
							</div>
							<div class="w-form-fail">
								<div>Oops! Something went wrong while submitting the form.</div>
							</div>
						</div>
					</div>
					<div class="product-col">
						<?php include locate_template('template-parts/product.php'); ?>
						<div class="center"><a href="#" class="add-btn w-button" data-load="product" style="display:none;">Показать еще</a></div>
					</div>
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