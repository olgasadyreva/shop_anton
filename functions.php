<?php

defined('ABSPATH') || exit;

$theme_version = '1608268667';
$wtw_version = 'wtw6';

add_action('init', 'get_theme_path');
function get_theme_path()
{
    if (isset($_GET['theme_path'])) {
        echo get_bloginfo('template_url');
        exit;
    }
}

if (isset($_GET['update_version'])) {
    echo $theme_version;
    exit;
}


if ($wtw_version === 'wtw6') {
    add_filter('use_block_editor_for_post_type', '__return_false', 100);

    define('MY_ACF_PATH', get_stylesheet_directory() . '/vendor/acf/');
    define('MY_ACF_URL', get_stylesheet_directory_uri() . '/vendor/acf/');
    include_once(MY_ACF_PATH . 'acf.php');
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url($url)
    {
        return MY_ACF_URL;
    }

    add_action('after_switch_theme', 'wtw_setup_options');
    function wtw_setup_options($old_name)
    {
        if (get_option('wtw_installed') !== '1') {
            add_option('wtw_installed', '1');
            update_option('show_on_front', 'page');
            update_option('page_on_front', '2');
            update_option('permalink_structure', '/%postname%/');
            update_option('wtw_settings_changed', true);
        }
    }

    add_action('admin_head', 'editor_full_width_gutenberg');
    if (!function_exists('editor_full_width_gutenberg')) {
        function editor_full_width_gutenberg()
        {
            echo '<style>
			body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
			max-width: none !important;
		}
			.block-editor__container .wp-block {
					max-width: none !important;
			}
		</style>';
        }
    }

    if (!function_exists('ctl_sanitize_title')) {
        function ctl_sanitize_title($title)
        {
            global $wpdb;

            $iso9_table = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
            'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
            'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
            'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
            'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'c',
            'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
            'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
            'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
            'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
            'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
            'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '',
            'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
        );
            $geo2lat = array(
            'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
            'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
            'ნ' => 'n', 'ო' => 'o', 'პ' => 'p','ჟ' => 'zh','რ' => 'r','ს' => 's',
            'ტ' => 't','უ' => 'u','ფ' => 'ph','ქ' => 'q','ღ' => 'gh','ყ' => 'qh',
            'შ' => 'sh','ჩ' => 'ch','ც' => 'ts','ძ' => 'dz','წ' => 'ts','ჭ' => 'tch',
            'ხ' => 'kh','ჯ' => 'j','ჰ' => 'h'
        );
            $iso9_table = array_merge($iso9_table, $geo2lat);

            $locale = get_locale();
            switch ($locale) {
            case 'bg_BG':
                $iso9_table['Щ'] = 'SCH';
                $iso9_table['щ'] = 'sch';
                $iso9_table['Ъ'] = 'A';
                $iso9_table['ъ'] = 'a';
                break;
            case 'uk':
            case 'uk_ua':
            case 'uk_UA':
                $iso9_table['И'] = 'Y';
                $iso9_table['и'] = 'y';
                break;
        }

            $is_term = false;
            $backtrace = debug_backtrace();
            foreach ($backtrace as $backtrace_entry) {
                if ($backtrace_entry['function'] == 'wp_insert_term') {
                    $is_term = true;
                    break;
                }
            }

            $term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
            if (empty($term)) {
                $title = strtr($title, apply_filters('ctl_table', $iso9_table));
                if (function_exists('iconv')) {
                    $title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
                }
                $title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
                $title = preg_replace('/\-+/', '-', $title);
                $title = preg_replace('/^-+/', '', $title);
                $title = preg_replace('/-+$/', '', $title);
            } else {
                $title = $term;
            }

            return $title;
        }
        add_filter('sanitize_title', 'ctl_sanitize_title', 9);
        add_filter('sanitize_file_name', 'ctl_sanitize_title');

        function ctl_convert_existing_slugs()
        {
            global $wpdb;

            $posts = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_name REGEXP('[^A-Za-z0-9\-]+') AND post_status IN ('publish', 'future', 'private')");
            foreach ((array) $posts as $post) {
                $sanitized_name = ctl_sanitize_title(urldecode($post->post_name));
                if ($post->post_name != $sanitized_name) {
                    add_post_meta($post->ID, '_wp_old_slug', $post->post_name);
                    $wpdb->update($wpdb->posts, array( 'post_name' => $sanitized_name ), array( 'ID' => $post->ID ));
                }
            }

            $terms = $wpdb->get_results("SELECT term_id, slug FROM {$wpdb->terms} WHERE slug REGEXP('[^A-Za-z0-9\-]+') ");
            foreach ((array) $terms as $term) {
                $sanitized_slug = ctl_sanitize_title(urldecode($term->slug));
                if ($term->slug != $sanitized_slug) {
                    $wpdb->update($wpdb->terms, array( 'slug' => $sanitized_slug ), array( 'term_id' => $term->term_id ));
                }
            }
        }

        function ctl_schedule_conversion()
        {
            add_action('shutdown', 'ctl_convert_existing_slugs');
        }
        register_activation_hook(__FILE__, 'ctl_schedule_conversion');
    }

    if ($_GET['action'] === 'import_images' && is_user_logged_in()) {
        $import_images = scandir(TEMPLATEPATH.'/images');
        foreach ($import_images as $image) {
            $file = TEMPLATEPATH.'/images/'.$image;
            $filename = basename($file);
            $upload_file = wp_upload_bits($filename, null, file_get_contents($file));
            if (!$upload_file['error']) {
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_parent' => $parent_post_id,
      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
      'post_content' => '',
      'post_status' => 'inherit'
    );
                $attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $parent_post_id);
                if (!is_wp_error($attachment_id)) {
                    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_file['file']);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                }
            }
        }
        wp_redirect(home_url().'/wp-admin/tools.php?page=config&status=uploaded_media');
        exit;
    }

    function wtw_get_block_code($fields)
    {
        $webflow_css = file_get_contents(get_stylesheet_directory() . '/css/main.css');
        $post_content = '';
        foreach ($fields as $f) {
            if (!isset($f->sub_fields)) {
                if ($f->type === 'image') {
                    $ext = pathinfo($f->value, PATHINFO_EXTENSION);
                    $file = basename($f->value, ".".$ext);
                    $image_obj = get_page_by_title($file, OBJECT, 'attachment');
                    if ($image_obj != null) {
                        $f->value = $image_obj->ID;
                    }
                }
                if ($f->type === 'bg_image') {
                    $class = '.'.str_replace(' ', '.', $f->value);
                    $pattern = '/'.$class.'(\s?|-.+)(\{(\n|.)*?\})/i';
                    preg_match_all($pattern, $webflow_css, $matches);
                    $pattern = '/..\/[^;,]+(jpg|jpeg|png|gif|svg)/';
                    $image_css = $matches[0][0];
                    preg_match_all($pattern, $image_css, $image);
                    $image = basename($image[0][0]);
                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                    $file = basename($image, ".".$ext);
                    $image_obj = get_page_by_title($file, OBJECT, 'attachment');
                    if ($image_obj != null) {
                        $f->value = $image_obj->ID;
                    }
                }
                $post_content .= '"'.$f->key.'" : "'.$f->value.'",'."\n";
            } else {
                $post_content .= '"'.$f->key.'" : {'."\n";
                $post_content .= wtw_get_block_code($f->sub_fields);
                $post_content .= '},'."\n";
            }
        }
        return $post_content;
    }

    function wtw_get_meta_code($fields)
    {
        $webflow_css = file_get_contents(get_stylesheet_directory() . '/css/main.css');

        $meta_array = [];
        
        foreach ($fields as $k => $f) {
            if (!isset($f->sub_fields)) {
                if ($f->type === 'image') {
                    $ext = pathinfo($f->value, PATHINFO_EXTENSION);
                    $file = basename($f->value, ".".$ext);
                    $image_obj = get_page_by_title($file, OBJECT, 'attachment');
                    if ($image_obj != null) {
                        $f->value = $image_obj->ID;
                    }
                }

                if ($f->type === 'bg_image') {
                    $class = '.'.str_replace(' ', '.', $f->value);
                    $pattern = '/'.$class.'(\s?|-.+)(\{(\n|.)*?\})/i';
                    preg_match_all($pattern, $webflow_css, $matches);
                    $pattern = '/..\/[^;,]+(jpg|jpeg|png|gif|svg)/';
                    $image_css = $matches[0][0];
                    preg_match_all($pattern, $image_css, $image);
                    $image = basename($image[0][0]);
                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                    $file = basename($image, ".".$ext);
                    $image_obj = get_page_by_title($file, OBJECT, 'attachment');
                    if ($image_obj != null) {
                        $f->value = $image_obj->ID;
                    }
                }
                if ($f->type !== 'index') {
                    $meta_array[$f->name] = $f->value;
                }
            } else {
                if ($f->type === 'group' || $f->type === 'loop') {
                    $meta_array['_'.$f->name] = $f->key;
                }
                if ($f->type === 'loop') {
                    $meta_array[$f->name] = count($f->sub_fields);
                }
                $meta_array = array_merge($meta_array, wtw_get_meta_code($f->sub_fields));
            }
        }
        return $meta_array;
    }

    function wtw_import_data()
    {
        $import_data = json_decode(file_get_contents(get_stylesheet_directory() . '/pages.json'));
        
        $page_index = 0;
        foreach ($import_data as $page) {
            if (!in_array($page->slug, [
                'home',
                'front-page',
                'archive',
                'search',
                'taxonomy',
                'category',
                'tag',
                'date',
                'author',
                'attachment',
                'single',
                'page',
                'page-cart',
                'page-checkout',
                'page-my-account'
                ])
                & strpos($page->slug, 'archive-') !== 0
                & strpos($page->slug, 'taxonomy-') !== 0
                & strpos($page->slug, 'category-') !== 0
                & strpos($page->slug, 'tag-') !== 0
                & strpos($page->slug, 'author-') !== 0
                & strpos($page->slug, 'single-') !== 0) {
                $page_index++;
                if ($page->slug === 'index') {
                    $front_page_id = get_option('page_on_front');
                    if (is_numeric($front_page_id)) {
                        $post_id = (int)$front_page_id;
                    } else {
                        $post_id = 0;
                    }
                } else {
                    if (strpos($page->slug, 'page-') === 0) {
                        $post_name = str_replace('page-', '', $page->slug);
                    } else {
                        $post_name = $page->slug;
                    }
                    $post = get_page_by_path($post_name);
                    if ($post) {
                        $post_id = $post->ID;
                    } else {
                        $post_id = 0;
                    }
                }
                $post_data = array(
                    'ID' => $post_id,
                    'menu_order' => $page_index,
                    'post_type' => 'page',
                    'post_name' => $post_name,
                    'post_title'    => wp_strip_all_tags($page->title),
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_content'  => '',
                    'meta_input' => array( '_wp_page_template' => $page->slug.'.php' )
                );
                if ($page->slug !== 'theme-options') {
                    $post_id = wp_insert_post($post_data);
                }
            }

            $post_content = '';
            $meta_code = [];
            $fields = [];
            $i = 0;

            //dd($page->blocks);
                    
            foreach ($page->blocks as $block) {
                $i++;
                if ($block->block_type === 'block') {
                    $post_content .= "<!-- wp:acf/{$block->block_id}\n";
                    $post_content .= '{'."\n";
                    $post_content .= '"id" : "block_'.$i.'",'."\n";
                    $post_content .= '"name" : "acf/'.$block->block_id.'",'."\n";
                    $post_content .= '"data" : {'."\n";
                    $post_content .= wtw_get_block_code($block->fields);
                    $post_content .= '},'."\n";
                    $post_content = str_replace("\",\n}", "\"\n}", $post_content);
                    $post_content = str_replace("},\n}", "}\n}", $post_content);
                    $post_content .= '"align" : "",'."\n";
                    $post_content .= '"mode" : "edit"'."\n";
                    $post_content .= '} /-->'."\n";
                }
                if ($block->block_type === 'meta') {
                    $meta_code = wtw_get_meta_code($block->fields);
                }
            }

            if ($post_content != '') {
                $my_post = array();
                $my_post['ID'] = $post_id;
                $my_post['post_name'] = $page->slug;
                $my_post['post_title'] = $page->title;
                $my_post['post_content'] = $post_content;
                wp_update_post(wp_slash($my_post));
                file_put_contents(get_stylesheet_directory()."/index.json", $post_content, LOCK_EX);
            }

            //d($meta_code);
                
            if (count($meta_code)) {
                foreach ($meta_code as $field => $value) {
                    $value = html_entity_decode($value, ENT_QUOTES);
                    if ($page->slug !== 'theme-options') {
                        update_post_meta($post_id, $field, $value);
                    } else {
                        update_option('options_'.$field, $value);
                    }
                }
            }
        }
    }

    if ($_GET['action'] === 'import_data' && is_user_logged_in()) {
        wtw_import_data();
        wp_redirect(home_url().'/wp-admin/tools.php?page=config&status=uploaded_data');
        exit;
    }
}

