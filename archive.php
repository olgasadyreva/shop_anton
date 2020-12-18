<?php
/*
Template name: Archive
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f8fe414851aeaf7a2f5480b" data-wf-site="5f61f4d1741820a756fe13e1">
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
			<div class="bc-text"><a href="/" class="bc-link">Главная</a> <span class="bc-sep">/</span> <a href="/blog" class="bc-link"><span class="bc-link">блог</span></a>  <span class="bc-sep">/</span> <a href="#" class="bc-link"><?php the_archive_title(); ?></a></div>
		</div>
		<div class="posts">
			<div class="container">
				<div class="post-content">
					<aside class="aside">
						<form action="<?php echo get_home_url() ?>/index.php#results" class="search w-form" method="get" id="search" name="search" data-name="search" data-action="search">
<input type="search" class="search-input w-input" maxlength="256" name="s" placeholder="Поиск" id="search" required="" data-name="s" value="<?php echo get_search_query() ?>">
<input type="submit" value="" class="search-button w-button"></form>
						<div class="aside-content">
							<h2 class="h2-aside">Категории</h2>
							<div class="aside-row">
								<?php $group = 0; $term_index = 0; $term_query = new WP_Term_Query(array('taxonomy' =>'category')); if(is_array($term_query->terms)){foreach( $term_query->terms as $term ){ $group === 0 ? $group = 1 : $group++; $term_index++; ?> <a id="a" href="<?php echo get_term_link($term->term_id, $term->taxonomy); ?>" class="aside-link w-inline-block"><div><?php echo isset($term_query) ? $term->name : get_queried_object()->name ?></div><div>(<span><?php echo $term->count ?></span>)</div></a>
								<?php }} unset($term_query); ?>
							</div>
						</div>
						<div class="aside-content">
							<h2 class="h2-aside">свежие посты</h2>
							<?php $query = new WP_Query('posts_per_page=3'); if($query->have_posts()) : ?>
							<div class="aside-posts">
								<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
								<div class="aside-post"><a href="<?php the_permalink(); ?>" class="aside-post-image w-inline-block" style='background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "full"); echo $img[0]; ?>);'></a>
									<div class="aside-post-content"><a href="<?php the_permalink(); ?>" class="aside-title-link w-inline-block"><h3 class="aside-post-title"><?php the_title(); ?></h3></a>
										<div class="blog-post-info aside-info">
											<div class="post-date">
												<?php echo get_the_date(get_option('date_format')); ?>
											</div>
											<div class="blog-info-separator">|<br></div>
											<div class="post-author">
												<?php the_author(); ?>
											</div>
										</div>
									</div>
								</div>
								<?php endwhile; ?>
							</div>
							<?php else : ?>
							<?php endif; unset($query_args); wp_reset_postdata(); ?>
						</div>
						<div class="aside-content">
							<h2 class="h2-aside">теги</h2>
							<div class="aside-tags">
								<?php $group = 0; $term_index = 0; $term_query = new WP_Term_Query(array('taxonomy' =>'post_tag')); if(is_array($term_query->terms)){foreach( $term_query->terms as $term ){ $group === 0 ? $group = 1 : $group++; $term_index++; ?> <a href="<?php echo get_term_link($term->term_id, $term->taxonomy); ?>" class="aside-tag"><?php echo $term->name ?></a>
								<?php }} unset($term_query); ?>
							</div>
						</div>
					</aside>
					<div class="posts-list">
						<?php $rotation = 0; if(have_posts()) : while(have_posts()) : the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; ?>
						<div class="blog-post _2"><a href="<?php the_permalink(); ?>" class="blog-photo mini w-inline-block" style='background-image: url(<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), "full"); echo $img[0]; ?>);'></a>
							<div class="blog-post-content _2"><a href="<?php the_permalink(); ?>" class="post-link w-inline-block"><h3 class="h3 _2"><?php the_title(); ?></h3></a>
								<div class="blog-post-info aside-info">
									<div class="post-date">
										<?php echo get_the_date(get_option('date_format')); ?>
									</div>
									<div class="blog-info-separator">|<br></div>
									<div class="post-author"><a href="<?php echo get_author_posts_url(get_the_author_meta( "ID" )) ?>" class="author-link"><?php the_author(); ?></a></div>
								</div>
								<div class="post-text _2">
									<?php the_excerpt(); ?>
								</div><a href="<?php the_permalink(); ?>" class="post-link w-inline-block"><div class="welcome-btn">Подробнее</div></a></div>
						</div>
						<?php endwhile; ?>
						<?php else : ?>
						<?php endif; wp_reset_postdata(); ?>
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