<div><?php global $wp_query; $query_args = !empty($args) ? $args : $wp_query->query;
        if (get_option('woocommerce_hide_out_of_stock_items') === 'yes'){ $query_args['meta_key'] = '_stock_status'; $query_args['meta_value'] = 'instock'; }
        $query = new WP_Query($query_args); if($query->have_posts()) : ?>
<div class="product-row" data-load-part="product" data-max-pages="<?php echo $query->max_num_pages ?>" data-current-page="<?php echo $query->query_vars['paged'] ? $query->query_vars['paged'] : 1 ?>">
<?php $rotation = 0; $group = 0; $post_index = 0; while($query->have_posts()) : $query->the_post(); 
        $rotation === 0 ? $rotation = 1 : $rotation++; 
        $group === 0 ? $group = 1 : $group++; $post_index++; ?>

							<div data-w-id="b2fb9578-9c61-a5a5-1c51-5fda7dd1a5ab" class="product-box">
								<div class="product-image"><img src="<?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo $img[0]; ?>" loading="lazy" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>" title="<?php echo get_the_title(get_post_thumbnail_id()) ?>"></div><a href="<?php the_permalink(); ?>" class="product-info w-inline-block"><h3 class="product-title"><?php the_title(); ?></h3><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( !$product->is_on_sale() || $product->product_type === 'variable') { ?><div class="product-price" data-content="product_price"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable') { ?><div class="product-price regular" data-content="product_price_regular"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_regular_price()) ?></div><?php }} ?><?php $product = get_product(get_the_ID()); if(is_object($product)){ if( $product->is_on_sale() && $product->product_type !== 'variable' ) { ?><div class="product-price sale" data-content="product_price_sale"><?php echo $product->product_type === 'variable' ? wc_price($product->get_variation_price()) : wc_price($product->get_sale_price()) ?></div><?php }} ?></a>
								<div class="product-actions on-catalog">
									<div class="action"></div>
									<div class="action _2"></div>
									<div class="action _3"></div>
								</div>
							</div>
							
							
							
						
<?php endwhile; ?></div>
<?php else : ?><div class="no-results" data-load-part="product">This is some text inside of a div block.</div><?php endif; unset($query_args); wp_reset_postdata(); ?></div>