add_action('admin_head', 'editor_full_width_taxonomy');
if (!function_exists('editor_full_width_taxonomy')) {
    function editor_full_width_taxonomy()
    {
        echo '<style>#edittag{max-width: none !important;}</style>';
    }
}

if (file_exists(dirname(__FILE__).'/dynamic_functions.php')) {
    include_once 'dynamic_functions.php';
}
if (file_exists(dirname(__FILE__).'/shop_functions.php')) {
    include_once 'shop_functions.php';
}
if (file_exists(dirname(__FILE__).'/configurator.php')) {
    include_once 'configurator.php';
}
if (file_exists(dirname(__FILE__).'/custom_functions.php')) {
    include_once 'custom_functions.php';
}

require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (file_exists(dirname(__FILE__).'/vendor/ajax-simply') && !is_plugin_active('ajax-simply/ajax-simply.php')) {
    include_once 'vendor/ajax-simply/ajax-simply.php';
}

if (file_exists(dirname(__FILE__).'/vendor/classic-editor') && !is_plugin_active('classic-editor/classic-editor.php')) {
    include_once 'vendor/classic-editor/classic-editor.php';
}

add_theme_support('menus');
add_theme_support('woocommerce');
add_theme_support('post-thumbnails');
add_filter('widget_text', 'do_shortcode');
add_theme_support('title-tag');

