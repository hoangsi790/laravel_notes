<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Groups extends Model
{
	protected $table = 'groups';
	public function query_groups($user_id,   $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'title', 'content', 'created_at', 'updated_at', 'user_id', 'background_id')->where('user_id', $user_id)->orderBy($order_col, $order_value)->get();
	}
	public function query_group($id, $user_id) {
    	 return DB::table($this->table)->select('id', 'title', 'content', 'background_id')->where('id', $id)->where('user_id', $user_id)->get();
	}
	public function check_exist_group($title, $user_id) {
		return DB::table($this->table)->where('title', $title)->where('user_id', $user_id)->get();
	}
	public function query_create_group($arr_data) {
    	 return DB::table($this->table)->insertGetId($arr_data);
	}
	public function query_edit_group($id, $user_id) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->get();
	}
	public function query_update_group($id, $arr_data, $user_id) {
    	return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->update($arr_data);
	}
	public function query_delete_group($id, $user_id) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->delete();
	}
}