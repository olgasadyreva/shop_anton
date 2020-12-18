<?php

defined('ABSPATH') || exit;

function ajaxs_load_product($jx)
{
    $id = $jx->data['id'];
    $part = $jx->data['part'];
    global $post;
    $post = get_post($id);
    setup_postdata($post);
    ob_start();
    require locate_template($part.'.php');
    $jx->html('[data-part='.$part.']', ob_get_clean());
    $jx->jseval('change_variations(); set_var_price();');
    $jx->jseval("Webflow.destroy(); Webflow.ready(); Webflow.require('ix2').init();");
}

function ajaxs_wc_login($jx)
{
    $result = wp_signon(array(
        'user_login'    => $jx->data['login'],
        'user_password' => $jx->data['password'],
        'remember'      => isset($jx->data['rememberme']) ? $jx->data['rememberme'] : 'forever',
    ));
    if (is_wp_error($result)) {
        $jx->error($result);
    } else {
        $jx->success();
    }
}

function ajaxs_wc_register($jx)
{
    $result = wc_create_new_customer($jx->data['email']);
    if (is_wp_error($result)) {
        $jx->error($result);
    } else {
        $jx->success();
    }
}

function ajaxs_wc_recover($jx)
{
    $email = $jx->data['email'];
    $user = get_user_by('email', $email);
    if ($user === false) {
        $jx->error($user);
    } else {
        $pass = wp_generate_password();
        wp_set_password($pass, $user->ID);
        $subject = $jx->data['subject'];
        if ($subject === 'undefined') {
            $subject = 'Ваш новый пароль';
        }
        $message = $jx->data['message'];
        if ($message === 'undefined') {
            $message = 'Ваш новый пароль:';
        }
        wp_mail($email, $subject, $message.' '.$pass);
        $jx->success();
    }
}

function ajaxs_load_variation($jx)
{
    $product_id = $jx->data['id'];
    $product = get_product($product_id);

    $attributes = $jx->data['variation_attributes'];
    if ($attributes === '') {
        $attributes = $product->default_attributes;
    }

    $variation_id = find_matching_product_variation($product, $attributes);

    if ($variation_id !== 0 && !is_null($variation_id)) {
        $product_variation = new WC_Product_Variation($variation_id);

        $price = $product_variation->get_price();
        $sale_price = $product_variation->get_sale_price();
        $regular_price = $product_variation->get_regular_price();
        $price === $sale_price ? $sale = true : $sale = false;

        $product_image = wp_get_attachment_image_src($product->get_image_id(), 'large');
        $variation_image = wp_get_attachment_image_src($product_variation->get_image_id(), 'large');

        $response = array(
      'id' => $variation_id,
      'attributes' => $attributes,
      'attributes_complete' => count($attributes) === count($product->get_attributes()),
      'title' => $product_variation->get_title(),
      'sku' => $product_variation->get_sku(),
      'stocked' => $product_variation->is_in_stock(),
      'stock_quantity' => $product_variation->get_stock_quantity(),
      'weight' => $product_variation->get_weight(),
      'length' => $product_variation->get_length(),
      'width' => $product_variation->get_width(),
      'height' => $product_variation->get_height(),
      'description' => $product_variation->get_description(),
      'price' => $sale ? '' : wc_price($product_variation->get_price()),
      'sale_price' => !$sale ? '' : wc_price($product_variation->get_sale_price()),
      'regular_price' => !$sale ? '' : wc_price($product_variation->get_regular_price()),
      'parent_image_url' => $product_image[0],
      'image_url' => $variation_image[0],
    );
    } else {
        $product_image = wp_get_attachment_image_src($product->get_image_id(), 'large');

        $response = array(
      'id' => 0,
            'attributes_complete' => count($attributes) === count($product->get_attributes()),
            'parent_image_url' => $product_image[0],
    );
    }

    //$jx->log($response);
    return $response;
}

function find_matching_product_variation($product, $attributes)
{
    //jx()->log('product', $product);
    foreach ($attributes as $key => $value) {
        if (strpos($key, 'attribute_') === 0) {
            continue;
        }
        unset($attributes[ $key ]);
        $attributes[ sprintf('attribute_%s', $key) ] = $value;
    }
    if (class_exists('WC_Data_Store')) {
        $data_store = WC_Data_Store::load('product');
        return $data_store->find_matching_product_variation($product, $attributes);
    } else {
        return $product->get_matching_variation($attributes);
    }
}

function get_current_shipping_cost()
{
    $method_data = explode(':', WC()->session->get('chosen_shipping_methods')[0]);
    $method = WC_Shipping_Zones::get_shipping_method($method_data[1]);
    return wc_price($method->cost);
}