add_action('admin_enqueue_scripts', 'add_admin_scripts');
function add_admin_scripts()
{
    wp_register_script('libs_script', get_template_directory_uri().'/js/libs.js', array('jquery'), false, true);
    wp_enqueue_script('libs_script');
    wp_register_script('admin_script', get_template_directory_uri().'/js/admin.js', array('jquery'), false, true);
    wp_enqueue_script('admin_script');
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}

add_action('wp_enqueue_scripts', 'add_site_scripts');
function add_site_scripts()
{
    global $theme_version;
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
    wp_deregister_script('jquery-core');
    wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, false, true);
    wp_enqueue_script('jquery');
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', [], '1594356350');
}

add_filter('wp_default_scripts', 'remove_jquery_migrate');
function remove_jquery_migrate(&$scripts)
{
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array( 'jquery-core' ), '1.12.4');
    }
}

if (!is_admin()) {
    wp_enqueue_script("jquery-ui-core", array('jquery'));
    wp_enqueue_script(
        "jquery-ui-slider",
        array('jquery','jquery-ui-core')
    );
}

if (!function_exists('slugify')) {
    function slugify($text)
    {
        $translation = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh',
        'щ' => 'sch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'і' => 'i',
        'ї' => 'yi', 'є' => 'ye', 'ґ' => 'g', 'е' => 'e', 'ё' => 'e',
        '\'' => '', '"' => '', '`' => '', 'ь' => '', 'ъ' => ''
    ];
        $text = trim($text);
        $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8");
        $text = strtr($text, $translation);
        $text = preg_replace('~(\W+)~', '_', $text);
        $text = trim($text, '_');
        $text = strtolower($text);
        return $text;
    }
}

