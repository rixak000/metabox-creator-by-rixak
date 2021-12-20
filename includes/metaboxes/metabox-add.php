<?php

/*
	Options metaboxes HOMEPAGE
*/


// add repeat param
$start_loop = 1;



// set options from metabox class
$options = [
	[
		'id'   => 'admin_meta_add_new',
		'name' => 'Добавление полей',
		'post' => ['metaboxtype'],
		'pos'  => 'normal',
		'pri'  => 'high',
		'cap'  => 'edit_posts',
		'args' => [
			[
				'id'          => 'location',
				'title'       => 'Где отображать',
				'type'        => 'admin__type_post',
				'placeholder' => '',
				'desc'        => 'укажите тип поста',
				'cap'         => 'edit_posts',
			],
			[
				'id'          => 'admin__form',
				'title'       => '',
				'type'        => 'admin__form',
				'placeholder' => '',
				'desc'        => '',
				'cap'         => 'edit_posts',
			],
			[
				'id'          => 'add_data',
				'title'       => 'Список массива',
				'type'        => 'admin__insertArea',
				'placeholder' => '',
				'desc'        => '',
				'std'         => '',
				'cap'         => 'edit_posts',
			]
		
		
		],
	],
];

foreach ($options as $option)
{
	$truemetabox = new trueMetaBox($option);
}






