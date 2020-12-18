$(function(){

	add_to_cart();
  change_cart_qty();
  remove_from_cart();

  add_to_wl();
	wl_remove();
	wl_move();
	wl_copy();

  set_var_price();
  change_variations();

	$('[data-load-product]').click(function(){
		var data = {};
		data.id = $(this).attr('data-product-id');
		data.part = $(this).attr('data-load-product');
		ajaxs('load_product', data, function(responce){
    });
	});

	$('#login_form').submit(function (e) {
		e.preventDefault();
		ajaxs('wc_login', $(this),
			function (result) {
				if (result.error) {
					$('#login_form').siblings('.w-form-done').hide();
					$('#login_form').siblings('.w-form-fail').html(result.data).show();
					console.log(result);
				} else {
					var redirect = $('#login_form').attr('redirect');
					if (redirect !== undefined) {
						location.replace(redirect);
					} else {
						location.reload();
					}
				}
			});
	});

	$('#register_form').submit(function(e){

		e.preventDefault();

		ajaxs( 'wc_register', $(this),
		function( result ){
			if( result.error ){
				$('#register_form').siblings('.w-form-done').hide();
				$('#register_form').siblings('.w-form-fail').show().children(":first").html(result.data);
			} else {
				var redirect = $('#register_form').attr('redirect');
				if( redirect !== undefined ){
					location.replace(redirect);
				} else {
					$('#register_form').siblings('.w-form-fail').hide();
					$('#register_form').siblings('.w-form-done').show();
				}
			}
		});

	});

	$('#recover_form').submit(function(e){

		e.preventDefault();
    data = {subject: $(this).attr('data-subject'), message: $(this).attr('data-message'), foo: $(this)};
		ajaxs( 'wc_recover', data,
		function( result ){
			if( result.error ){
				$('#recover_form').siblings('.w-form-done').hide();
				$('#recover_form').siblings('.w-form-fail').html(result.data).show();
			} else {
        $('#recover_form').siblings('.w-form-fail').hide();
        $('#recover_form').siblings('.w-form-done').show();
			}
		});

	});

	$('[data-action=variation_reset]').click(function(){
	  $('form[name=add_to_cart] select').each(function(){
			$(this).val('');
			$('[data-content=var_not_stocked]').hide();
	    //$('[name=add_to_cart]').siblings('.w-form-fail').hide();
	  });
	  $('[data-content^=var_]').hide();
	});

	// вывод описания оплаты

	$('[data-payment-desc]:first').show();
	$('[name=payment_method]').change(function(){
		$('[data-payment-desc]').hide();
		$('[data-payment-desc='+$(this).val()+']').show();
	});

	// пересчет заказа

	if( !$('.woocommerce-checkout-review-order-table').length ){
  $('body').on('change', '#shipping_method,#billing_country', function(){
    $('#checkout').css('opacity', '0.3');
    ajaxs('recalc_checkout', $('#checkout_form'), function(){
      $('#checkout').css('opacity', '1');
    });
	});
	}

  // изменение количества товара

  $('body').on('click', '[data-action=product_qty_plus]', function(){
		product_qty = $(this).parents('form').find('[data-name=qty]');
		if( parseInt(product_qty.attr('data-qty-max')) > parseInt(product_qty.val()) 
		|| product_qty.attr('data-qty-max') === undefined 
		|| product_qty.attr('data-qty-max') === '0' 
		){
			product_qty.val(parseInt(product_qty.val())+1);
		}
	});

	$('body').on('change', '[data-action=product_qty]', function () {
		product_qty = $(this);
		max_qty = parseInt(product_qty.attr('data-qty-max'));
		cur_qty = parseInt(product_qty.val());
		if (max_qty < cur_qty && max_qty != 0) {
			product_qty.val(max_qty);
		}
	});

	$('body').on('click', '[data-action=product_qty_minus]', function(){
		product_qty = $(this).parents('form').find('[data-name=qty]');
		if(parseInt(product_qty.val()) > 1){
			product_qty.val(parseInt(product_qty.val())-1);
		}
	});

  // рейтинг товара

	$('.comment-form-rating a').click(function(e){
  	cur_index = $(this).text();
  	$(this).siblings().each(function(){
  		if($(this).text() < cur_index) {
        $(this).addClass('filled');
      }else{
        $(this).removeClass('filled');
      }
  	});
  });

  // слайдер цены

	$('[data-price-slider]').slider({
		step: parseInt($("[data-ui-slider]").attr('data-ui-slider')),
		range: true,
		min: parseInt($("[name=min_price]").attr('data-value')),
		max: parseInt($("[name=max_price]").attr('data-value')),
		values: [ parseInt($("[name=min_price]").val()), parseInt($("[name=max_price]").val()) ],
		slide: function(event, ui) {
			$("[name=min_price]").val(ui.values[0]).keyup();
			$("[name=max_price]").val(ui.values[1]).keyup();
		}
	});

  // выбор вариаций товара

	$('[data-action=product_var_select]').change(function(){
		product_content = $(this).parents('[data-content=product]');
		$(this).parents('form').attr('data-product-id', $(this).val());
		product_content.find('[data-variation-id]').hide();
		product_content.find('[data-variation-id='+$(this).val()+']').show();
		if($(this).find('option[value='+$(this).val()+']').attr('data-in-stock') === '1'){
			product_content.find('[data-var-in-stock=1]').show();
			product_content.find('[data-var-in-stock=0]').hide();
		}else{
			product_content.find('[data-var-in-stock=0]').show();
			product_content.find('[data-var-in-stock=1]').hide();
		}
	})

  // личный кабинет (обновление данных)

  $('[name=update_user]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.first_name = $(this).find('[name=account_first_name]').val();
		data.last_name = $(this).find('[name=account_last_name]').val();
		data.user_email = $(this).find('[name=account_email]').val();
		ajaxs('update_user', data);
	});

	$('[name=update_password]').submit(function(e){
		e.preventDefault();
		var data = {};
		data.password_current = $(this).find('[name=password_current]').val();
		data.password_1 = $(this).find('[name=password_1]').val();
		data.password_2 = $(this).find('[name=password_2]').val();
		ajaxs('update_password', data);
	});

	$('[name=update_billing]').submit(function(e){
		e.preventDefault();
		ajaxs('update_billing', $(this));
	});

	$('[name=update_shipping]').submit(function(e){
		e.preventDefault();
		ajaxs('update_shipping', $(this));
	});

})

