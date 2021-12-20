<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Metabox_Creator_By_Rixak
 *
 * @wordpress-plugin
 * Plugin Name:       Metabox Creator by Rixak
 * Plugin URI:        #
 * Description:       Авторский плагин для создания метабоксов и управления ими через post_type
 * Version:           1.0.0
 * Author:            Rixak
 * Author URI:        #
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       metabox-creator-by-rixak
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC'))
{
	die;
}


function enqueue_select2_jquery()
{
	wp_register_style('select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all');
	wp_register_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', ['jquery'], '1.0', true);
	wp_enqueue_style('select2css');
	wp_enqueue_script('select2');
}

add_action('admin_enqueue_scripts', 'enqueue_select2_jquery');
function select2jquery_inline()
{
	?>
	<style type="text/css">

		.select2-container
		{
			margin : 0 2px 0 2px;
		}

		.tablenav.top #doaction, #doaction2, #post-query-submit
		{
			margin : 0px 4px 0 4px;
		}

		.addSelect2js
		{
			opacity    : 0;
			transition : all 0.5s;
		}

		.addSelect2js.show_select2
		{
			opacity : 1;
		}

		.mcbr-options select
		{
			width       : 100%;
			padding     : 4px 8px;
			margin      : 0;
			box-sizing  : border-box;
			font-size   : 14px;
			line-height : 1.4;
		}

		.mcbr-options .form-table
		{
			margin-bottom : 30px !important;
		}

		.mcbr-options-add
		{
			text-align : center;
		}

		.mcbr-option-example, .mcbr-select-example, .mcbr-options-item-modal, .mcbr-options-item-tax
		{
			display : none;
		}

		.mcbr-options-remove
		{
			color           : #910000 !important;
			text-decoration : none !important;
			display         : inline-block;
			vertical-align  : middle;
			position        : relative;
			left            : 30px;
			outline         : none;
		}

		.mcbrJS__removeSelectVal.mcbr-options-remove
		{
			left : 0;
		}

		.mcbr-options-item-selectbox-row
		{
			display : flex;
		}

		.mcbr-options-item-selectbox-col
		{
			margin-right  : 20px;
			width         : 50%;
			margin-bottom : 20px;
		}

		.mcbr-options-item-selectbox-col input
		{
			width : 100%;
		}

		.mcbr-options-item-selectbox-col.del input
		{
			width : 90%;
		}

		.mcbr-options-item-selectbox-add
		{
			text-align : center;
		}

	</style>
	<script type='text/javascript'>
		jQuery(document).ready(function ($)
		{
			if ($('.addSelect2js').length > 0)
			{
				$('.addSelect2js').select2();
				$(document.body).on("click", function ()
				{
					$('.addSelect2js').select2({
						theme: "classic"
					});
				});
				setTimeout(function ()
				{
					$('.addSelect2js').addClass('show_select2');
				}, 2000);
			}
			
			function mcbr__setModalValues()
			{
				$('.mcbrJS__selectModal_link').each(function (i)
				{
					$(this).attr('href', '#TB_inline?width=600&&inlineId=selectbox_value__' + i);
					$('.mcbrJS__selectModal_content').eq(i).attr('id', 'selectbox_value__' + i);
					$('.mcbrJS__selectModal_contentInner').eq(i).attr('id', 'selectbox_value_inner__' + i);
					$('.mcbrJS__selectAddRow').eq(i).attr('data-id', 'selectbox_value_inner__' + i);
				});
			}
			
			function mcbrJS__removeSelectVal()
			{
				$('.mcbrJS__removeSelectVal').click(function ()
				{
					$(this).parent().parent().remove();
					return false;
				});
			}
			
			function mcbrJS__removeOption()
			{
				$('.mcbrJS__removeOption').click(function ()
				{
					$(this).parent().parent().parent().parent().remove();
					return false;
				});
			}
			
			
			$('.mcbrJS__addRow').click(function ()
			{
				
				$('.mcbrJS__copy .mcbrJS__optionItem').clone().appendTo(".mcbrJS__table");
				mcbrJS__removeOption();
				
				return false;
			});
			
			$(document).on('click', '.mcbrJS__selectAddRow', function ()
			{
				let mcbr__getDataId = $(this).attr('data-id');
				$('.mcbrJS__selectModal__copy .mcbrJS__selectModal__val').clone().appendTo('#' + mcbr__getDataId + ' .mcbrJS__selectModal__values');
				mcbrJS__removeSelectVal();
				event.preventDefault();
			});
			
			mcbrJS__removeOption();
			
			setInterval(function ()
			{
				mcbrJS__removeSelectVal();
				mcbr__setModalValues();
				
				mcbr__data       = [];
				mcbr__itemsCount = $('.mcbrJS__table .mcbrJS__optionItem').length;
				$('.mcbrJS__table .mcbrJS__optionItem').each(function (i)
				{
					mcbr__itemsType        = $('.mcbrJS__table .mcbrJS__optionItem-type').eq(i).val();
					mcbr__itemsTitle       = $('.mcbrJS__table .mcbrJS__optionItem-title').eq(i).val();
					mcbr__itemsDesc        = $('.mcbrJS__table .mcbrJS__optionItem-desc').eq(i).val();
					mcbr__itemsId          = $('.mcbrJS__table .mcbrJS__optionItem-id').eq(i).val();
					mcbr__itemsPlaceholder = $('.mcbrJS__table .mcbrJS__optionItem-placeholder').eq(i).val();
					mcbr__itemsTax = $('.mcbrJS__table .mcbrJS__optionItem-tax').eq(i).val();
					
					if (mcbr__itemsType == 'select')
					{
						mcbr__selectData = [];
						$('.mcbrJS__table .mcbrJS__selectTax').eq(i).hide();
						$('.mcbrJS__table .mcbrJS__selectModal').eq(i).fadeIn(300);
						count_selectBox = i+1;
						$('#selectbox_value_inner__'+count_selectBox+' .mcbrJS__selectModal__val').each(function (count_val)
						{
							
							mcbr__selectItem__key = $(this).children('.key').children('.mcbrJS__selectModal__option-key').val();
							mcbr__selectItem__val = $(this).children('.del').children('.mcbrJS__selectModal__option-val').val();
							
							
							select_prev = {
							select_data_key : mcbr__selectItem__key,
							select_data_value : mcbr__selectItem__val
							};
							mcbr__selectData.push(select_prev);
						});
						prev_array = {
							type_data       : mcbr__itemsType,
							title_data      : mcbr__itemsTitle,
							id_data         : mcbr__itemsId,
							desc_data       : mcbr__itemsDesc,
							placeholder_data: mcbr__itemsPlaceholder,
							vars_selectype  : mcbr__selectData
						};
					}
					else
					{
						$('.mcbrJS__table .mcbrJS__selectModal').eq(i).hide();
						
						if (mcbr__itemsType == 'select2')
						{
							$('.mcbrJS__table .mcbrJS__selectTax').eq(i).fadeIn(300);
							
							prev_array = {
								type_data       : mcbr__itemsType,
								title_data      : mcbr__itemsTitle,
								id_data         : mcbr__itemsId,
								desc_data       : mcbr__itemsDesc,
								placeholder_data: mcbr__itemsPlaceholder,
								tax_data: mcbr__itemsTax
							};
						}
						else
						{
							$('.mcbrJS__table .mcbrJS__selectTax').eq(i).hide();
							
							prev_array = {
								type_data       : mcbr__itemsType,
								title_data      : mcbr__itemsTitle,
								id_data         : mcbr__itemsId,
								desc_data       : mcbr__itemsDesc,
								placeholder_data: mcbr__itemsPlaceholder
							};
						}
					}
					
					
					
					mcbr__data.push(prev_array);
				});
				mcbr__dataTotal = JSON.stringify(mcbr__data);
				$('.setArrayJs').val(mcbr__dataTotal);
			}, 1000);
			
			
		});
	</script>
	<?php
}

add_action('admin_head', 'select2jquery_inline');


// add post type for add metaboxes
require plugin_dir_path(__FILE__) . 'includes/index.php';

// add metabox general file
require plugin_dir_path(__FILE__) . 'includes/metaboxes/index.php';

// include files
require plugin_dir_path(__FILE__) . 'includes/metaboxes/metabox-add.php';
require plugin_dir_path(__FILE__) . 'includes/metaboxes/metabox-front.php';










