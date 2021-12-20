<?php // Silence is golden

add_action( 'init', 'true_register_metaboxtype' );

function true_register_metaboxtype() {
	$labels = array(
		'name' => 'Произвольные поля',
		'singular_name' => 'Запись',
		'add_new' => 'Добавить группу',
		'add_new_item' => 'Добавить новую запись',
		'edit_item' => 'Редактировать запись',
		'new_item' => 'Новая запись',
		'all_items' => 'Все записи',
		'view_item' => 'Просмотр записи на сайте',
		'search_items' => 'Искать записи',
		'not_found' =>  'Запией не найдено.',
		'not_found_in_trash' => 'В корзине нет записей.',
		'menu_name' => 'Произвольные поля'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-megaphone',
		'menu_position' => 5,
		'show_in_rest' => false,
		'has_archive' => false,
		'supports' => array( 'title')
	);
	register_post_type('metaboxtype',$args);
	
}