// выбор вариаций товара

function set_var_price(){
  $('[data-action=product_var_select]').each(function(){
    if($(this).find('option').length){
      product_content = $(this).parents('[data-content=product]');
      product_content.find('[data-variation-id]').hide();
			variation_select = product_content.find('[data-action=product_var_select] option');
			if( variation_select.length === 0 ) return;
      variation_id = variation_select[0].value;
      if(variation_id !== undefined && variation_id !== ''){
        product_content.find('[data-variation-id='+variation_id+']').show();
        if($(this).find('option[value='+variation_id+']').attr('data-in-stock') === '1'){
          product_content.find('[data-var-in-stock=1]').show();
          product_content.find('[data-var-in-stock=0]').hide();
        }else{
          product_content.find('[data-var-in-stock=0]').show();
          product_content.find('[data-var-in-stock=1]').hide();
        }
      }
    }
  });
}

// работа с корзиной

function add_to_cart(){
$('body').on('submit', '[data-name=add_to_cart]', function(e){
e.preventDefault();
var data = {};
var variation_attributes = {}, item_data = {}, complete_select = true;

$('form[name=add_to_cart] select[name^=attribute_pa_], form[name=add_to_cart] input:radio:checked[name^=attribute_pa_]').each(function(){
attribute_name = $(this).attr('name');
attribute_value = $(this).val();
variation_attributes[attribute_name] = attribute_value;
if( attribute_value === '' ) complete_select = false;
});

$('form[name=add_to_cart] select[name^=pa_], form[name=add_to_cart] input:radio:checked[name^=pa_], form[name=add_to_cart] input[type=text][name^=pa_]').each(function(){
attribute_name = $(this).attr('name');
attribute_value = $(this).val();
item_data[attribute_name] = attribute_value;
});

data.product_id = $(this).attr('data-product-id');
data.qty = $(this).find('[data-name=qty]').length === 0 ? '1' : $(this).find('[data-name=qty]').val();
data.variation_id = $(this).attr('data-variation-id');
data.variation_attributes = variation_attributes;
data.item_data = item_data;

$(this).find('[data-name=qty]').val('1');

ajaxs('add_to_cart', data);

$(this).siblings('.w-form-done').show().delay(3000).fadeOut();
return false;
});
}

