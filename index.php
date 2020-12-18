<?php
/*
Template name: Главная
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f61f4d1bec55e7aef773a31" data-wf-site="5f61f4d1741820a756fe13e1">
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
		<div class="slider-section">
			<div class="slider-cont">
				<div data-animation="slide" data-duration="500" data-infinite="1" class="slider w-slider">
					<?php if( have_rows('slajdy') ){ ?>
					<div class="w-slider-mask">
						<?php global $parent_id; $parent_id = $loop_id; $loop_index = 0; $loop_field = "slajdy"; while( have_rows('slajdy') ){ global $loop_id; $loop_index++; $loop_id++; the_row(); ?>
						<div class="w-slide">
							<div class="slider-content" style="background-image:url('<?php $field = get_sub_field('foto'); if(isset($field['url'])){ echo($field['url']); }elseif(is_numeric($field)){ echo(wp_get_attachment_image_url($field, 'full')); }else{ echo($field); } ?>');">
								<div class="text-block"># <span><?php echo get_sub_field('teg_slajda') ?></span></div>
								<h2 class="slider-title">
									<?php echo get_sub_field('zagolovok') ?>
								</h2>
								<div class="slider-desc">
									<?php echo get_sub_field('opisanie') ?>
								</div><a href="#" class="slider-btn w-button">Каталог товара</a></div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="w-slider-arrow-left">
						<div class="slider-arrow w-icon-slider-left"></div>
					</div>
					<div class="w-slider-arrow-right">
						<div class="slider-arrow right w-icon-slider-right"></div>
					</div>
					<div class="w-slider-nav w-round"></div>
				</div>
			</div>
		</div>
		<?php if( have_rows('bannery') ){ ?>
		<div class="welcome-section">
			<?php global $parent_id; $parent_id = $loop_id; $loop_index = 0; $loop_field = "bannery"; while( have_rows('bannery') ){ global $loop_id; $loop_index++; $loop_id++; the_row(); ?>
			<div class="welcome-container w-container">
				<h2 class="h2-welcome-title">
					<?php echo get_sub_field('zagolovok') ?>
				</h2>
				<div class="welcome-row"><a href="<?php echo get_sub_field('ssylka_1') ?>" class="welcome-box left w-inline-block" style="background-image:url('<?php $field = get_sub_field('foto_1'); if(isset($field['url'])){ echo($field['url']); }elseif(is_numeric($field)){ echo(wp_get_attachment_image_url($field, 'full')); }else{ echo($field); } ?>');"><div class="text-block"># <span><?php echo get_sub_field('teg_1') ?></span></div></a><a href="<?php echo get_sub_field('ssylka_2') ?>" class="welcome-box center w-inline-block" style="background-image:url('<?php $field = get_sub_field('foto_2'); if(isset($field['url'])){ echo($field['url']); }elseif(is_numeric($field)){ echo(wp_get_attachment_image_url($field, 'full')); }else{ echo($field); } ?>');"><h2 class="heading"><?php echo get_sub_field('skidka') ?></h2><div class="text-block-3"><?php echo get_sub_field('opisanie_skidki') ?></div><div class="welcome-btn"><?php echo get_sub_field('tekst_knopki') ?></div></a><a href="<?php echo get_sub_field('ssylka_3') ?>" class="welcome-box right w-inline-block" style="background-image:url('<?php $field = get_sub_field('foto_3'); if(isset($field['url'])){ echo($field['url']); }elseif(is_numeric($field)){ echo(wp_get_attachment_image_url($field, 'full')); }else{ echo($field); } ?>');"><div class="text-block"># <span><?php echo get_sub_field('teg_2') ?></span></div></a></div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="catalog-section">
			<div class="container">
				<div class="center">
					<h2 class="h2">Каталог товаров</h2>
					<div class="catalog-desc">Мы предлагаем мужскую и женскую брендовую одежду высокого качества, по доступным ценам.<br>В нашем каталоге имеется более 5 000 товаров различных расцветок</div>
				</div>
				<div data-duration-in="300" data-duration-out="100" class="catalog-tabs w-tabs">
					<div class="catalog-tabs-menu w-tab-menu"><a data-w-tab="Tab 1" class="catalog-tabs-link w-inline-block w-tab-link w--current"><div>НОВИНКИ</div></a><a data-w-tab="Tab 2" class="catalog-tabs-link w-inline-block w-tab-link"><div>ПОПУЛЯРНОЕ</div></a><a data-w-tab="Tab 3" class="catalog-tabs-link w-inline-block w-tab-link"><div>СКИДКИ</div></a></div>
					<div class="w-tab-content">
						<div data-w-tab="Tab 1" class="w-tab-pane w--tab-active">
							<div class="product-row">
								<div data-w-id="8825e269-abe6-ea65-2270-9f69ef254894" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="f80fb1fb-170b-517d-1698-0cc9e899595e" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f779e495f3733790a75a_Rectangle-1.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="fd19ee70-4c62-e633-0821-189b74bdb9c7" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f77a245b53360eea1ee1_Rectangle-2_1.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="0e2a89f9-79c8-797e-88c1-a76301f5241a" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f77a14e11a327f6da2e5_Rectangle-3.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
							</div>
						</div>
						<div data-w-tab="Tab 2" class="w-tab-pane">
							<div class="product-row">
								<div data-w-id="fbd354fc-deed-4d2c-b5a0-ac3fe404a2af" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="fbd354fc-deed-4d2c-b5a0-ac3fe404a2bb" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="fbd354fc-deed-4d2c-b5a0-ac3fe404a2c7" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="fbd354fc-deed-4d2c-b5a0-ac3fe404a2d3" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
							</div>
						</div>
						<div data-w-tab="Tab 3" class="w-tab-pane">
							<div class="product-row">
								<div data-w-id="ce9388b2-283f-e7f4-322c-f3545b222cf3" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="ce9388b2-283f-e7f4-322c-f3545b222cff" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="ce9388b2-283f-e7f4-322c-f3545b222d0b" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
								<div data-w-id="ce9388b2-283f-e7f4-322c-f3545b222d17" class="product-box">
									<div class="product-image"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f778a20c5b36691a4a9e_Rectangle.jpg" loading="lazy" alt=""></div><a href="#" class="product-info w-inline-block"><h3 class="product-title">Название товара</h3><div class="product-price">1 500 ₽</div></a>
									<div style="-webkit-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(50PX, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0" class="product-actions">
										<div class="action"></div>
										<div class="action _2"></div>
										<div class="action _3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="review-section">
			<div class="container">
				<div data-duration-in="500" data-duration-out="100" data-easing="ease-in-out" class="review-tabs w-tabs">
					<div class="authors w-tab-menu"><a data-w-tab="Tab 1" class="author w-inline-block w-tab-link w--current"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f77c11cb5e64001d7df7_Rectangle-4_1Rectangle20(4).jpg" loading="lazy" alt="" class="author-img"></a><a data-w-tab="Tab 2" class="author w-inline-block w-tab-link"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f77871d98999cc56eafe_people3_1people3.jpg" loading="lazy" alt="" class="author-img"></a><a data-w-tab="Tab 3" class="author w-inline-block w-tab-link"><img src="<?php echo get_template_directory_uri() ?>/images/5f61f78396d7775a5ac23994_Rectangle-16-p-130x130q80.jpeg" loading="lazy" alt="" class="author-img"></a></div>
					<div class="w-tab-content">
						<div data-w-tab="Tab 1" class="w-tab-pane">
							<div class="review-content">
								<div class="review-text">Я редко пишу обзоры продуктов, но интернет-магазином Anton я более чем доволен. Заказал несколько товаров, в том числе: мужские брюки, футболку. Качество очень порадоволо, чистый хлопок и джинса, добавление других материалов по минимуму! Буду обращаться еще</div>
								<h3 class="h3-review-author">Денис Богданов</h3>
								<div class="author-info">Генеральный директор и основатель</div>
							</div>
						</div>
						<div data-w-tab="Tab 2" class="w-tab-pane">
							<div class="review-content">
								<div class="review-text">Я редко пишу обзоры продуктов, но интернет-магазином Anton я более чем доволен. Заказал несколько товаров, в том числе: мужские брюки, футболку. Качество очень порадоволо, чистый хлопок и джинса, добавление других материалов по минимуму! Буду обращаться еще</div>
								<h3 class="h3-review-author">Денис Богданов</h3>
								<div class="author-info">Генеральный директор и основатель</div>
							</div>
						</div>
						<div data-w-tab="Tab 3" class="w-tab-pane w--tab-active">
							<div class="review-content">
								<div class="review-text">Я редко пишу обзоры продуктов, но интернет-магазином Anton я более чем доволен. Заказал несколько товаров, в том числе: мужские брюки, футболку. Качество очень порадоволо, чистый хлопок и джинса, добавление других материалов по минимуму! Буду обращаться еще</div>
								<h3 class="h3-review-author">Денис Богданов</h3>
								<div class="author-info">Генеральный директор и основатель</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if( have_rows('blog') ){ ?>
		<div class="blog-section">
			<?php global $parent_id; $parent_id = $loop_id; $loop_index = 0; $loop_field = "blog"; while( have_rows('blog') ){ global $loop_id; $loop_index++; $loop_id++; the_row(); ?>
			<div class="container">
				<div class="center">
					<h2 class="h2">
						<?php echo get_sub_field('zagolovok') ?>
					</h2>
					<div class="text-block-4">
						<?php echo get_sub_field('opisanie') ?>
					</div>
				</div>
				<?php $query = new WP_Query('posts_per_page=3'); if($query->have_posts()) : ?>
				<div class="blog-row">
					<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
					<div class="blog-post"><a href="<?php the_permalink(); ?>" class="blog-photo w-inline-block" style='background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "full"); echo $img[0]; ?>);'></a>
						<div class="blog-post-content"><a href="<?php the_permalink(); ?>" class="post-link w-inline-block"><h3 class="h3">Классический стиль красивой жизни</h3></a>
							<div class="blog-post-info">
								<div class="post-date">
									<?php echo get_the_date(get_option('date_format')); ?>
								</div>
								<div class="blog-info-separator">|<br></div>
								<div class="post-author">
									<?php the_author(); ?>
								</div>
							</div>
							<div class="post-text">
								<?php the_excerpt(); ?>
							</div><a href="<?php the_permalink(); ?>" class="post-link w-inline-block"><div class="welcome-btn">Подробнее</div></a></div>
					</div>
					<?php endwhile; ?>
				</div>
				<?php else : ?>
				<?php endif; unset($query_args); wp_reset_postdata(); ?>
				<div class="center"><a href="#" class="blog-link">Перейти в блог</a></div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
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