function ajaxs_recalc_checkout($jx)
{
    WC()->session->set('chosen_shipping_methods', $jx->data['shipping_method']);
    WC()->session->set('chosen_payment_method', $jx->data['payment_method']);

    WC()->customer->set_props(
        array(
        'billing_postcode'  => isset($jx->data['billing_postcode']) ? wp_unslash($jx->data['billing_postcode']) : null,
        'billing_country'   => isset($jx->data['billing_country']) ? wp_unslash($jx->data['billing_country']) : null,
        'billing_state'     => isset($jx->data['billing_state']) ? wp_unslash($jx->data['billing_state']) : null,
        'billing_city'      => isset($jx->data['billing_city']) ? wp_unslash($jx->data['billing_city']) : null,
        'billing_address_1' => isset($jx->data['billing_address_1']) ? wp_unslash($jx->data['billing_address_1']) : null,
        'billing_address_2' => isset($jx->data['billing_address_2']) ? wp_unslash($jx->data['billing_address_2']) : null,
      )
    );

    WC()->customer->set_props(
        array(
        'shipping_postcode'  => isset($jx->data['billing_postcode']) ? wp_unslash($jx->data['billing_postcode']) : null,
        'shipping_country'   => isset($jx->data['billing_country']) ? wp_unslash($jx->data['billing_country']) : null,
        'shipping_state'     => isset($jx->data['billing_state']) ? wp_unslash($jx->data['billing_state']) : null,
        'shipping_city'      => isset($jx->data['billing_city']) ? wp_unslash($jx->data['billing_city']) : null,
        'shipping_address_1' => isset($jx->data['billing_address_1']) ? wp_unslash($jx->data['billing_address_1']) : null,
        'shipping_address_2' => isset($jx->data['billing_address_2']) ? wp_unslash($jx->data['billing_address_2']) : null,
      )
    );

    WC()->customer->set_calculated_shipping(true);
    WC()->customer->save();

    WC()->cart->calculate_totals();

    if (! isset(WC()->session->reload_checkout)) {
        $messages = wc_print_notices(true);
    } else {
        $messages = '';
    }

    unset(WC()->session->refresh_totals, WC()->session->reload_checkout);

    $shipping_methods = '';
    foreach (WC()->session->get('shipping_for_package_0')['rates'] as $method) {
        $selected = WC()->session->get('chosen_shipping_methods')[0] === $method->id ? 'selected' : '';
        $shipping_methods .= "<option $selected value=\"$method->id\">$method->label</option>\n";
    }

    $jx->html('#shipping_method', $shipping_methods);

    ob_start();
    get_template_part('checkout_total', '');
    $jx->html('[data-wc=checkout_total]', ob_get_clean());
}

add_action('pre_get_posts', 'custom_posts_per_page');
function custom_posts_per_page($query)
{
    if (!isset($_GET['perpage'])) {
        return false;
    }
    if ($_GET['perpage'] == '') {
        if (get_query_var('posts_per_page') === get_option('posts_per_page')) {
            $query->set('posts_per_page', get_option('posts_per_page'));
        }
    } else {
        if (get_query_var('posts_per_page') === get_option('posts_per_page')) {
            $query->set('posts_per_page', $_GET['perpage']);
        }
    }
}

function upsell_products()
{
    return get_post_meta(get_the_ID(), '_upsell_ids')[0];
}

function get_upsell_products($limit = 4)
{
    $args = array();
    $args['orderby'] = 'rand';
    $args['post_type'] = 'product';
    $args['posts_per_page'] = $limit;
    $args['post__in'] = upsell_products();
    return $args;
}

function crosssell_products()
{
    return get_post_meta(get_the_ID(), '_crosssell_ids')[0];
}

function get_crosssell_products($limit = 4)
{
    $args = array();
    $args['orderby'] = 'rand';
    $args['post_type'] = 'product';
    $args['posts_per_page'] = $limit;
    $args['post__in'] = crosssell_products();
    return $args;
}

function viewed_products()
{
    $viewed_products = ! empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
    $viewed_products = array_filter(array_map('absint', $viewed_products));
    return $viewed_products;
}

function get_viewed_products($limit = 4)
{
    $args = array();
    $args['orderby'] = 'rand';
    $args['post_type'] = 'product';
    $args['posts_per_page'] = $limit;
    $args['post__in'] = viewed_products();
    return $args;
}

