
					<div class="cart-row">
						<div class="cart-col-1"></div>
						<div class="cart-col-2">
							<div class="cart-title">Наименование</div>
						</div>
						<div class="cart-col-3">
							<div class="cart-title">Цена</div>
						</div>
						<div class="cart-col-4">
							<div class="cart-title">Кол-во</div>
						</div>
						<div class="cart-col-5">
							<div class="cart-title">Итого</div>
						</div>
						<div class="cart-col-6"></div>
					</div>
					<div class="cart-items"><?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
						<div class="cart-row">
							<div class="cart-col-1">
								<div class="cart-image" style="background-image: url(<?php echo $cart_item['variation_id'] == 0 || !get_the_post_thumbnail($cart_item['variation_id'], 'medium')
    ? get_the_post_thumbnail_url($cart_item['product_id'], 'medium') : get_the_post_thumbnail_url($cart_item['variation_id'], 'medium') ?>);"></div>
							</div>
							<div class="cart-col-2"><a wp="product_link" href="#" class="cart-link w-inline-block"><div class="cart-product-title"><?php $_product = $cart_item['data']; echo $_product->get_title(); ?></div></a>
								<?php if(is_object($cart_item['data']) && isset($cart_item['data']->attributes['pa_size'])){ ?><div class="cart-attr"><span class="cart-attr-title">Размер:</span> <span class="cart-attr-value"><?php if(isset($cart_item['data']->attributes['pa_size'])) { $attr = $cart_item['data']->attributes['pa_size']; if(is_object($attr)) { echo $cart_item['data']->attributes['pa_size']->get_terms()[0]->name; } else { echo get_term_by('slug',$cart_item['data']->attributes['pa_size'], 'pa_size')->name; }} ?></span></div><?php } ?>
								<?php if(is_object($cart_item['data']) && isset($cart_item['data']->attributes['pa_color'])){ ?><div class="cart-attr"><span class="cart-attr-title">цвет:</span> <span class="cart-color"> </span><span class="cart-attr-value"><?php if(isset($cart_item['data']->attributes['pa_color'])) { $attr = $cart_item['data']->attributes['pa_color']; if(is_object($attr)) { echo $cart_item['data']->attributes['pa_color']->get_terms()[0]->name; } else { echo get_term_by('slug',$cart_item['data']->attributes['pa_color'], 'pa_color')->name; }} ?></span></div><?php } ?>
							</div>
							<div class="cart-col-3">
								<?php $_product = $cart_item['data']; if($_product->get_price() !== $_product->get_sale_price()){ ?><div class="cart-price" data-content="product_price"><?php echo wc_price($_product->get_price()); ?></div><?php } ?>
								<?php $_product = $cart_item['data']; if($_product->get_price() === $_product->get_sale_price()){ ?><div class="cart-price sale" data-content="product_price"><?php echo wc_price($_product->get_sale_price()); ?></div><?php } ?>
								<?php $_product = $cart_item['data']; if($_product->get_price() === $_product->get_sale_price()){ ?><div class="cart-price regular" data-content="product_price"><?php echo wc_price($_product->get_regular_price()); ?></div><?php } ?>
							</div>
							<div class="cart-col-4">
								<div class="w-form">
									<form id="email-form" name="email-form" data-name="Email Form">
										<div class="add-count on-cart">
											<div class="change-count" data-action="cart_qty_minus">-</div><input type="text" class="count-input w-input" maxlength="256" name="qty" data-name="qty" required="" data-action="cart_product_qty" data-product-id="<?php echo $cart_item['variation_id'] == 0 ? $cart_item['product_id'] : $cart_item['variation_id'] ?>" value="<?php echo $cart_item['quantity'] ?>" data-qty-max="<?php $min_qty = $_product->get_stock_quantity() ? $_product->get_stock_quantity() : get_field('qty_max', $_product->get_id()); echo($min_qty ? $min_qty : 0); ?>"><div class="change-count" data-action="cart_qty_plus">+</div>
										</div>
									</form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
							</div>
							<div class="cart-col-5">
								<div class="cart-price"><?php $_product = $cart_item['data']; echo( WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] )); ?></div>
							</div>
							<div class="cart-col-6"><a href="#" class="cart-del w-inline-block" data-key="<?php echo $cart_item_key ?>" data-action="cart_product_remove"></a></div>
						</div>
						
					<?php } ?></div>
					<div class="cart-order-row">
						<div class="w-row">
							<div class="w-col w-col-4">
								<div class="w-form">
									<?php wc_print_notices(); ?><form id="add_coupon" name="add_coupon" data-name="add_coupon" class="coupon-form" data-action="add_coupon" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"><input type="text" class="coupon-input w-input" maxlength="256" name="coupon_code" data-name="coupon_code" placeholder="Купон на скидку" id="name"><input type="submit" value="Применить" data-wait="Please wait..." class="add-btn on-coupon w-button" name="apply_coupon" data-name="apply_coupon"></form>
									<div class="w-form-done">
										<div>Thank you! Your submission has been received!</div>
									</div>
									<div class="w-form-fail">
										<div>Oops! Something went wrong while submitting the form.</div>
									</div>
								</div>
							</div>
							<div class="cart-order-col w-col w-col-4"><a href="/checkout" class="add-btn w-button">Оформить заказ</a></div>
							<div class="cart-total-col w-col w-col-4">
								<div class="cart-total">Итого: <span class="cart-total-price" data-wc="cart_total"><?php echo WC()->cart->get_cart_total() ?></span></div>
							</div>
						</div>
					</div>
				