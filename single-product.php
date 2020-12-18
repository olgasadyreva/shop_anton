<?php
/*
Template name: Product
*/
?>
<!DOCTYPE html>
<!-- Last Published: Wed Dec 02 2020 13:43:13 GMT+0000 (Coordinated Universal Time) --><html data-wf-page="5f6f59fb174a7855439fb83d" data-wf-site="5f61f4d1741820a756fe13e1">
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
			<div class="container" data-content="product">
				<?php global $post; $post = get_post( get_the_ID() ); setup_postdata( $post ); $product = get_product(get_the_ID()); ?>
				<?php if( $product->product_type === "simple" ){ ?>
				<div class="product-view">
					<div class="product-gallery">
						<div data-duration-in="300" data-duration-out="100" class="product-gallery-tabs w-tabs">
							<div class="product-tab-menu w-tab-menu">
								<?php global $post, $product, $woocommerce; $i = 0; $attachment_ids = $product->get_gallery_attachment_ids(); if ( $attachment_ids ) { foreach ( $attachment_ids as $attachment_id ) { $i++; $props = wc_get_product_attachment_props( $attachment_id, $post ); ?><a data-w-tab='<?php echo "Tab ".$i; ?>' class="product-tab-link w-inline-block w-tab-link w--current" style="background-image: url('<?php echo $props["url"] ?>');"></a>
								<?php }} ?>
							</div>
							<div class="product-tab-content w-tab-content">
								<?php global $post, $product, $woocommerce; $i = 0; $attachment_ids = $product->get_gallery_attachment_ids(); if ( $attachment_ids ) { foreach ( $attachment_ids as $attachment_id ) { $i++; $props = wc_get_product_attachment_props( $attachment_id, $post ); ?>
								<div data-w-tab='<?php echo "Tab ".$i; ?>' class="product-main-image w-tab-pane w--tab-active" style="background-image: url('<?php echo $props["url"] ?>');"></div>
								<?php }} ?>
							</div>
						</div>
					</div>
					<div class="product-params">
						<h1 class="product-title on-product">
							<?php the_title(); ?>
						</h1>
						<?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?>
						<div class="product-main-price" data-content="product_price">
							<?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div>
						<?php }} ?>
						<?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?>
						<div class="product-main-price regular" data-content="product_price_regular">
							<?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div>
						<?php }} ?>
						<?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?>
						<div class="product-main-price sale" data-content="product_price_sale">
							<?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div>
						<?php }} ?>
						<div class="product-desc">
							<?php the_content(); ?>
						</div>
						<div class="w-form">
							<form id="add_to_cart_<?php echo get_the_ID() ?>" name="add_to_cart" data-name="add_to_cart" data-action="add_to_cart" action="/index.php" data-product-id='<?php $product = get_product(get_the_ID()); if($product->product_type === "variable"){ echo($product->get_available_variations()[0]["variation_id"]); } else { echo($product->id); } ?>' data-product_id="<?php the_ID(); ?>">
								<div class="add-box">
									<div class="add-count">
										<div class="change-count" data-action="product_qty_minus">-</div>
<input type="text" class="count-input w-input" maxlength="256" name="qty" data-name="qty" id="qty<?php echo get_the_ID() ?>" required="" data-action="product_qty" value="<?php $min_qty = get_field('qty_min'); echo($min_qty ? $min_qty : 1); ?>" data-qty-min="<?php $min_qty = get_field('qty_min'); echo($min_qty ? $min_qty : 1); ?>" data-qty-max="<?php $min_qty = $product->get_stock_quantity() ? $product->get_stock_quantity() : get_field('qty_max'); echo($min_qty ? $min_qty : 0); ?>" data-qty-step="<?php $min_qty = get_field('qty_step'); echo($min_qty ? $min_qty : 1); ?>">
										<div class="change-count" data-action="product_qty_plus">+</div>
									</div>
