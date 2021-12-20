<th scope="row">
	Создание опций
</th>

<?
$get_id = $_GET['post'];
$getData = meta_get_field($get_id, 'admin_meta_add_new_add_data');
$getData        = json_decode($getData);
 ?>
<td>
	<div class="mcbr-options">
		<div class="mcbrJS__selectModal__copy mcbr-select-example">
			<div class="mcbrJS__selectModal__val mcbr-options-item-selectbox-row">
				<div class="mcbr-options-item-selectbox-col key">
					<input class="mcbrJS__selectModal__option-key" type="text" value="" placeholder="Ключ"/>
				</div>
				<div class="mcbr-options-item-selectbox-col del">
					<input class="mcbrJS__selectModal__option-val" type="text" value="" placeholder="Значение"/>
					<a title="Удалить" href="#" class="mcbrJS__removeSelectVal mcbr-options-remove">
						<span class="dashicons dashicons-remove"></span>
					</a>
				</div>

			</div>
		</div>
		<div class="mcbrJS__copy mcbr-option-example">
			<table class="mcbrJS__optionItem mcbr-options-item">
				<tr class="mcbr-options-item-type">
					<td>
						<span class="description">Выберите тип</span>
						<select class="mcbrJS__optionItem-type">
							<option value="text">Текст</option>
							<option value="textarea">Текстовая область</option>
							<option value="select">Выпадающий список</option>
							<option value="checkbox">Чекбокс</option>
							<option value="select2">Записи таксономий</option>
						</select>
					</td>
					<td>
						<div class="mcbrJS__selectModal mcbr-options-item-modal">
							<?php add_thickbox(); ?>
							<a href="#TB_inline?width=600&&inlineId=selectbox_value" class="thickbox mcbrJS__selectModal_link">
								Выбрать варианты
							</a>
							<div id="selectbox_value" class="mcbrJS__selectModal_content" style="display:none;">
								<div id="selectbox_value_inner" class="mcbrJS__selectModal_contentInner">
									<h3>Варианты для выпадающего списка</h3>
									<div class="mcbr-options-item-selectbox">
										<div class="mcbrJS__selectModal__values mcbr-options-item-selectbox-rows">
											<div class="mcbrJS__selectModal__val mcbr-options-item-selectbox-row">
												<div class="mcbr-options-item-selectbox-col key">
													<input class="mcbrJS__selectModal__option-key" type="text" value="" placeholder="Ключ"/>
												</div>
												<div class="mcbr-options-item-selectbox-col del">
													<input class="mcbrJS__selectModal__option-val" type="text" value="" placeholder="Значение"/>
													<a title="Удалить" href="#" class="mcbrJS__removeSelectVal mcbr-options-remove">
														<span class="dashicons dashicons-remove"></span>
													</a>
												</div>
											</div>
										</div>
										<div class="mcbr-options-item-selectbox-add">
											<a data-id="selectbox_value_inner" class="mcbrJS__selectAddRow button button-primary button-large" href="#">
												+ Добавить
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mcbrJS__selectTax mcbr-options-item-tax">
							<?
							$getAllTax = get_taxonomies();
							?>
							<span class="description">Выберите Таксономию</span>
							<select class="mcbrJS__optionItem-tax">
								<? foreach ($getAllTax as $tax_item): ?>
									<option value="<?= $tax_item; ?>"><?= $tax_item; ?></option>
								<? endforeach ?>
							</select>
						</div>
					</td>
				</tr>
				<tr class="mcbr-options-item-options">
					<td>
						<span class="description">Заголовок</span>
						<br>
						<input type="text" value="" placeholder="Заголовок опции" class="mcbrJS__optionItem-title"/>
					</td>
					<td>
						<span class="description">Описание</span>
						<br>
						<input type="text" value="" placeholder="Описание опции" class="mcbrJS__optionItem-desc"/>
					</td>
					<td>
						<span class="description">Уникальный ID (на латинице)</span>
						<br>
						<input type="text" value="" placeholder="" class="mcbrJS__optionItem-id"/>
					</td>
					<td>
						<span class="description">Placeholder</span>
						<br>
						<input type="text" value="" placeholder="" class="mcbrJS__optionItem-placeholder"/>
						<a title="Удалить" href="#" class="mcbrJS__removeOption mcbr-options-remove">
							<span class="dashicons dashicons-remove"></span>
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="mcbrJS__table form-table">
			<? if ($getData): ?>
				<? $loop = 1; ?>
				<? foreach ($getData as $getData_item):?>
				<table class="mcbrJS__optionItem mcbr-options-item">
					<tr class="mcbr-options-item-type">
						<td>
							<span class="description">Выберите тип</span>
							<select class="mcbrJS__optionItem-type">
								<? if ($getData_item->type_data == 'text'): ?>
									<option selected value="text">Текст</option>
								<? else: ?>
									<option value="text">Текст</option>
								<? endif ?>
								<? if ($getData_item->type_data == 'textarea'): ?>
									<option selected value="textarea">Текстовая область</option>
								<? else: ?>
									<option value="textarea">Текстовая область</option>
								<? endif ?>
								<? if ($getData_item->type_data == 'select'): ?>
									<option selected value="select">Выпадающий список</option>
								<? else: ?>
									<option value="select">Выпадающий список</option>
								<? endif ?>
								<? if ($getData_item->type_data == 'checkbox'): ?>
									<option selected value="checkbox">Чекбокс</option>
								<? else: ?>
									<option value="checkbox">Чекбокс</option>
								<? endif ?>
								<? if ($getData_item->type_data == 'select2'): ?>
									<option selected value="select2">Записи таксономий</option>
								<? else: ?>
									<option value="select2">Записи таксономий</option>
								<? endif ?>
							</select>
						</td>
						<td>
							<div class="mcbrJS__selectModal mcbr-options-item-modal">
								<?php add_thickbox(); ?>
								<a href="#TB_inline?width=600&&inlineId=selectbox_value__<?=$loop;?>" class="thickbox mcbrJS__selectModal_link">
									Выбрать варианты
								</a>
								<div id="selectbox_value__<?=$loop;?>" class="mcbrJS__selectModal_content" style="display:none;">
									<div id="selectbox_value_inner__<?=$loop;?>" class="mcbrJS__selectModal_contentInner">
										<h3>Варианты для выпадающего списка</h3>
										<div class="mcbr-options-item-selectbox">
											<div class="mcbrJS__selectModal__values mcbr-options-item-selectbox-rows">
												<? if ($getData_item->vars_selectype): ?>
													<? foreach ($getData_item->vars_selectype as $getData_selects):?>
													<div class="mcbrJS__selectModal__val mcbr-options-item-selectbox-row">
														<div class="mcbr-options-item-selectbox-col key">
															<input class="mcbrJS__selectModal__option-key" type="text" value="<?=$getData_selects->select_data_key; ?>" placeholder="Ключ"/>
														</div>
														<div class="mcbr-options-item-selectbox-col del">
															<input class="mcbrJS__selectModal__option-val" type="text" value="<?=$getData_selects->select_data_value; ?>" placeholder="Значение"/>
															<a title="Удалить" href="#" class="mcbrJS__removeSelectVal mcbr-options-remove">
																<span class="dashicons dashicons-remove"></span>
															</a>
														</div>
													</div>
													<?endforeach?>
												<? endif ?>
											</div>
											<div class="mcbr-options-item-selectbox-add">
												<a data-id="selectbox_value_inner__<?=$loop;?>" class="mcbrJS__selectAddRow button button-primary button-large" href="#">
													+ Добавить
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mcbrJS__selectTax mcbr-options-item-tax">
								<?
								$getAllTax = get_taxonomies();
								
								// var_dump(get_terms($tax_item, 'orderby=name'));
								?>
								<span class="description">Выберите Таксономию</span>
								<select class="mcbrJS__optionItem-tax">
									<? foreach ($getAllTax as $tax_item): ?>
										<? if ($getData_item->tax_data == $tax_item): ?>
											<option selected value="<?= $tax_item; ?>"><?= $tax_item; ?></option>
										<? else: ?>
											<option value="<?= $tax_item; ?>"><?= $tax_item; ?></option>
										<? endif ?>
									
									<? endforeach ?>
								</select>
							</div>
						</td>
					</tr>
					<tr class="mcbr-options-item-options">
						<td>
							<span class="description">Заголовок</span>
							<br>
							<input type="text" value="<?=$getData_item->title_data; ?>" placeholder="Заголовок опции" class="mcbrJS__optionItem-title"/>
						</td>
						<td>
							<span class="description">Описание</span>
							<br>
							<input type="text" value="<?=$getData_item->desc_data; ?>" placeholder="Описание опции" class="mcbrJS__optionItem-desc"/>
						</td>
						<td>
							<span class="description">Уникальный ID (на латинице)</span>
							<br>
							<input type="text" value="<?=$getData_item->id_data; ?>" placeholder="" class="mcbrJS__optionItem-id"/>
						</td>
						<td>
							<span class="description">Placeholder</span>
							<br>
							<input type="text" value="<?=$getData_item->placeholder_data; ?>" placeholder="" class="mcbrJS__optionItem-placeholder"/>
							<a title="Удалить" href="#" class="mcbrJS__removeOption mcbr-options-remove">
								<span class="dashicons dashicons-remove"></span>
							</a>
						</td>
					</tr>
				</table>
					<?$loop++; ?>
				<? endforeach ?>
			<? endif ?>

		</div>
		<div class="mcbr-options-add">
			<a class="mcbrJS__addRow button button-primary button-large" href="#">
				+ Добавить опцию
			</a>
		</div>
	</div>
</td>
