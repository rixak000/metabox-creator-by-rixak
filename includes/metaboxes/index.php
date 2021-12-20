<?php

/*
	Meta boxes
*/


class trueMetaBox
{
	function __construct($options)
	{
		$this->options = $options;
		$this->prefix  = $this->options['id'] . '_';
		add_action('add_meta_boxes', [&$this, 'create']);
		add_action('save_post', [&$this, 'save'], 1, 2);
	}
	
	function create()
	{
		foreach ($this->options['post'] as $post_type)
		{
			if (current_user_can($this->options['cap']))
			{
				add_meta_box($this->options['id'], $this->options['name'], [
					&$this, 'fill',
				], $post_type, $this->options['pos'], $this->options['pri']);
			}
		}
	}
	
	function fill()
	{
		global $post;
		$p_i_d = $post->ID;
		wp_nonce_field($this->options['id'], $this->options['id'] . '_wpnonce', false, true);
		?>
		<table class="form-table">
		<tbody><?php
			foreach ($this->options['args'] as $param)
			{
				if (current_user_can($param['cap']))
				{
					?>
					<tr><?php
					if (!$value = get_post_meta($post->ID, $this->prefix . $param['id'], true))
					{
						$value = $param['std'];
					}
					switch ($param['type'])
					{
						case 'text':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<input name="<?php echo $this->prefix . $param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix . $param['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $param['placeholder'] ?>" class="regular-text"/>
								<br/>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>
							<?php
							break;
						}
						case 'select2':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<select style="width: 100%;" multiple name="<?php echo $this->prefix . $param['id'] ?>[]" id="<?php echo $this->prefix . $param['id'] ?>" class="js-example-basic-multiple addSelect2js">
									<? $all_options = get_terms($param['tax'], 'orderby=name');
									
									  ?>
									<? if ($all_options): ?>
										<? foreach ($all_options as $all_options__item): ?>
											<? if (in_array($all_options__item->term_id, $value)): ?>
												<option selected value="<?= $all_options__item->term_id; ?>"><?= $all_options__item->name; ?></option>
											<? else: ?>
												<option value="<?= $all_options__item->term_id; ?>"><?= $all_options__item->name; ?></option>
											<? endif ?>
										
										<? endforeach ?>
									<? endif ?>
	
								</select>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>

							<?php
							break;
						}
						case 'admin__type_post':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<select style="width: 100%;" multiple name="<?php echo $this->prefix . $param['id'] ?>[]" id="<?php echo $this->prefix . $param['id'] ?>" class="js-example-basic-multiple addSelect2js">
									<? $all_options = get_post_types(); ?>
									<? if ($all_options): ?>
										<? foreach ($all_options as $all_options__item): ?>
											<? if (in_array($all_options__item, $value)): ?>
												<option selected value="<?= $all_options__item; ?>"><?= $all_options__item; ?></option>
											<? else: ?>
												<option value="<?= $all_options__item; ?>"><?= $all_options__item; ?></option>
											<? endif ?>
										
										<? endforeach ?>
									<? endif ?>

								</select>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>
							<?php
							break;
						}
						case 'textarea':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<textarea name="<?php echo $this->prefix . $param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix . $param['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $param['placeholder'] ?>" class="large-text"/><?php echo $value ?></textarea><br/>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>
							<?php
							break;
						}
						case 'admin__insertArea':
						{ ?>
							<th style="display: none;" scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td style="display: none;">
								<textarea name="<?php echo $this->prefix . $param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix . $param['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $param['placeholder'] ?>" class="large-text setArrayJs"/>
								<?php echo $value ?></textarea><br/>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>
							<?php
							break;
						}
						case 'admin__form':
						{
							require plugin_dir_path(__FILE__) . '/admin-form.php';
							break;
						}
						case 'checkbox':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<label for="<?php echo $this->prefix . $param['id'] ?>">
									<input name="<?php echo $this->prefix . $param['id'] ?>" type="<?php echo $param['type'] ?>" id="<?php echo $this->prefix . $param['id'] ?>"<?php echo ($value == 'on') ? ' checked="checked"' : '' ?> />
									<?php echo $param['desc'] ?></label>
							</td>
							<?php
							break;
						}
						case 'select':
						{ ?>
							<th scope="row">
								<label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
							</th>
							<td>
								<label for="<?php echo $this->prefix . $param['id'] ?>">
									<select name="<?php echo $this->prefix . $param['id'] ?>" id="<?php echo $this->prefix . $param['id'] ?>">
										<? if ($param['args']): ?>
											<?php
											foreach ($param['args'] as $items_select)
											{
												?>
												<? foreach ($items_select as $val => $name):?>
												<option value="<?php echo $val ?>"<?php echo ($value == $val) ? ' selected="selected"' : '' ?>><?php echo $name ?></option>
												<?endforeach?><?php
											}
											?>
										<? else: ?>
											<option>...</option>
										<?endif ?>
									</select>
								</label>
								<br/>
								<span class="description"><?php echo $param['desc'] ?></span>
							</td>
							<?php
							break;
						}
					}
					?></tr><?php
				}
			}
			?></tbody></table><?php
	}
	
	function save($post_id, $post)
	{
		if (!wp_verify_nonce($_POST[$this->options['id'] . '_wpnonce'], $this->options['id']))
		{
			return;
		}
		if (!current_user_can('edit_post', $post_id))
		{
			return;
		}
		if (!in_array($post->post_type, $this->options['post']))
		{
			return;
		}
		foreach ($this->options['args'] as $param)
		{
			$addValue = $_POST[$this->prefix . $param['id']];
			if (current_user_can($param['cap']))
			{
				if (isset($_POST[$this->prefix . $param['id']]) && $addValue)
				{
					update_post_meta($post_id, $this->prefix . $param['id'], $addValue);
				}
				else
				{
					delete_post_meta($post_id, $this->prefix . $param['id']);
				}
			}
		}
	}
}