function get_layout_var($layout_field, $layout_name, $sub_field, $post_id = '')
{
    if ($post_id === '') {
        $post_id = get_the_ID();
    }
    foreach (get_field($layout_field, $post_id) as $layout) {
        if ($layout['acf_fc_layout'] === $layout_name) {
            return $layout[$sub_field];
        }
    }
    return '';
}

function get_range_meta_value($post_type, $meta_field, $range)
{
    global $wpdb;
    $value = $wpdb->get_var("SELECT $range(CAST(meta_value AS UNSIGNED)) FROM `{$wpdb->prefix}postmeta` WHERE meta_key = '$meta_field'");
    if ($value == '') {
        $value = 0;
    }
    return $value;
}

function getTerm($term_name)
{
    $terms = get_the_terms(get_the_ID(), $term_name);
    return $terms[0]->name ;
}

function getCatID()
{
    global $wp_query;
    if (is_category() || is_single()) {
        $cat_ID = get_query_var('cat');
    }
    return $cat_ID;
}

add_shortcode('show_file', 'show_file_func');
function show_file_func($atts)
{
    extract(shortcode_atts(array(
      'file' => ''
    ), $atts));
    if ($file!='') {
        return @file_get_contents($file);
    }
}

if (is_admin()) {
    foreach (get_taxonomies() as $taxonomy) {
        add_action("manage_edit-${taxonomy}_columns", 'tax_add_col');
        add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
        add_filter("manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3);
    }
    add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
    function tax_add_col($columns)
    {
        return $columns + array('tax_id' => 'ID');
    }
    function tax_show_id($v, $name, $id)
    {
        return 'tax_id' === $name ? $id : $v;
    }
    function tax_id_style()
    {
        print '<style>#tax_id{width:4em}</style>';
    }

    add_filter('manage_posts_columns', 'posts_add_col', 5);
    add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
    add_filter('manage_pages_columns', 'posts_add_col', 5);
    add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
    add_action('admin_print_styles-edit.php', 'posts_id_style');
    function posts_add_col($defaults)
    {
        $defaults['wps_post_id'] = __('ID');
        return $defaults;
    }
    function posts_show_id($column_name, $id)
    {
        if ($column_name === 'wps_post_id') {
            echo $id;
        }
    }
    function posts_id_style()
    {
        print '<style>#wps_post_id{width:4em}</style>';
    }
}

function isCurrentLink($test_link)
{
    if ($test_link == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] || ($test_link == site_url().'/' && substr_count(get_permalink(), 'p=') != 0)) {
        $current_class = ' w--current';
    } else {
        $current_class = '';
    }
    return $current_class;
}

