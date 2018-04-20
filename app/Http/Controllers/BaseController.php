<?php
namespace App\Http\Controllers;
use Session;
use DB;
use View;
use Request;
use Illuminate\Support\Facades\Input;
class BaseController extends Controller
{
	
		public function __construct() {
			$path='';
			$path= Request::path();
		    View::share('path', $path);
			
			$query_string='';
			$query_string= Request::getQueryString();
		    View::share('query_string', $query_string);
			
			$full_path = $path.$query_string;
			View::share('full_path', $full_path);
			
		}
}