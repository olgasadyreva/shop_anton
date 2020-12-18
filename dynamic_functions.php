<?php
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array(
'key' => 'sekcii-stranicy',
'title' => 'Секции страницы',
'menu_order' => 0,
'location' => array(
  array(
    array(
      'param' => 'post_template',
      'operator' => '==',
      'value' => 'index.php',
    ),
  ),
),
'hide_on_screen' => array(
  0 => 'the_content',
),
'fields' => array (
  0 => 
  array (
    'label' => 'Слайды',
    'name' => 'slajdy',
    'key' => 'field_slajdy',
    'type' => 'repeater',
    'layout' => 'row',
    'sub_fields' => 
    array (
      0 => 
      array (
        'label' => 'Фото',
        'name' => 'foto',
        'key' => 'field_slajdy_foto',
        'type' => 'image',
        'return_format' => 'url',
      ),
      1 => 
      array (
        'label' => 'Тег слайда',
        'name' => 'teg_slajda',
        'key' => 'field_slajdy_teg_slajda',
        'type' => 'text',
      ),
      2 => 
      array (
        'label' => 'Заголовок',
        'name' => 'zagolovok',
        'key' => 'field_slajdy_zagolovok',
        'type' => 'text',
      ),
      3 => 
      array (
        'label' => 'Описание',
        'name' => 'opisanie',
        'key' => 'field_slajdy_opisanie',
        'type' => 'text',
      ),
    ),
  ),
  1 => 
  array (
    'label' => 'Баннеры',
    'name' => 'bannery',
    'key' => 'field_bannery',
    'type' => 'group',
    'layout' => 'row',
    'sub_fields' => 
    array (
      0 => 
      array (
        'label' => 'Заголовок',
        'name' => 'zagolovok',
        'key' => 'field_bannery_zagolovok',
        'type' => 'text',
      ),
      1 => 
      array (
        'label' => 'Фото 1',
        'name' => 'foto_1',
        'key' => 'field_bannery_foto_1',
        'type' => 'image',
        'return_format' => 'url',
      ),
      2 => 
      array (
        'label' => 'Ссылка 1',
        'name' => 'ssylka_1',
        'key' => 'field_bannery_ssylka_1',
        'type' => 'text',
      ),
      3 => 
      array (
        'label' => 'Тег 1',
        'name' => 'teg_1',
        'key' => 'field_bannery_teg_1',
        'type' => 'text',
      ),
      4 => 
      array (
        'label' => 'Фото 2',
        'name' => 'foto_2',
        'key' => 'field_bannery_foto_2',
        'type' => 'image',
        'return_format' => 'url',
      ),
      5 => 
      array (
        'label' => 'Ссылка 2',
        'name' => 'ssylka_2',
        'key' => 'field_bannery_ssylka_2',
        'type' => 'text',
      ),
      6 => 
      array (
        'label' => 'Скидка',
        'name' => 'skidka',
        'key' => 'field_bannery_skidka',
        'type' => 'text',
      ),
      7 => 
      array (
        'label' => 'Описание скидки',
        'name' => 'opisanie_skidki',
        'key' => 'field_bannery_opisanie_skidki',
        'type' => 'text',
      ),
      8 => 
      array (
        'label' => 'Текст кнопки',
        'name' => 'tekst_knopki',
        'key' => 'field_bannery_tekst_knopki',
        'type' => 'text',
      ),
      9 => 
      array (
        'label' => 'Фото 3',
        'name' => 'foto_3',
        'key' => 'field_bannery_foto_3',
        'type' => 'image',
        'return_format' => 'url',
      ),
      10 => 
      array (
        'label' => 'Ссылка 3',
        'name' => 'ssylka_3',
        'key' => 'field_bannery_ssylka_3',
        'type' => 'text',
      ),
      11 => 
      array (
        'label' => 'Тег 2',
        'name' => 'teg_2',
        'key' => 'field_bannery_teg_2',
        'type' => 'text',
      ),
    ),
  ),
  2 => 
  array (
    'label' => 'Блог',
    'name' => 'blog',
    'key' => 'field_blog',
    'type' => 'group',
    'layout' => 'row',
    'sub_fields' => 
    array (
      0 => 
      array (
        'label' => 'Заголовок',
        'name' => 'zagolovok',
        'key' => 'field_blog_zagolovok',
        'type' => 'text',
      ),
      1 => 
      array (
        'label' => 'Описание',
        'name' => 'opisanie',
        'key' => 'field_blog_opisanie',
        'type' => 'textarea',
        'new_lines' => 'br',
      ),
    ),
  ),
  3 => NULL,
  4 => NULL,
  5 => NULL,
  6 => NULL,
  7 => NULL,
  8 => NULL,
  9 => NULL,
),
));
endif;
?><?php
register_sidebar( array(
'name'          => 'Товар',
'id'            => 'tovar',
'description'   => '',
'class'         => '',
'before_widget' => '<div class="">',
'after_widget'  => '</div>',
'before_title'  => '<h3 class="">',
'after_title'   => '</h3>'
)); ?>
<?php
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array(
'key' => 'kontakty',
'title' => 'Контакты',
'menu_order' => 0,
'location' => array(
  array(
    array(
      'param' => 'post_template',
      'operator' => '==',
      'value' => 'page-contacts.php',
    ),
  ),
),
'hide_on_screen' => array(
  0 => 'the_content',
),
'fields' => array (
  0 => 
  array (
    'label' => 'Карта',
    'name' => 'karta',
    'key' => 'field_karta',
    'type' => 'textarea',
    'new_lines' => 'br',
  ),
  1 => 
  array (
    'label' => 'Приглашение',
    'name' => 'priglashenie',
    'key' => 'field_priglashenie',
    'type' => 'wysiwyg',
    'toolbar' => 'full',
  ),
  2 => 
  array (
    'label' => 'Адрес',
    'name' => 'adres',
    'key' => 'field_adres',
    'type' => 'text',
  ),
  3 => 
  array (
    'label' => 'Телефон',
    'name' => 'telefon',
    'key' => 'field_telefon',
    'type' => 'text',
  ),
  4 => 
  array (
    'label' => 'Емейл',
    'name' => 'emejl',
    'key' => 'field_emejl',
    'type' => 'text',
  ),
  5 => 
  array (
    'label' => 'Время работы',
    'name' => 'vremya_raboty',
    'key' => 'field_vremya_raboty',
    'type' => 'text',
  ),
),
));
endif;
?><?php
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array(
'key' => 'opcii',
'title' => 'Опции',
'menu_order' => 0,
'location' => array(
  array(
    array(
      'param' => 'options_page',
      'operator' => '==',
      'value' => 'options',
    ),
  ),
),
'hide_on_screen' => array(
  0 => 'the_content',
),
'fields' => array (
  0 => 
  array (
    'label' => 'Контакты',
    'name' => 'kontakty',
    'key' => 'field_kontakty',
    'type' => 'tab',
  ),
  1 => 
  array (
    'label' => 'Адрес магазина',
    'name' => 'adres_magazina',
    'key' => 'field_adres_magazina',
    'type' => 'text',
  ),
  2 => 
  array (
    'label' => 'Телефон',
    'name' => 'telefon',
    'key' => 'field_telefon',
    'type' => 'text',
  ),
  3 => NULL,
  4 => 
  array (
    'label' => 'Email',
    'name' => 'email',
    'key' => 'field_email',
    'type' => 'text',
  ),
  5 => NULL,
  6 => 
  array (
    'label' => 'Время работы',
    'name' => 'vremya_raboty',
    'key' => 'field_vremya_raboty',
    'type' => 'text',
  ),
  7 => 
  array (
    'label' => 'Другие настройки',
    'name' => 'drugie_nastrojki',
    'key' => 'field_drugie_nastrojki',
    'type' => 'tab',
  ),
  8 => 
  array (
    'label' => 'Описание сайта',
    'name' => 'opisanie_sajta',
    'key' => 'field_opisanie_sajta',
    'type' => 'textarea',
    'new_lines' => 'br',
  ),
),
));
endif;
?>