<input type="submit" value="Добавить в корзину" data-wait="Please wait..." class="filter-btn w-button"></div>
							</form>
							<div class="w-form-done">
								<div>Товар успешно добавлен в корзину!</div>
							</div>
							<div class="w-form-fail">
								<div>Oops! Something went wrong while submitting the form.</div>
							</div>
						</div>
						<div class="product-extra">
							<div class="extra-field"><span class="extra-title">Артикул:</span> <span class="extra-value" data-content="product_sku"><?php $product = get_product(get_the_ID()); echo($product->sku); ?></span></div>
							<div class="extra-field"><span class="extra-title">Категория:</span> <span class="extra-value"><?php $terms = get_the_terms(get_the_ID(), "product_cat"); if( is_array($terms) ) echo($terms[0]->name); ?></span></div>
							<div class="extra-field"><span class="extra-title">Теги:</span> <span class="extra-value"><?php $term_query = get_the_terms(get_the_ID(), 'product_tag'); $terms = []; foreach($term_query as $term) { $terms[] = $term->name; } echo implode(", ", $terms); ?></span></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if( $product->product_type === "variable" ){ ?>
				<div class="product-view">
					<div class="product-gallery">
						<div data-duration-in="300" data-duration-out="100" class="product-gallery-tabs w-tabs">
							<div class="product-tab-menu w-tab-menu">
								<?php global $post, $product, $woocommerce; $i = 0; $attachment_ids = $product->get_gallery_attachment_ids(); if ( $attachment_ids ) { foreach ( $attachment_ids as $attachment_id ) { $i++; $props = wc_get_product_attachment_props( $attachment_id, $post ); ?><a data-w-tab='<?php echo "Tab ".$i; ?>' class="product-tab-link w-inline-block w-tab-link w--current" style="background-image: url('<?php echo $props["url"] ?>');"></a>
								<?php }} ?>
							</div>
							<div class="product-tab-content w-tab-content">
								<?php global $post, $product, $woocommerce; $i = 0; $attachment_ids = $product->get_gallery_attachment_ids(); if ( $attachment_ids ) { foreach ( $attachment_ids as $attachment_id ) { $i++; $props = wc_get_product_attachment_props( $attachment_id, $post ); ?>
								<div data-w-tab='<?php echo "Tab ".$i; ?>' class="product-main-image w-tab-pane w--tab-active" style="background-image: url('<?php echo $props["url"] ?>');"></div>
								<?php }} ?>
							</div>
						</div>
					</div>
					<div class="product-params">
						<h1 class="product-title on-product">
							<?php the_title(); ?>
						</h1>
						<div class="product-main-price" data-content="var_price"></div>
						<div class="product-main-price regular" data-content="var_price_regular"></div>
						<div class="product-main-price sale" data-content="var_price_sale"></div>
						<div class="product-desc">
							<?php the_content(); ?>
						</div>
						<div class="w-form">
							<form id="add_to_cart_<?php echo get_the_ID() ?>" name="add_to_cart" data-name="add_to_cart" data-action="add_to_cart" action="/index.php" data-product-id='<?php $product = get_product(get_the_ID()); if($product->product_type === "variable"){ echo($product->get_available_variations()[0]["variation_id"]); } else { echo($product->id); } ?>' data-product_id="<?php the_ID(); ?>">
								<div class="product-attrs">
									<?php $product = get_product(get_the_ID()); $attrs = $product->get_attributes(); if( array_key_exists('pa_color', $attrs) ) { if( $attrs['pa_color']['variation'] ){ ?>
									<div class="product-attr">
										<h3 class="h3 on-attr">Цвет</h3>
										<div class="attrs-list">
											<?php $var_terms = []; $variation_attributes = $product->get_variation_attributes(); if( count($variation_attributes) > 0 ){ $var_terms = $variation_attributes['pa_color']; } foreach($var_terms as $var_term){ $term_query = []; $term = get_term_by('slug', $var_term, 'pa_color'); ?>
<label class="attr-radio w-radio" for="pa_color_<?php echo $var_term ?>">
<input type="radio" data-name="attribute_pa_color" id="pa_color_<?php echo $var_term ?>" name="attribute_pa_color" value="<?php echo $var_term ?>" class="w-form-formradioinput radio-button w-radio-input" data-attribute_name="attribute_pa_color"><span class="attr-label w-form-label"><?php echo isset($term_query) ? $term->name : get_queried_object()->name ?></span><div class="attr-color" style="background-color: <?php echo get_field('cvet', isset($term_query) ? $term->taxonomy.'_'.$term->term_id : get_queried_object()->taxonomy.'_'.get_queried_object()->term_id) ?>;"></div></label>
											<?php } unset($term_query); ?>
										</div>
									</div>
									<?php }} ?>
									<?php $product = get_product(get_the_ID()); $attrs = $product->get_attributes(); if( array_key_exists('pa_size', $attrs) ) { if( $attrs['pa_size']['variation'] ){ ?>
									<div class="product-attr">
										<h3 class="h3 on-attr">Размеры</h3>
										<div class="attrs-list">
											<?php $var_terms = []; $variation_attributes = $product->get_variation_attributes(); if( count($variation_attributes) > 0 ){ $var_terms = $variation_attributes['pa_size']; } foreach($var_terms as $var_term){ $term_query = []; $term = get_term_by('slug', $var_term, 'pa_size'); ?>
<label class="attr-radio size w-radio" for="pa_size_<?php echo $var_term ?>">
<input type="radio" data-name="attribute_pa_size" id="pa_size_<?php echo $var_term ?>" name="attribute_pa_size" value="<?php echo $var_term ?>" class="w-form-formradioinput radio-button w-radio-input" data-attribute_name="attribute_pa_size"><span class="attr-label w-form-label"><?php echo isset($term_query) ? $term->name : get_queried_object()->name ?></span></label>
											<?php } unset($term_query); ?>
										</div>
									</div>
									<?php }} ?>
								</div>
								<div class="add-box">
									<div class="add-count">
										<div class="change-count" data-action="product_qty_minus">-</div>
<input type="text" class="count-input w-input" maxlength="256" name="qty" data-name="qty" id="qty<?php echo get_the_ID() ?>" required="" data-action="product_qty" value="<?php $min_qty = get_field('qty_min'); echo($min_qty ? $min_qty : 1); ?>" data-qty-min="<?php $min_qty = get_field('qty_min'); echo($min_qty ? $min_qty : 1); ?>" data-qty-max="<?php $min_qty = $product->get_stock_quantity() ? $product->get_stock_quantity() : get_field('qty_max'); echo($min_qty ? $min_qty : 0); ?>" data-qty-step="<?php $min_qty = get_field('qty_step'); echo($min_qty ? $min_qty : 1); ?>">
										<div class="change-count" data-action="product_qty_plus">+</div>
									</div>
<input type="submit" value="Добавить в корзину" data-wait="Please wait..." class="filter-btn w-button"></div>
							</form>
							<div class="w-form-done">
								<div>Товар успешно добавлен в корзину!</div>
							</div>
							<div class="w-form-fail">
								<div>Oops! Something went wrong while submitting the form.</div>
							</div>
						</div>
						<div class="product-extra">
							<div class="extra-field"><span class="extra-title">Артикул:</span> <span class="extra-value" data-content="var_sku"><?php $product = get_product(get_the_ID()); echo($product->sku); ?></span></div>
							<div class="extra-field"><span class="extra-title">Категория:</span> <span class="extra-value"><?php $terms = get_the_terms(get_the_ID(), "product_cat"); if( is_array($terms) ) echo($terms[0]->name); ?></span></div>
							<div class="extra-field"><span class="extra-title">Теги:</span> <span class="extra-value"><?php $term_query = get_the_terms(get_the_ID(), 'product_tag'); $terms = []; foreach($term_query as $term) { $terms[] = $term->name; } echo implode(", ", $terms); ?></span></div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if(related_products()){ ?>
				<div class="product-selects">
					<h2 class="h2 _2">Похожие товары</h2>
					<?php $query = new WP_Query(get_related_products(4)); if($query->have_posts()) : ?>
					<div class="product-row">
						<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
						<div data-w-id="7d034ab5-f11c-52dd-8e6d-fe04dffa2da8" class="product-box">
							<div class="product-image"><img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" loading="lazy" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?php echo get_the_title(get_post_thumbnail_id()) ?>"></div><a href="<?php the_permalink(); ?>" class="product-info w-inline-block"><h3 class="product-title"><?php the_title(); ?></h3><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?><div class="product-price" data-content="product_price"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?><div class="product-price regular" data-content="product_price_regular"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?><div class="product-price sale" data-content="product_price_sale"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div><?php }} ?></a>
							<div class="product-actions on-catalog">
								<div class="action"></div>
								<div class="action _2"></div>
								<div class="action _3"></div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php else : ?>
					<?php endif; unset($query_args); wp_reset_postdata(); ?>
				</div>
				<?php } ?>
				<?php if(upsell_products()){ ?>
				<div class="product-selects">
					<h2 class="h2 _2">Вам также может понравиться</h2>
					<?php $query = new WP_Query(get_upsell_products(4)); if($query->have_posts()) : ?>
					<div class="product-row">
						<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
						<div data-w-id="4a027512-7203-591f-2a18-0cb4b6c0a4fc" class="product-box">
							<div class="product-image"><img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" loading="lazy" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?php echo get_the_title(get_post_thumbnail_id()) ?>"></div><a href="<?php the_permalink(); ?>" class="product-info w-inline-block"><h3 class="product-title"><?php the_title(); ?></h3><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?><div class="product-price" data-content="product_price"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?><div class="product-price regular" data-content="product_price_regular"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?><div class="product-price sale" data-content="product_price_sale"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div><?php }} ?></a>
							<div class="product-actions on-catalog">
								<div class="action"></div>
								<div class="action _2"></div>
								<div class="action _3"></div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php else : ?>
					<?php endif; unset($query_args); wp_reset_postdata(); ?>
				</div>
				<?php } ?>
				<?php if(crosssell_products()){ ?>
				<div class="product-selects">
					<h2 class="h2 _2">С этим товаром также покупают</h2>
					<?php $query = new WP_Query(get_crosssell_products(4)); if($query->have_posts()) : ?>
					<div class="product-row">
						<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
						<div data-w-id="f766caa7-0c12-c456-decb-6d04c835a921" class="product-box">
							<div class="product-image"><img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" loading="lazy" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?php echo get_the_title(get_post_thumbnail_id()) ?>"></div><a href="<?php the_permalink(); ?>" class="product-info w-inline-block"><h3 class="product-title"><?php the_title(); ?></h3><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?><div class="product-price" data-content="product_price"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?><div class="product-price regular" data-content="product_price_regular"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?><div class="product-price sale" data-content="product_price_sale"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div><?php }} ?></a>
							<div class="product-actions on-catalog">
								<div class="action"></div>
								<div class="action _2"></div>
								<div class="action _3"></div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php else : ?>
					<?php endif; unset($query_args); wp_reset_postdata(); ?>
				</div>
				<?php } ?>
				<?php if(viewed_products()){ ?>
				<div class="product-selects">
					<h2 class="h2 _2">Вы смотрели</h2>
					<?php $query = new WP_Query(get_viewed_products(4)); if($query->have_posts()) : ?>
					<div class="product-row">
						<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); $rotation === 0 ? $rotation = 1 : $rotation++; $group === 0 ? $group = 1 : $group++; $post_index++; ?>
						<div data-w-id="cf68420a-d998-6d41-05ce-366045c65940" class="product-box">
							<div class="product-image"><img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" loading="lazy" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?php echo get_the_title(get_post_thumbnail_id()) ?>"></div><a href="<?php the_permalink(); ?>" class="product-info w-inline-block"><h3 class="product-title"><?php the_title(); ?></h3><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?><div class="product-price" data-content="product_price"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?><div class="product-price regular" data-content="product_price_regular"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?><div class="product-price sale" data-content="product_price_sale"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div><?php }} ?></a>
							<div class="product-actions on-catalog">
								<div class="action"></div>
								<div class="action _2"></div>
								<div class="action _3"></div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php else : ?>
					<?php endif; unset($query_args); wp_reset_postdata(); ?>
				</div>
				<?php } ?>
				<div class="hide">
					<?php if(function_exists('dynamic_sidebar')) dynamic_sidebar('Товар'); ?>
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