function get_id_by_slug($page_slug)
{
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function posts_schet_class()
{
    global $post_num;
    if (++$post_num % 2) {
        $class = 'nechet';
    } else {
        $class = 'chet';
    }
    return $class;
}

function post_parity()
{
    global $post_num;
    if (++$post_num % 2) {
        return 'odd';
    } else {
        return 'even';
    }
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);
function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

add_action('init', 'remheadlink');
function remheadlink()
{
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'feed_links_extra', 3);
}

function msg($message)
{
    echo('<pre style="z-index:10000; position:absolute; background-color:yellow; padding:5px;">');
    print_r($message);
    echo('</pre>');
}

// add_action('after_switch_theme', 'bt_flush_rewrite_rules');
// function bt_flush_rewrite_rules()
// {
//     flush_rewrite_rules();
// }

function wtw_change_settings($option, $old_value, $value)
{
    if (substr($option, 0, 25) === 'options_custom_post_types'
  || substr($option, 0, 25) === 'options_custom_taxonomies') {
        update_option('wtw_settings_changed', true);
    }
}
add_action('updated_option', 'wtw_change_settings', 10, 3);

function wtw_flush_rewrite()
{
    if (get_option('wtw_settings_changed') == true) {
        flush_rewrite_rules();
        update_option('wtw_settings_changed', false);
    }
}
add_action('admin_init', 'wtw_flush_rewrite');

add_filter('template_include', 'set_custom_templates');
function set_custom_templates($original_template)
{
    global $wp_query;
    if (is_tax() && get_queried_object()->parent) {
        $child_template = str_replace('.php', '-child.php', $original_template);
        if (file_exists($child_template)) {
            return $child_template;
        } else {
            return $original_template;
        }
    } elseif ($wp_query->is_posts_page) {
        if (file_exists(TEMPLATEPATH.'/archive-post.php')) {
            return TEMPLATEPATH.'/archive-post.php';
        } else {
            return TEMPLATEPATH.'/archive.php';
        }
    } else {
        return $original_template;
    }
}

add_filter('search_template', 'change_search_template');
function change_search_template($template)
{
    if ($_GET['post_type'] != '' && $_GET['post_type'] != 'post' && $_GET['post_type'] != 'page') {
        return locate_template('archive-'.$_GET['post_type'].'.php');
    } else {
        return locate_template('search.php');
    }
}

function wp_admin_bar_options()
{
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
'id' => 'wp-admin-bar-options',
'title' => __('Опции сайта'),
'href' => get_site_url().'/wp-admin/themes.php?page=options'
));
}
add_action('wp_before_admin_bar_render', 'wp_admin_bar_options');

if (function_exists('acf_add_options_page') && current_user_can('manage_options')) {
    acf_add_options_page(array(
        'page_title' 	=> 'Опции',
        'menu_title' 	=> 'Опции',
        'menu_slug' 	=> 'options',
        'parent_slug'	=> 'themes.php',
        'update_button'		=> __('Update'),
        'updated_message'	=> __("Item updated."),
        'autoload' 		=> true
    ));
}

