<?php
class input
{
	public static function clear($val, $type){
		if($type == 'email'){
			return filter_var($val, FILTER_SANITIZE_EMAIL);
		}else if($type == 'string'){
			return filter_var($val, FILTER_SANITIZE_STRING);
		}else if($type == 'url'){
			return filter_var($val, FILTER_SANITIZE_URL);
		}
	}

	public static function is_ajax_request()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		    AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
			return true;
		}
	}

}