function change_cart_qty(){

	$('body').on('change', '[data-action=cart_product_qty]', function () {
		product_qty = $(this);
		max_qty = parseInt(product_qty.attr('data-qty-max'));
		cur_qty = parseInt(product_qty.val());
		if (max_qty > cur_qty && max_qty != 0) {
			product_qty.val(product_qty.attr('data-qty-max'));
			var data = {};
			data.id = $(this).attr('data-product-id');
			data.qty = $(this).val();
			ajaxs('change_cart_qty', data, function () {
				ajaxs('recalc_checkout', $('#checkout_form'), function () {
					$('#checkout').css('opacity', '1');
				});
			});
		}
	});

	$('[data-action=cart_product_qty]').change(function(e){
		var data = {};
		data.id = $(this).attr('data-product-id');
		data.qty = $(this).val();
		ajaxs('change_cart_qty', data);
	})

	$('[data-action=cart_qty_plus]').click(function(){
		product_qty = $(this).siblings('[data-name=qty]');
		if (parseInt(product_qty.attr('data-qty-max')) > parseInt(product_qty.val()) 
		|| product_qty.attr('data-qty-max') === undefined
		|| product_qty.attr('data-qty-max') === '0'
		) {
			product_qty.val(parseInt(product_qty.val())+1);
		}
		var data = {};
		data.id = product_qty.attr('data-product-id');
		data.qty = product_qty.val();
		ajaxs('change_cart_qty', data, function(){
			ajaxs('recalc_checkout', $('#checkout_form'), function(){
      	$('#checkout').css('opacity', '1');
    	});
		});

	})

	$('[data-action=cart_qty_minus]').click(function(){
		product_qty = $(this).siblings('[data-name=qty]');
		if(parseInt(product_qty.val()) > 1){
			product_qty.val(parseInt(product_qty.val())-1);
			var data = {};
			data.id = product_qty.attr('data-product-id');
			data.qty = product_qty.val();
			ajaxs('change_cart_qty', data, function(){
				ajaxs('recalc_checkout', $('#checkout_form'), function(){
					$('#checkout').css('opacity', '1');
				});
			});
		}
	});
}

function remove_from_cart(){
	$('body').on('click', '[data-action=cart_product_remove]', function(e){
		var data = {};
		data.key = $(this).attr('data-key');
		ajaxs('ajaxs_cart_remove', data, function(){
			ajaxs('recalc_checkout', $('#checkout_form'), function(){
				$('#checkout').css('opacity', '1');
			});
		});
		return false;
	})
}

// работа с избранным

function add_to_wl(){
	$('body').on('submit', '[data-name=add_to_wl]', function(e){
		console.log('!');
		e.preventDefault();
		var data = {};
		data.id = $(this).attr('data-product-id');
		ajaxs('add_to_wl', data);
		$(this).siblings('.w-form-done').show().delay(3000).fadeOut();
		return false;
	});
}

function wl_remove(){
	$('body').on('click', '[data-action=wl_remove]', function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		ajaxs('wl_remove', data);
		return false;
	})
}

function wl_move(){
	$('body').on('click', '[data-action=wl_move]', function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		ajaxs('wl_move', data);
		return false;
	})
}

function wl_copy(){
	$('body').on('click', '[data-action=wl_copy]', function(e){
		e.preventDefault();
		var data = {};
		data.id = [];
		data.id[0] = $(this).attr('data-product-id');
		ajaxs('wl_copy', data);
		return false;
	})
}