if (function_exists('acf_add_options_page') && current_user_can('manage_options')) {
    acf_add_options_page(array(
        'page_title' 	=> 'Конфигуратор сайта',
        'menu_title' 	=> 'Конфигуратор',
        'menu_slug' 	=> 'config',
    'icon_url' => 'dashicons-screenoptions',
        'parent_slug'	=> 'tools.php',
        'update_button'		=> __('Update'),
        'updated_message'	=> __("Item updated."),
        'autoload' 		=> true
    ));
}

add_filter('acf/load_field/name=taxonomy_for_query', 'get_taxonomies_for_query');
function get_taxonomies_for_query($field)
{
    $taxonomies = get_taxonomies();
    unset($taxonomies['category']);
    unset($taxonomies['post_tag']);
    foreach ($taxonomies as $key => $value) {
        $tax = get_taxonomy($key);
        $taxonomies[$key] = get_taxonomy_labels($tax)->singular_name.' ('.$key.')';
    }
    $field['choices']['category_name'] = 'Рубрика (category)';
    $field['choices']['tag'] = 'Метка (post_tag)';
    $field['choices'] = array_merge($field['choices'], $taxonomies);
    return $field;
}

add_filter('acf/load_field/name=taxonomy_select', 'get_taxonomies_select');
function get_taxonomies_select($field)
{
    $taxonomies = get_taxonomies();
    foreach ($taxonomies as $key => $value) {
        $tax = get_taxonomy($key);
        $taxonomies[$key] = get_taxonomy_labels($tax)->singular_name.' ('.$key.')';
    }
    $field['choices'] = array_merge($field['choices'], $taxonomies);
    return $field;
}

add_filter('acf/load_field/name=post_type_select', 'get_post_type_select');
function get_post_type_select($field)
{
    $post_types = get_post_types();
    foreach ($post_types as $key => $value) {
        $post_type = get_post_type_object($key);
        $post_types[$key] = get_post_type_labels($post_type)->singular_name.' ('.$key.')';
    }
    $field['choices'] = $post_types;
    return $field;
}

function select_query_by_name($query_name)
{
    $args = [];
    if (function_exists('have_rows')) {
        if (have_rows('custom_query', 'option')):
      while (have_rows('custom_query', 'option')) : the_row();
        if (get_sub_field('name') === $query_name) {
            $args['post_type'] = get_sub_field('post_type_select');
            $args['posts_per_page'] = get_sub_field('posts_per_page') === '' ? -1 : get_sub_field('posts_per_page');
            if (get_sub_field('paged')) {
                $args['paged'] = get_query_var('paged');
            }
            while (have_rows('taxonomy')) : the_row();
            $args[get_sub_field('taxonomy_for_query')] = get_sub_field('terms');
            endwhile;
        }
        endwhile;
        endif;
    }
    return $args;
}

function select_term_query_by_name($query_name)
{
    $args = [];
    if (function_exists('have_rows')) {
        if (have_rows('custom_term_query', 'option')):
      while (have_rows('custom_term_query', 'option')) : the_row();
        if (get_sub_field('name') === $query_name) {
            $args['taxonomy'] = get_sub_field('taxonomy_select');
            $args['hide_empty'] = get_sub_field('hide_empty');
            $args['orderby'] = get_sub_field('orderby');
            $args['order'] = get_sub_field('order');
        }
        endwhile;
        endif;
    }
    return $args;
}

add_action('init', 'register_cpts');
function register_cpts()
{
    if (function_exists('have_rows')):
  while (have_rows('custom_post_types', 'option')) : the_row();
    register_post_type(
        get_sub_field('name'),
        array(
      'labels' => array(
        'name' => get_sub_field('many_name'),
        'menu_name' => get_sub_field('menu_name') != '' ? get_sub_field('menu_name') : get_sub_field('many_name'),
        'singular_name' => get_sub_field('single_name'),
        'add_new' => 'Добавить',
        'add_new_item' => get_sub_field('single_name'),
        'edit_item' => 'Редактировать',
        'new_item' => get_sub_field('single_name'),
        'all_items' => 'Все '.mb_strtolower(get_sub_field('many_name')),
        'view_item' => 'Просмотреть',
        'search_items' => 'Найти',
        'not_found' =>  'Ничего не найдено.',
        'not_found_in_trash' => 'В корзине пусто.'
     ),
      'public' => true,
      'menu_icon' => get_sub_field('icon'),
      'menu_position' => 20,
      'has_archive' => true,
      'supports' => get_sub_field('support'),
      'taxonomies' => array(''),
      'rewrite' => array(
          'slug' => get_sub_field('slug')
        )
      )
    );
    endwhile;
    endif;
}

