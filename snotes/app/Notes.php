<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Notes extends Model
{
	protected $table = 'notes';
	public function query_notes($user_id, $important, $trash, $paginate, $order_col, $order_value) {
    	 return DB::table($this->table)->select('id', 'title', 'content', 'created_at', 'updated_at', 'user_id', 'background_id', 'important')
		 ->where('user_id', $user_id)->where('important', $important)->where('trash', $trash)->orderBy($order_col, $order_value)->orderBy('id', 'desc')->paginate($paginate);
	}
	public function query_note($id, $user_id, $trash) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->where('trash', $trash)->get();
	}
	public function query_create_note($arr_data) {
    	 return DB::table($this->table)->insertGetId($arr_data);
	}
	public function query_edit_note($id, $user_id, $trash) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->where('trash', $trash)->get();
	}
	public function query_update_note($id, $arr_data, $user_id) {
    	return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->update($arr_data);
	}
	public function query_delete_note($id, $user_id) {
		return DB::table($this->table)->where('id', $id)->where('user_id', $user_id)->delete();
	}
	public function query_delete_all_note($user_id) {
		return DB::table($this->table)->where('trash', 1)->where('user_id', $user_id)->delete();
	}
}