function update_variation( cur_variation ){
  if( cur_variation.id === 0 ){

    $('[data-content^=var_]').hide();
    $('[data-content=var_stocked]').hide();
    $('[name=add_to_cart]').find('[type=submit]').hide();
    if( cur_variation.attributes_complete ){
      $('[data-content=var_not_stocked]').show();
      //$('[name=add_to_cart]').siblings('.w-form-fail').show();
    }

		$('[data-content="var_image"]').show();
		if( cur_variation.parent_image_url ) {
			$('[data-content=var_image]').attr('src', cur_variation.parent_image_url);
			$('[data-content=var_bg_image]').attr('style', 'background-image: url('+cur_variation.parent_image_url+');');
		}

  } else {
		$('[data-content^=var_]').show();
		$('[name=add_to_cart]').find('[type=submit]').show();
		//$('[name=add_to_cart]').siblings('.w-form-fail').hide();
		$('[data-content=var_stocked]').show();
		$('[data-content=var_not_stocked]').hide();
    $('[name=add_to_cart]').attr('data-product-id', cur_variation.id);
    $('[data-content=var_sku]').text( cur_variation.sku ).show();
		$('[data-content=var_stock]').text( cur_variation.stock_quantity ).show();
		$('[data-name=qty]').attr('data-qty-max', cur_variation.stock_quantity);
		$('[data-name=qty]').val(1);
		if (cur_variation.stock_quantity){
			$('[data-content=var_stock_qty]').show();
		}else{
			$('[data-content=var_stock_qty]').hide();
		}
    $('[data-content=var_weight]').text( cur_variation.weight ).show();
    $('[data-content=var_length]').text( cur_variation.length ).show();
    $('[data-content=var_width]').text( cur_variation.width ).show();
    $('[data-content=var_height]').text( cur_variation.height ).show();
    $('[data-content=var_desc]').text( cur_variation.description ).show();
    if( cur_variation.price !== '' ){ $('[data-content=var_price]').html( cur_variation.price ).show(); }
    else { $('[data-content=var_price]').hide(); }
    if( cur_variation.sale_price !== '' ){ $('[data-content=var_price_sale]').html( cur_variation.sale_price ).show(); }
    else { $('[data-content=var_price_sale]').hide(); }
    if( cur_variation.regular_price !== '' ){ $('[data-content=var_price_regular]').html( cur_variation.regular_price ).show(); }
    else { $('[data-content=var_price_regular]').hide(); }
    if( cur_variation.image_url ) {
			$('[data-content=var_image]').attr('src', cur_variation.image_url);
			$('[data-content=var_bg_image]').attr('style', 'background-image: url('+cur_variation.image_url+');');
			$('[data-content=var_lbox_image]').each(function(){
				var lbox_script = $(this).find('script');
				if(lbox_script[0]){
					var lbox_data = JSON.parse(lbox_script.html());
					lbox_data.items[0].url = cur_variation.image_url;
					lbox_script.html(JSON.stringify(lbox_data));
					Webflow.destroy(); Webflow.ready();
				}
			});
		}
			if( cur_variation.stocked ){
				$('[data-content=var_stocked]').show();
				$('[data-content=var_not_stocked]').hide();
			} else {
				$('[data-content=var_stocked]').hide();
				$('[data-content=var_not_stocked]').show();
        //$('[name=add_to_cart]').siblings('.w-form-fail').show();
			}
  }

  default_attributes = cur_variation.attributes;
  for(var key in default_attributes) {
    $('select#'+key+' [value="'+default_attributes[key]+'"]').prop("selected", true);
    $('[type=radio]#'+key+'_'+default_attributes[key]+'[value="'+default_attributes[key]+'"]').each(function(){
      $(this).prop("checked", true);
      $(this).parent().addClass('active');
    });
  }

  $('[data-content="product"]').css('opacity', 1);
  $('[data-action=variation_preload]').hide();
}

function change_variations(){

  var cur_variation, variation_attributes = {};

  if( $('[data-attribute_name]').length ){

    var product_id = $('[data-action="add_to_cart"]').attr('data-product_id');
    if( window.location.search.indexOf('attribute_pa') != -1){
      attributes = window.location.search.replace('?', '').split('&');
      for(var key in attributes) {
        attribute = attributes[key].split('=');
        variation_attributes[attribute[0].replace('attribute_', '')] = attribute[1];
      }
      ajaxs('ajaxs_load_variation', { id: product_id, variation_attributes: variation_attributes },
      function( response ){ update_variation( response ); });
    } else {
      ajaxs('ajaxs_load_variation', { id: product_id, variation_attributes: '' },
      function( response ){ update_variation( response ); });
    }
  }
}

$('body').on('change', 'form[name=add_to_cart] select[data-attribute_name], form[name=add_to_cart] input[data-attribute_name]', function(){

	$('form[name=add_to_cart]').siblings('.w-form-done').hide();

	if( $(this).attr('type') === 'radio' ){
		$(this).parent().parent().find('label').removeClass('active');
		$(this).parent().addClass('active');
	}

	var product_id = $('[data-action="add_to_cart"]').attr('data-product_id');
	var variation_attributes = {}, complete_select = true;

	$('form[name=add_to_cart] select, form[name=add_to_cart] input:radio:checked').each(function(){
		attribute_name = $(this).attr('name');
		attribute_value = $(this).val();
		variation_attributes[attribute_name] = attribute_value;
		if( attribute_value === '' ) complete_select = false;
	});
if( complete_select ){
	$('[data-content="product"]').css('opacity', 0.2);
	$('[data-action=variation_preload]').show();
	ajaxs('ajaxs_load_variation', { id: product_id, variation_attributes: variation_attributes },
	function( response ){ update_variation( response ); });
} else {
	$('[data-content="product"]').css('opacity', 0.2);
	ajaxs('ajaxs_load_variation', { id: product_id, variation_attributes: variation_attributes },
	function( response ){ update_variation( response ); });
}
});