function related_products($limit = 4)
{
    global $woocommerce;
    $id = get_the_ID();

    $tags_array = array(0);
    $cats_array = array(0);

    $terms = wp_get_post_terms($id, 'product_cat');
    foreach ($terms as $term) {
        $cats_array[] = $term->term_id;
    }

    if (sizeof($cats_array)==1 && sizeof($tags_array)==1) {
        return array();
    }

    $meta_query = array();
    $meta_query[] = $woocommerce->query->visibility_meta_query();
    $meta_query[] = $woocommerce->query->stock_status_meta_query();

    $related_posts = get_posts(apply_filters('woocommerce_product_related_posts', array(
    'orderby' => 'rand',
    'posts_per_page' => $limit,
    'post_type' => 'product',
    'fields' => 'ids',
    'meta_query' => $meta_query,
    'tax_query' => array(
    'relation' => 'OR',
    array(
    'taxonomy' => 'product_cat',
    'field' => 'id',
    'terms' => $cats_array
    ),
    array(
    'taxonomy' => 'product_tag',
    'field' => 'id',
    'terms' => $tags_array
    )
    )
    )));
    $related_posts = array_diff($related_posts, array( $id ));
    return $related_posts;
}

function get_related_products($limit = 4)
{
    $args = array();
    $args['orderby'] = 'rand';
    $args['post_type'] = 'product';
    $args['posts_per_page'] = $limit;
    $args['post__in'] = related_products($limit);
    return $args;
}

add_action('wp', 'login_redirect');
function login_redirect()
{
    global $post;
    if (!is_user_logged_in() && ($post->post_name === 'my-orders' || $post->post_name === 'my-data')) {
        wp_redirect(site_url().'/my-account');
        exit;
    }
}

add_action('template_redirect', 'head_hook');
function head_hook_()
{
    if (WC()->cart->cart_contents_count != 0 && is_page('cart')) {
        wp_redirect(home_url('/checkout'));
        exit();
    }
}

function get_product_variation_price($variation_id)
{
    global $woocommerce;
    $product = new WC_Product_Variation($variation_id);
    return $product->get_price_html();
}

