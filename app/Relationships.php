<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Relationships extends Model
{
	protected $table = 'relationships';
	public function query_relationships($user_id,  $paginate, $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'note_id', 'group_id', 'user_id')->where('user_id', $user_id)->orderBy($order_col, $order_value)->get();
	}
	public function query_relationship($field_name, $field_value, $user_id, $paginate, $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'note_id', 'group_id', 'user_id')->where($field_name, $field_value)->orderBy($order_col, $order_value)->where('user_id', $user_id)->paginate($paginate);
	}
	public function query_relationship_02($field_name, $field_value, $user_id,  $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'note_id', 'group_id', 'user_id')->where($field_name, $field_value)->orderBy($order_col, $order_value)->where('user_id', $user_id)->get();
	}
	public function query_create_relationship($arr_data) {
    	 return DB::table($this->table)->insertGetId($arr_data);
	}
	public function query_edit_relationship($id, $user_id) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->get();
	}
	public function query_update_relationship($id, $arr_data, $user_id) {
    	return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->update($arr_data);
	}
	public function query_delete_relationship($field_name, $field_value, $user_id) {
		return DB::table($this->table)->where($field_name, $field_value)->where('user_id', $user_id)->delete();
	}
	public function query_delete_all_relationship($user_id) {
		return DB::table($this->table)->where('user_id', $user_id)->delete();
	}
}