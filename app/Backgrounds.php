<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Backgrounds extends Model
{
	protected $table = 'backgrounds';
	public function query_backgrounds($order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'background')->orderBy($order_col, $order_value)->get();
	}
	public function query_background($id) {
    	 return DB::table($this->table)->select('background')->where('id', $id)->get();
	}
}