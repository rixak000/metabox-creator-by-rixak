<?php

/*
	Front metabox
*/

add_action('init', function ()
{
	$p_i_d = $_GET['post'];
	if (is_user_logged_in())
	{
		$getMetaPosts = new WP_Query(
			[
				'showposts' => 999,
				'post_type' => 'metaboxtype',
			]);
		
		if ($getMetaPosts)
		{
			
			
			while ($getMetaPosts->have_posts()) : $getMetaPosts->the_post();
				
				$getMeta_name     = 'Группа полей "' . get_the_title() . '"';
				$getMeta_id       = get_the_ID();
				$getMeta_location = meta_get_field($getMeta_id, 'admin_meta_add_new_location');
				$getMeta_objects  = meta_get_field($getMeta_id, 'admin_meta_add_new_add_data');
				$getMeta_objects  = json_decode($getMeta_objects);
				if ($getMeta_location)
				{
					$setData = [];
					if ($getMeta_objects)
					{
						foreach ($getMeta_objects as $getMeta_objects__item)
						{
							if ($getMeta_objects__item->placeholder_data)
							{
								$setData__placeholder = $getMeta_objects__item->placeholder_data;
							}
							else
							{
								$setData__placeholder = '';
							}
							if ($getMeta_objects__item->desc_data)
							{
								$setData__desc = $getMeta_objects__item->desc_data;
							}
							else
							{
								$setData__desc = '';
							}
							if ($getMeta_objects__item->type_data == 'select')
							{
								$getMeta__select = $getMeta_objects__item->vars_selectype;
								$setSelectValues = [];
								if ($getMeta__select)
								{
									foreach ($getMeta__select as $getMeta__select__item)
									{
										$setSelectValues[] = [$getMeta__select__item->select_data_key => $getMeta__select__item->select_data_value];
									}
								}
								$setData[] = [
									'id'          => $getMeta_objects__item->id_data,
									'title'       => $getMeta_objects__item->title_data,
									'type'        => $getMeta_objects__item->type_data,
									'placeholder' => $setData__placeholder,
									'desc'        => $setData__desc,
									'args'        => $setSelectValues,
									'cap'         => 'edit_posts',
								];
							}
							else
							{
								if ($getMeta_objects__item->type_data == 'select2')
								{
									$setData[] = [
										'id'          => $getMeta_objects__item->id_data,
										'title'       => $getMeta_objects__item->title_data,
										'type'        => $getMeta_objects__item->type_data,
										'placeholder' => $setData__placeholder,
										'desc'        => $setData__desc,
										'tax'        => $getMeta_objects__item->tax_data,
										'cap'         => 'edit_posts',
									];
								}
								else
								{
									$setData[] = [
										'id'          => $getMeta_objects__item->id_data,
										'title'       => $getMeta_objects__item->title_data,
										'type'        => $getMeta_objects__item->type_data,
										'placeholder' => $setData__placeholder,
										'desc'        => $setData__desc,
										'cap'         => 'edit_posts',
									];
								}
								
							}
							
						}
					}
					$options = [
						[
							'id'   => 'mcbr_' . $getMeta_id,
							'name' => $getMeta_name,
							'post' => $getMeta_location,
							'pos'  => 'normal',
							'pri'  => 'high',
							'cap'  => 'edit_posts',
							'args' => $setData
						],
					];
					
					foreach ($options as $option)
					{
						$truemetabox = new trueMetaBox($option);
					}
				}
			endwhile;
			wp_reset_postdata();
			
			
		}
	}
});







