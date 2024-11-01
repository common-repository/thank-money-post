<?php

/*
Plugin Name: Thank Money Post
Plugin URI: http://wordpress.org/plugins/thank-money-post/
Description: Плагин для вывод кнопки пожертвовать через Яндекс.Деньги в публикации. 
Version: 1.2
Author: Maiboroda V. A.
Author URI: http://www.maiboroda.ru
*/

/*  Copyright 2012 - 2014  Maiboroda V. A.  (email: maiboroda-vladimir@yandex.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_init', 'thank_admin_init');
	
function thank_admin_menu(){
    add_options_page('Кнопка пожертвовать', 'Кнопка пожертвовать', 8, basename(__FILE__), 'edit_buttom_thank');
}

add_action('admin_menu', 'thank_admin_menu');
add_option('thank_account', '');
add_option('thank_cel', '');
add_option('thank_summ', '');
add_option('thank_project', get_option('blogname'));


if ($_POST['getupdate'] == 1) {
	update_option('thank_account', $_POST['account_num']);
	update_option('thank_cel', $_POST['cel']);
	update_option('thank_summ', $_POST['summ']);
	update_option('thank_project', $_POST['project']);
}

function edit_buttom_thank() {

$plugin_path = plugin_dir_path(__FILE__);

	print '
		<div class="wrap">
		    <h2>Настройка кнопки пожетвовать</h2>
		    
		    <div class="thank-form">
		    
		    <form method="post" name="update_form">
		    
				<table class="form-table">
				  <tbody>
				    <tr valign="top">
				      <th scope="row"><label for="account_num">Номер кошелька</label></th>
				      <td><input name="account_num" type="text" id="account_num" value="'.get_option('thank_account').'" class="regular-text"><p class="description">Цифровой номер кошелька Яндекс.Деньги.</p></td>
				    </tr>
				    <tr valign="top">
				      <th scope="row"><label for="cel">Цель сбора средств</label></th>
				      <td><input name="cel" type="text" id="cel" value="'.get_option('thank_cel').'" class="regular-text">
				        <p class="description">Объясните в нескольких словах, цель сбора средств.</p></td>
				    </tr>
				    <tr valign="top">
				      <th scope="row"><label for="summ">Сумма</label></th>
				      <td><input name="summ" type="text" id="summ" value="'.get_option('thank_summ').'" class="regular-text code"><p class="description">Укажите сумму пожертвования.</p></td>
				    </tr>
				    <tr valign="top">
				      <th scope="row"><label for="project">Название проекта</label></th>
				      <td><input name="project" type="text" id="project" value="'.get_option('thank_project').'" class="regular-text code">
				      	<p class="description">Название ваше проекта</p>
					  </td>
				    </tr>
				  </tbody>
				</table>
				
				<input type="hidden" name="getupdate" value="1" />
				
				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения"></p>

		    </form>
		    
		    </div>
	
		
			<p><strong>Для вызова в публикации используйте следующий код:</strong> [thank_post]</p>
			
			
		</div>
	';
	
	print '<h4>Превью блока пожертвования</h4>';
	
	print "<div id=\"thank_money_post\"><iframe frameborder='0' allowtransparency='true' scrolling='no' src='https://money.yandex.ru/embed/donate.xml?account=".get_option('thank_account')."&quickpay=donate&payment-type-choice=on&default-sum=".get_option('thank_summ')."&targets=".get_option('thank_cel')."&target-visibility=on&project-name=".get_option('thank_project')."&project-site=".home_url()."&button-text=01&mail=on' width='522' height='131'></iframe></iframe></div>";
	
}


function thank_shortcode () {
		return "<div id=\"thank_money_post\"><iframe frameborder='0' allowtransparency='true' scrolling='no' src='https://money.yandex.ru/embed/donate.xml?account=".get_option('thank_account')."&quickpay=donate&payment-type-choice=on&default-sum=".get_option('thank_summ')."&targets=".get_option('thank_cel')."&target-visibility=on&project-name=".get_option('thank_project')."&project-site=".home_url()."&button-text=01&mail=on' width='522' height='131'></iframe></iframe></div>";
}

add_shortcode('thank_post', 'thank_shortcode');
?>