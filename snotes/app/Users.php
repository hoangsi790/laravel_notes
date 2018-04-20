<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
	protected $table = 'users';
	public function query_users($user_id, $important, $trash, $paginate, $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'username', 'password', 'email', 'display_name', 'thumbnail', 'created_at', 'updated_at', 'user_id')
		 ->where('user_id', $user_id)->where('trash', $trash)->orderBy($order_col, $order_value)->paginate($paginate);
	}
	public function query_user($field_name, $field_value, $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'username', 'password', 'email', 'display_name', 'thumbnail', 'created_at', 'updated_at', 'status')->where($field_name, $field_value)->orderBy($order_col, $order_value)->get();
	}
	public function query_create_user($arr_data) {
    	 return DB::table($this->table)->insertGetId($arr_data);
	}
	public function query_edit_user($id, $user_id) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->get();
	}
	public function query_update_user($id, $arr_data) {
    	return DB::table($this->table)->where('id', $id)->update($arr_data);
	}
	public function query_delete_user($id) {
		return DB::table($this->table)->where('id', $id)->delete();
	}
}