function ajaxs_update_user($jx)
{
    $user_id = wp_update_user(array(
            'ID' => get_current_user_id(),
            'first_name' => $jx->data['first_name'],
            'last_name' => $jx->data['last_name'],
            'user_email' => $jx->data['user_email'],
        ));
    if (!is_wp_error($user_id)) {
        $jx->jseval("$('[name=update_user]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
    } else {
        $jx->jseval("$('[name=update_user]').siblings('.w-form-fail').fadeIn().delay(3000).fadeOut();");
    }
}

function ajaxs_update_password($jx)
{
    $user = get_userdata(get_current_user_id());
    if ($jx->data['password_1'] != $jx->data['password_2']) {
        $jx->jseval("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Пароли не одинаковы.').fadeIn().delay(3000).fadeOut();");
    } elseif ($jx->data['password_1'] === '') {
        $jx->jseval("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Пароли не задан.').fadeIn().delay(3000).fadeOut();");
    } elseif (!wp_check_password($jx->data['password_current'], $user->data->user_pass)) {
        $jx->jseval("$('[name=update_password]').siblings('.w-form-fail').text('Ошибка! Текущий пароль указан не верно.').fadeIn().delay(3000).fadeOut();");
    } else {
        wp_set_password($jx->data['password_1'], get_current_user_id());
        $jx->jseval("$('[name=update_password]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
    }
}

function ajaxs_update_billing($jx)
{
    foreach ($jx->data as $field => $value) {
        if ($field !== 'ajaxs_nonce') {
            update_user_meta(get_current_user_id(), $field, $value);
        }
    }
    $jx->jseval("$('[name=update_billing]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
}

function ajaxs_update_shipping($jx)
{
    foreach ($jx->data as $field => $value) {
        if ($field !== 'ajaxs_nonce') {
            update_user_meta(get_current_user_id(), $field, $value);
        }
    }
    $jx->jseval("$('[name=update_shipping]').siblings('.w-form-done').fadeIn().delay(3000).fadeOut();");
}

function ajaxs_add_to_cart($jx)
{
    $result = WC()->cart->add_to_cart(
        $jx->data['product_id'],
        $jx->data['qty'],
        $jx->data['variation_id'],
        $jx->data['variation_attributes'],
        $jx->data['item_data']
    );

    if (!$result) {
        $jx->error();
    }
    
    $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
    $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());

    ob_start();
    get_template_part('mini_cart', '');
    $jx->html('[data-wc=mini_cart]', ob_get_clean());

    $jx->jseval('change_cart_qty(); remove_from_cart();');

    if (get_option('woocommerce_cart_redirect_after_add') === 'yes') {
        $jx->redirect(wc_get_cart_url());
    }
}

function ajaxs_add_to_wl($jx)
{
    YITH_WCWL()->details['add_to_wishlist'] = $jx->data['id'];
    YITH_WCWL()->add();
    $jx->html('[data-wc=wl_count]', YITH_WCWL()->count_products());
}

function ajaxs_wl_remove($jx)
{
    $query_args[ 'is_default' ] = 1;
    $wishlist_items = YITH_WCWL()->get_products($query_args);
    foreach ($wishlist_items as $item) {
        if (in_array($item['prod_id'], $jx->data['id']) || $jx->data['id'][0] === 'all') {
            YITH_WCWL()->details['remove_from_wishlist'] = $item['prod_id'];
            YITH_WCWL()->remove();
        }
    }

    ob_start();
    get_template_part('full_wishlist', '');

    $jx->html('[data-wc=full_wishlist]', ob_get_clean());
    $jx->jseval('set_var_price()');
    $jx->html('[data-wc=wl_count]', YITH_WCWL()->count_products());
}

function ajaxs_wl_move($jx)
{
    $query_args[ 'is_default' ] = 1;
    $wishlist_items = YITH_WCWL()->get_products($query_args);
    foreach ($wishlist_items as $item) {
        if (in_array(xc, $jx->data['id'])) {
            WC()->cart->add_to_cart($item['prod_id']);
            YITH_WCWL()->details['remove_from_wishlist'] = $item['prod_id'];
            YITH_WCWL()->remove();
        }
    }
    
    ob_start();
    get_template_part('full_wishlist', '');
    $jx->html('[data-wc=full_wishlist]', ob_get_clean());

    $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
    $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
    $jx->html('[data-wc=wl_count]', YITH_WCWL()->count_products());
    
    ob_start();
    get_template_part('mini_cart', '');
    $jx->html('[data-wc=mini_cart]', ob_get_clean());
}

function ajaxs_wl_copy($jx)
{
    $query_args[ 'is_default' ] = 1;
    $wishlist_items = YITH_WCWL()->get_products($query_args);
    foreach ($wishlist_items as $item) {
        if (in_array($item['prod_id'], $jx->data['id'])) {
            WC()->cart->add_to_cart($item['prod_id']);
        }
    }

    ob_start();
    get_template_part('full_wishlist', '');
    $jx->html('[data-wc=full_wishlist]', ob_get_clean());
    
    ob_start();
    get_template_part('mini_cart', '');

    $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
    $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());

    $jx->html('[data-wc=mini_cart]', ob_get_clean());
}

function ajaxs_cart_remove($jx)
{
    WC()->cart->remove_cart_item($jx->data['key']);
    $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
    $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
    
    ob_start();
    get_template_part('full_cart', '');
    $jx->html('[data-wc=full_cart]', ob_get_clean());
    
    ob_start();
    get_template_part('order_cart', '');
    $jx->html('[data-wc=order_cart]', ob_get_clean());
    
    ob_start();
    get_template_part('mobile_cart', '');
    $jx->html('[data-wc=mobile_cart]', ob_get_clean());
    
    ob_start();
    get_template_part('mini_cart', '');
    
    $jx->html('[data-wc=mini_cart]', ob_get_clean());
    $jx->jseval('change_cart_qty();');
}

function ajaxs_change_cart_qty($jx)
{
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['variation_id'] == 0) {
            $product_id = $cart_item['product_id'];
        } else {
            $product_id = $cart_item['variation_id'];
        }
        if ($product_id == $jx->data['id']) {
            WC()->cart->set_quantity($cart_item_key, $jx->data['qty']);
        }
    }
    $jx->html('[data-wc=cart_count]', WC()->cart->cart_contents_count);
    $jx->html('[data-wc=cart_total]', WC()->cart->get_cart_total());
    ob_start();
    get_template_part('full_cart', '');
    $jx->html('[data-wc=full_cart]', ob_get_clean());
    ob_start();
    get_template_part('order_cart', '');
    $jx->html('[data-wc=order_cart]', ob_get_clean());
    ob_start();
    get_template_part('mobile_cart', '');
    $jx->html('[data-wc=mobile_cart]', ob_get_clean());
    ob_start();
    get_template_part('mini_cart', '');
    $jx->html('[data-wc=mini_cart]', ob_get_clean());
    $jx->jseval('change_cart_qty();	remove_from_cart();');
}

add_filter('woocommerce_currencies', 'add_my_currency');
function add_my_currency($currencies)
{
    $currencies['RUB1'] = __('Российский рубль 1', 'woocommerce');
    $currencies['RUB2'] = __('Российский рубль 2', 'woocommerce');
    return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
          case 'RUB1': $currency_symbol = 'Р.'; break;
          case 'RUB2': $currency_symbol = 'руб'; break;
      }
    return $currency_symbol;
}