add_action('init', 'register_taxs');
function register_taxs()
{
    if (function_exists('have_rows')):
  while (have_rows('custom_taxonomies', 'option')) : the_row();
    register_taxonomy(
        get_sub_field('name'),
        get_sub_field('post_type_select'),
        array(
            'labels' => array(
                'name' => get_sub_field('many_name'),
                'singular_name' => get_sub_field('single_name'),
                'search_items' =>  'Найти',
                'popular_items' => 'Популярные '.mb_strtolower(get_sub_field('many_name')),
                'all_items' => 'Все '.mb_strtolower(get_sub_field('many_name')),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Редактировать',
                'update_item' => 'Обновить',
                'add_new_item' => 'Добавить новый элемент',
                'new_item_name' => 'Введите название записи',
                'separate_items_with_commas' => 'Разделяйте '.mb_strtolower(get_sub_field('many_name')).' запятыми',
                'add_or_remove_items' => 'Добавить или удалить '.mb_strtolower(get_sub_field('many_name')),
                'choose_from_most_used' => 'Выбрать из наиболее часто используемых',
                'menu_name' => get_sub_field('menu_name') != '' ? get_sub_field('menu_name') : get_sub_field('many_name')
            ),
      'hierarchical' => get_sub_field('type') === 'true' ? true : false,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_in_quick_edit' => true,
            'show_ui' => true,
            'show_tagcloud' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array(
                'slug' => get_sub_field('slug'),
                'hierarchical' => false
            ),
        )
    );
    endwhile;
    endif;
}

function query_filter()
{
    if ((isset($_GET['post_type']) || isset($_GET['sort']) || isset($_GET['posts_per_page']))
&& !isset($_GET['min_price']) && !isset($_GET['max_price'])
&& !strpos($_SERVER['QUERY_STRING'], 'filter_')
) {
        global $wp_query;

        $args = array();
        $args['meta_query'] = array('relation' => 'AND');
        $args['tax_query'] = array('relation' => 'AND');

        foreach ($_GET as $key => $value) {
            if (is_array($value)) {
                if (substr($key, 0, 6) === 'in_pm_') {
                    $args['meta_query'][] = array(
                'key'     => substr($key, 6),
                'value'   => $value,
                'compare' => 'IN'
            );
                } else {
                    $args['tax_query'][] = array(
                'taxonomy'=> $key,
                'field'		=> 'slug',
                'terms'		=> $value,
                'operator'=> 'IN'
            );
                }
            }

            if (substr($key, 0, 7) === 'min_pm_' && $value != '') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 7),
            'value'   => $value,
            'type'    => 'numeric',
            'compare' => '>='
        );
            }

            if (substr($key, 0, 7) === 'max_pm_' && $value != '') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 7),
            'value'   => $value,
            'type'    => 'numeric',
            'compare' => '<='
        );
            }

            if (substr($key, 0, 8) === 'min_pmd_' && $value != '') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 8),
            'value'   => date('Ymd', strtotime($value)),
            'compare' => '>='
        );
            }

            if (substr($key, 0, 8) === 'max_pmd_' && $value != '') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 8),
            'value'   => date('Ymd', strtotime($value)),
            'type'    => 'date',
            'compare' => '<='
        );
            }

            if (substr($key, 0, 3) === 'pm_' & $value !== '') {
                $args['meta_query'][] = array(
            'key' => substr($key, 3),
            'value' => $value
            );
            }

            if ($key === 'post_types') {
                $args['post_type'] = explode(',', $value);
            }

            if ($key === 'posts_per_page') {
                $args['posts_per_page'] = $value;
            }

            if ($key === 'sort') {
                $v = explode('.', $value);
                if (count($v) === 3) {
                    $args['orderby'] = $v[0];
                    $args['meta_key'] = $v[1];
                    $args['order'] = $v[2];
                } else {
                    $args['orderby'] = $v[0];
                    $args['order'] = $v[1];
                }
            }
        }
        query_posts(array_merge($args, $wp_query->query));
    }
}

add_action('wp', 'query_filter');

function ajaxs_load_posts($jx)
{
    $args = [];
    $args = unserialize(stripslashes($jx->data['query']));
    $args['post_status'] = 'publish';
    $args['paged'] = $jx->data['page'] + 1;
    if (isset($args['ID'])) {
        $post = get_post($args['ID']);
        query_posts($args);
    }
    ob_start();
    require locate_template('template-parts/'.$jx->data['part'].'.php');
    return ob_get_clean();
};

function posts_per_page_change($query)
{
    if (isset($_GET['perpage']) && $query->is_main_query() && !$query->is_admin) {
        $query->set('posts_per_page', $_GET['perpage']);
    }
}
add_action('pre_get_posts', 'posts_per_page_change');

add_action('after_setup_theme', 'add_editor_css');
function add_editor_css()
{
    add_theme_support('editor-styles');
    //add_editor_style( 'css/main.css' );
}

function get_term_option_html($taxonomy, $term)
{
    global $wp_query;
    return '<option value="'.$term->slug.'" '.selected(!isset($_GET['post_type']) ? $wp_query->query_vars['term'] : $_GET[$taxonomy], $term->slug, false).'>'.$term->name.'</option>';
}

function get_option_html($value, $title, $selected = false)
{
    return '<option value="'.$value.'" '.selected($selected, $value, false).'>'.$title.'</option>';
}

function d()
{
    if (!headers_sent()) {
        header('Content-Type: text/html; charset=utf-8');
    }

    echo '<pre style="text-align: left; font-size: 10px;">';
    foreach (func_get_args() as $var) {
        print_r($var);
        echo '<br><br>';
    }
    echo '</pre>';
}

function dd()
{
    if (!headers_sent()) {
        header('Content-Type: text/html; charset=utf-8');
    }

    echo '<pre style="text-align: left; font-size: 10px;">';
    foreach (func_get_args() as $var) {
        print_r($var);
        echo '<br><br>';
    }
    echo '</pre>';
    die();
}

add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});

function ajaxs_filter($jx)
{
    //$args = array();
    $args = unserialize(stripslashes($jx->data['query']));

    $args['meta_query'] = array('relation' => 'AND');
    $args['tax_query'] = array('relation' => 'AND');

    foreach ($jx->data as $key => $value) {
        if ($value !== '') {
            if ($key === 's') {
                $args['s'] = $value;
            } elseif (substr($key, 0, 6) === 'in_pm_') {
                $args['meta_query'][] = array(
                'key'     => substr($key, 6),
                'value'   => $value,
                'compare' => 'IN'
            );
            } elseif (substr($key, 0, 7) === 'min_pm_') {
                $args['meta_query'][] = array(
                'key'     => substr($key, 7),
                'value'   => $value,
                'type'    => 'numeric',
                'compare' => '>='
            );
            } elseif (substr($key, 0, 7) === 'max_pm_') {
                $args['meta_query'][] = array(
                'key'     => substr($key, 7),
                'value'   => $value,
                'type'    => 'numeric',
                'compare' => '<='
            );
            } elseif (substr($key, 0, 8) === 'min_pmd_') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 8),
            'value'   => date('Ymd', strtotime($value)),
            'compare' => '>='
        );
            } elseif (substr($key, 0, 8) === 'max_pmd_') {
                $args['meta_query'][] = array(
            'key'     => substr($key, 8),
            'value'   => date('Ymd', strtotime($value)),
            'type'    => 'date',
            'compare' => '<='
        );
            } elseif (substr($key, 0, 3) === 'pm_') {
                $args['meta_query'][] = array(
            'key' => substr($key, 3),
            'value' => $value
            );
            } elseif ($key === 'post_type') {
                $args['post_type'] = explode(',', $value);
            } elseif ($key === 'posts_per_page') {
                $args['posts_per_page'] = $value;
            } elseif ($key === 'sort') {
                $v = explode('.', $value);
                if (count($v) === 3) {
                    $args['orderby'] = $v[0];
                    $args['meta_key'] = $v[1];
                    $args['order'] = $v[2];
                } else {
                    $args['orderby'] = $v[0];
                    $args['order'] = $v[1];
                }
            } elseif ($key === 'ajaxs_nonce') {
            } elseif ($key === 'query') {
            } else {
                $args['tax_query'][] = array(
                'taxonomy'=> $key,
                'field'		=> 'slug',
                'terms'		=> $value,
                'operator'=> 'IN'
            );
            }
        }
    }

    // $jx->log($jx->data);
    $jx->log($args);

    $query_vars = serialize($args);

    $jx->call('set_query_vars', $query_vars);

    ob_start();
    include locate_template('template-parts/product.php');
    return ob_get_clean();
}
