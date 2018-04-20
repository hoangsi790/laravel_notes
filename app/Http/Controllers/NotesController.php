<?php
namespace App\Http\Controllers;
use Session;
use DB;
use View;
use App\Notes;
use App\Backgrounds;
use App\Groups;
use App\Users;
use App\Relationships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Statickidz\GoogleTranslate;
class NotesController extends BaseController
{
	
	public $get_groups2 =  array(); 
	public $count_sentences = '';
	public $count_groups = '';
		public function __construct() {
			parent::__construct(); 
			
			
			
			
			$m_notes = new Notes();
			
			$m_groups = new Groups();
			
			
			$count_sentences = $m_notes->count();
			$count_groups = $m_groups->count();
			View::share('count_sentences', $count_sentences); 
			View::share('count_groups', $count_groups); 
			
			$m_backgrounds = new Backgrounds();
			$groups = $m_groups->query_groups(1, 'title', 'asc');
			// print_r($groups); die();
			if(isset($groups) and count($groups) > 0) { 
				$groups_result = array();
				foreach($groups as $group) {
					$background= '';
					$background = $m_backgrounds->query_background($group->background_id);
					$arr_groups = array();
					$arr_groups['id'] = $group->id;
					$arr_groups['title'] = $group->title;
					$arr_groups['content'] = $group->content;
					$arr_groups['background'] = $background[0]->background;
					$groups_result[] = $arr_groups;
				}
				
			
				$this->get_groups2 = $groups_result;
			//	print_r($this->get_groups2);
				/*die();*/
			 	// $this->pr_die($get_groups2);
			//	return view('notes', compact('groups'));
			}
			
			
			
			
			
		}



	/* ============= */
		public function search(Request $request) {
	
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					if(isset($request->title) and $request->title!='') { $title = $request->title;}
					
					
					$user_id = Session::get('id_user');
					if(isset($request->title) and $request->title!=''  ){
						$check_exist = array();
						$check_exist = $m_notes->check_exist_like($title,  $user_id, 0);
						
						
						
							
							if(isset($check_exist) and count($check_exist) > 0) { 
							$last_result= array();
								foreach($check_exist as $check_ex) { // danh sách kết quả tìm kiếm
									$result= array();
									
									/*$result .= '<li><a href="{{ url('."/".') }}/note/'.$check_ex->id.'/edit">'.$check_ex->title.': '.$check_ex->content.'</a></li>';*/
									$result['id'] = $check_ex->id;
									$result['title'] = $check_ex->title;
									$result['content'] = $check_ex->content;
									$last_result[] = $result;
									
								}
							}
						
						
						
						 return $last_result;
					}
					
					return redirect('/notes');
			} else {
					return redirect('/login');
			}
		}





		public function pr($pr) {
			echo '<pre>'; print_r($pr); echo '</pre>';
		}

		public function pr_die($pr) {
			echo '<pre>'; print_r($pr); echo '</pre>'; die();
		}
		
		public function index() {
			if(Session::has('username') and Session::has('id_user')){
					return redirect('/notes');
			} else {
					return view('index');
			}
		}
		
		public function process_thumbnail($request_thumbnail)  {
			$thumbnail_name = $request_thumbnail->getClientOriginalName(); // tên file, ví dụ : aa.png
			$without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $thumbnail_name); // tên file xóa phần đuôi (png, jpg) của hình
			$ext = $request_thumbnail->getClientOriginalExtension(); // lấy đuôi file, ví dụ png, jpg
			$thumbnail_name_result = str_slug(strtolower($without_ext), '-').'-'.time().'.'.$ext;
			$request_thumbnail->move(public_path('uploads/images'), $thumbnail_name_result);
			return $thumbnail_name_result; // trả về tên file dạng : si-dep-trai-1254751695.png
		}
		/* ============= */
		public function get_backgrounds() {
			$m_backgrounds = new Backgrounds();
			$backgrounds = $m_backgrounds->query_backgrounds('id', 'asc');
			if(isset($backgrounds) and count($backgrounds) > 0) { 
				$backgrounds_result = array();
				foreach($backgrounds as $background) {
					$arr_backgrounds = array();
					$arr_backgrounds['id'] = $background->id;
					$arr_backgrounds['background'] = $background->background;
					$backgrounds_result[] = $arr_backgrounds;
				}
				$backgrounds = array(); $backgrounds = $backgrounds_result;
				return $backgrounds;
			}
		}
		/* ============= */
		public function translates(Request $request) {
			$source = 'ja';
			$target = 'vi';
			if(isset($request->translate) and $request->translate!='') { $text = $request->translate;}
			
			$trans = new GoogleTranslate();
			$result ='';
			$result = $trans->translate($source, $target, $text);
			
			return $result;

		}
		
		
		
		
		
		/* ============= */
		public function get_groups($user_id) {
			$m_groups = new Groups();
			$m_backgrounds = new Backgrounds();
			$groups = $m_groups->query_groups($user_id, 'title', 'asc');
			if(isset($groups) and count($groups) > 0) { 
				$groups_result = array();
				foreach($groups as $group) {
					$background= '';
					$background = $m_backgrounds->query_background($group->background_id);
					$arr_groups = array();
					$arr_groups['id'] = $group->id;
					$arr_groups['title'] = $group->title;
					$arr_groups['content'] = $group->content;
					$arr_groups['background'] = $background[0]->background;
					$groups_result[] = $arr_groups;
				}
				$groups = array(); $groups = $groups_result;
				return $groups;
			}
		}
		
		/* ============= */
		public function notes(Request $request) {
			
			
			
			if(Session::has('username') and Session::has('id_user')){
				
					$query_string =  $request->getQueryString();
					
					if(isset($query_string) and $query_string=='mail') {
						$key_sentence = 1;
					} else {
						$key_sentence = 0;
					}
				
					$m_notes = new Notes();
					$m_backgrounds = new Backgrounds();
					$m_relationships = new Relationships();
					$notes = $m_notes->query_notes(Session::get('id_user'), 0, 0, 20, $key_sentence, 'num_order', 'asc');
					$paginate_notes = $notes; // phân trang
					// $this->pr_die($notes);

					if(isset($notes) and count($notes) > 0) { 
							$notes_result = array();
							foreach($notes as $note) {
									$background= '';
									$background = $m_backgrounds->query_background($note->background_id);
									$arr_notes= array();
									$arr_notes['id'] = $note->id;
									$arr_notes['title'] = $note->title;
									$arr_notes['title_ja'] = $note->title_ja;
									$arr_notes['content'] = $note->content;
									$arr_notes['content_ja'] = $note->content_ja;
									$arr_notes['key_sentence'] = $note->key_sentence;
									$arr_notes['created_at'] = $note->created_at;
									$arr_notes['updated_at'] = $note->updated_at;
									$arr_notes['user_id'] = $note->user_id;
									$arr_notes['background'] = $background[0]->background;
									/* ------------------ */
										$relationships = array();
										$relationships = $m_relationships->query_relationship_02('note_id', $note->id, Session::get('id_user'), 'id', 'desc');
										if(isset($relationships) and count($relationships) > 0) { 
											$m_groups = new Groups();
											$groups_result = array();
											foreach($relationships as $relationship) {
												$group_id=''; $group_id = $relationship->group_id;
												$groups = $m_groups->query_group($group_id, Session::get('id_user'));
												if(isset($groups) and count($groups) > 0) { 
													$background= '';
													$background = $m_backgrounds->query_background($groups[0]->background_id);
													$arr_groups= array();
													$arr_groups['id'] = $groups[0]->id;
													$arr_groups['title'] = $groups[0]->title;
													$arr_groups['background'] = $background[0]->background;
													$groups_result[] = $arr_groups;
												}
											}
											$arr_notes['groups'] = $groups_result;
										}
								/* ------------------ */

								$notes_result[] = $arr_notes;
							}
							$notes = array(); $notes = $notes_result;
					  }
					// $this->pr_die($notes);
					$backgrounds = array();
					$backgrounds = $this->get_backgrounds();
				//	$groups = array();
				//	$groups = $this->get_groups(Session::get('id_user'));
					
					$groups = $this->get_groups2;
			
					
					 return view('notes', compact('notes', 'groups',  'backgrounds', 'paginate_notes'));
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		
		public function get_groups_page() {
			$m_groups = new Groups();
			$m_backgrounds = new Backgrounds();
			$groups = $m_groups->query_groups(Session::get('id_user'),  'title', 'asc');
			if(isset($groups) and count($groups) > 0) { 
				$groups_result = array();
				foreach($groups as $group) {
					$background= '';
					$background = $m_backgrounds->query_background($group->background_id);
					$arr_groups = array();
					$arr_groups['id'] = $group->id;
					$arr_groups['title'] = $group->title;
					$arr_groups['content'] = $group->content;
					$arr_groups['background'] = $background[0]->background;
					$groups_result[] = $arr_groups;
				}
				$groups = array(); $groups = $groups_result;
				// $this->pr_die($groups);
				return view('notes', compact('groups'));
			}
		}
		/* ============= */
		
		public function sort_note(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					if(isset($request->arr_id_note)) {
							$arr_id_sort = array();
							$arr_id_sort = explode(',', $request->arr_id_note);	
							// $this->pr_die($arr_id_sort);
							if(isset($arr_id_sort) and count($arr_id_sort) > 0) { 
								foreach($arr_id_sort as $key_id_sort => $id_sort) {
									$arr_update_sort = array();
									$id_update = $id_sort;
									$arr_update_sort['num_order'] = $key_id_sort;
									$update_sort_note = $m_notes->query_update_note($id_update, $arr_update_sort, Session::get('id_user'));
								}
							}
					}
					return redirect('/notes');
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function check_exist(Request $request) {
		
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					if(isset($request->title) and $request->title!='') { $title = $request->title;}
					$user_id = Session::get('id_user');
					if(isset($request->title) and $request->title!=''  ){
						$check_exist = array();
						$check_exist = $m_notes->check_exist($title,  $user_id, 0);
						$last_result = '';
						if(isset($check_exist) and count($check_exist)>0) {
							$title_m = $check_exist[0]->title;	$content_m = $check_exist[0]->content;
							$last_result = $title_m.': '.$content_m; 
						}
						 return $last_result;
					}
					
					return redirect('/notes');
			} else {
					return redirect('/login');
			}
		}
		
		/* ============= */
		public function check_exist_group(Request $request) {
		
			if(Session::has('username') and Session::has('id_user')){
					$m_groups = new Groups();
					if(isset($request->title) and $request->title!='') { $title = $request->title;}
					$user_id = Session::get('id_user');
					if(isset($request->title) and $request->title!=''  ){
						$check_exist_group = array();
						$check_exist_group = $m_groups->check_exist_group($title,  $user_id);
						 return $check_exist_group;
					}
					
					return redirect('/notes');
			} else {
					return redirect('/login');
			}
		}
		
		/* ============= */
		public function get_note_by_group(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
				
					$query_string =  $request->getQueryString();
					
					if(isset($query_string) and $query_string=='mail') {
						$key_sentence = 1;
					} else {
						$key_sentence = 0;
					}
				
					$m_notes = new Notes();
					$m_groups = new Groups();
					$m_backgrounds = new Backgrounds();
					$m_relationships = new Relationships();
					if(isset($request->id) and $request->id!='') { 
						$group_id = $request->id;
						$relationships = $m_relationships->query_relationship('group_id', $group_id, Session::get('id_user'), 20,  'id', 'desc');
						$paginate_notes = $relationships; // phân trang
						if(isset($relationships) and count($relationships) > 0) { 
							$notes_result = array();
							$groups_result = array();
							foreach($relationships as $relationship) {
									$note = array();
									 if(isset($query_string) and $query_string=='full') {
										$note = $m_notes->query_note_03($relationship->note_id, Session::get('id_user'), 0);
									}  else {
										$note = $m_notes->query_note_02($relationship->note_id, Session::get('id_user'), 0, $key_sentence);
									}
									
									
									if(isset($note) and count($note) > 0) { 
											$background= array();
											$background = $m_backgrounds->query_background($note[0]->background_id);
											
											$arr_notes= array();
											$arr_notes['id'] = $note[0]->id;
											$arr_notes['title'] = $note[0]->title;
											$arr_notes['title_ja'] = $note[0]->title_ja;
											$arr_notes['content'] = $note[0]->content;
											$arr_notes['content_ja'] = $note[0]->content_ja;
											$arr_notes['key_sentence'] = $note[0]->key_sentence;
											$arr_notes['created_at'] = $note[0]->created_at;
											$arr_notes['updated_at'] = $note[0]->updated_at;
											$arr_notes['user_id'] = $note[0]->user_id;
											$arr_notes['background'] = $background[0]->background;
											/* ------------------ */
											$relationships = array();
												$relationships = $m_relationships->query_relationship_02('note_id', $note[0]->id, Session::get('id_user'),   'id', 'desc');
												if(isset($relationships) and count($relationships) > 0) { 
													$m_groups = new Groups();
													$groups_result = array();
													foreach($relationships as $relationship) {
														$group_id=''; $group_id = $relationship->group_id;
														$groups = $m_groups->query_group($group_id, Session::get('id_user'));
														if(isset($groups) and count($groups) > 0) { 
															$background= '';
															$background = $m_backgrounds->query_background($groups[0]->background_id);
															$arr_groups= array();
															$arr_groups['id'] = $groups[0]->id;
															$arr_groups['title'] = $groups[0]->title;
															$arr_groups['background'] = $background[0]->background;
															$groups_result[] = $arr_groups;
														}
													}
													$arr_notes['groups'] = $groups_result;
												}
										/* ------------------ */
										$notes_result[] = $arr_notes;
									}
									
								
									
							}
							
							$notes = array(); $notes = $notes_result;
							
							
							
					  }
					
					$backgrounds = array();
					$backgrounds = $this->get_backgrounds();
					$groups = array();
					$groups = $this->get_groups(Session::get('id_user'));
					
					//$this->pr($paginate_notes); die();
					
					return view('notes', compact('notes', 'groups', 'backgrounds', 'paginate_notes'));
					
					}
					
					
					
			} else {
					return redirect('/login');
			}
		}
		
		/* ============= */
		public function trash() {
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					$m_backgrounds = new Backgrounds();
					$notes = $m_notes->query_trash(Session::get('id_user'), 0, 1, 25, 'num_order', 'desc');
					if(isset($notes) and count($notes) > 0) { 
							$notes_result = array();
							foreach($notes as $note) {
									$background= '';
									$background = $m_backgrounds->query_background($note->background_id);
									$arr_notes= array();
									$arr_notes['id'] = $note->id;
									$arr_notes['title'] = $note->title;
									$arr_notes['title_ja'] = $note->title_ja;
									$arr_notes['content'] = $note->content;
									$arr_notes['content_ja'] = $note->content_ja;
									$arr_notes['key_sentence'] = $note->key_sentence;
									$arr_notes['created_at'] = $note->created_at;
									$arr_notes['updated_at'] = $note->updated_at;
									$arr_notes['user_id'] = $note->user_id;
									$arr_notes['background'] = $background[0]->background;
									$notes_result[] = $arr_notes;
							}
							$notes_trash = array(); $notes_trash = $notes_result;
					  }
					$backgrounds = array();
					$backgrounds = $this->get_backgrounds();
					$groups = array();
					$groups = $this->get_groups(Session::get('id_user'));
					return view('trash', compact('notes_trash', 'groups', 'backgrounds'));
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		
		public function new_note() {
			if(Session::has('username') and Session::has('id_user')){
					$backgrounds = array();
					$backgrounds = $this->get_backgrounds();
					$groups = array();
					$groups = $this->get_groups(Session::get('id_user'));
					return view('new_note', compact('backgrounds', 'groups'));
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function create_note(Request $request) {
			 // $this->pr_die($request->content);
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					$arr_create = array();
					if(isset($request->title) and $request->title!='') { $arr_create['title'] = $request->title;}
					if(isset($request->title_ja) and $request->title_ja!='') { $arr_create['title_ja'] = $request->title_ja;}
					if(isset($request->content) and $request->content!='') {  $arr_create['content'] = $request->content;}
					if(isset($request->content_ja) and $request->content_ja!='') {  $arr_create['content_ja'] = $request->content_ja;}
					if(isset($request->use_th) and $request->use_th!='') {  $arr_create['use_th'] = $request->use_th;}
					if(isset($request->furigana) and $request->furigana!='') {  $arr_create['furigana'] = $request->furigana;}
					if(isset($request->key_sentence) and $request->key_sentence!='') {  $arr_create['key_sentence'] = $request->key_sentence;}
					if(isset($request->background_id) and $request->background_id!='') {  $arr_create['background_id'] = $request->background_id;}
					
					
					$arr_create['user_id'] = Session::get('id_user');
					$arr_create['num_order'] = 0;
					$arr_create['trash'] = 0;
					if( (isset($request->title) and $request->title!='') ) {
						$create_note = $m_notes->query_create_note($arr_create);
						// tạo relationship group
						if(isset($request->group) and $request->group!='') {
						$groups = $request->group;
						$m_relationships = new Relationships();
						if(isset($groups) and count($groups) > 0) { 
							foreach($groups as $group) {
								$arr_create = array();
								$arr_create['note_id'] = $create_note; // id note vừa sinh ra ở trên
								$arr_create['group_id'] = $group;
								$arr_create['user_id'] = Session::get('id_user');
								$create_relationship = $m_relationships->query_create_relationship($arr_create);
							}
						}
						// kết thúc tạo relationship group
					}
					if(isset($request->key_sentence) and $request->key_sentence==0) {
						return redirect('/notes');
					} else if (isset($request->key_sentence) and $request->key_sentence==1) {
						return redirect('/notes?mail');
					}
						
					}
			} else {
					return redirect('/login');
			}
			
		}
		/* ============= */
		
		
		
		
		
		
		
		public function create_note_ajax(Request $request) {
			// $this->pr_die($request->group);
			
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					$arr_create = array();
					if(isset($request->title) and $request->title!='') { $arr_create['title'] = $request->title;}
					if(isset($request->content) and $request->content!='') {  $arr_create['content'] = $request->content;}
					if(isset($request->furigana) and $request->furigana!='') {  $arr_create['furigana'] = $request->furigana;}
					
					
					$arr_create['user_id'] = Session::get('id_user');
					$arr_create['num_order'] = 0;
					$arr_create['trash'] = 0;
					
						
					if( (isset($request->title) and $request->title!='')  ) {
						$create_note = $m_notes->query_create_note($arr_create);
						
						// tạo relationship group
						if(isset($request->group) and $request->group!='') {
						$groups = $request->group;
						$m_relationships = new Relationships();
						if(isset($groups) and count($groups) > 0) { 
							foreach($groups as $group) {
								$arr_create = array();
								$arr_create['note_id'] = $create_note; // id note vừa sinh ra ở trên
								$arr_create['group_id'] = $group;
								$arr_create['user_id'] = Session::get('id_user');
								$create_relationship = $m_relationships->query_create_relationship($arr_create);
							}
						}
						
						}
					// kết thúc tạo relationship group
						return $create_note;
					}
			} else {
					return redirect('/login');
			}
			
		}
		/* ============= */
		
		
		
		
		
		
		
		
		
		
		
		public function edit_note(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
					$id_edit = $request->id;
					$backgrounds = array();
					$groups = array();
					$notes =  array();
					$m_notes = new Notes();
					$m_backgrounds = new Backgrounds();
					$m_relationships = new Relationships();
					$notes = $m_notes->query_edit_note($id_edit, Session::get('id_user'), 0);
					if(isset($notes) and count($notes) > 0) { 
						$notes_result = array();
						foreach($notes as $note) {
								$background= '';
								$background = $m_backgrounds->query_background($note->background_id);
								$arr_notes= array();
								$arr_notes['id'] = $note->id;
								$arr_notes['title'] = $note->title;
								$arr_notes['title_ja'] = $note->title_ja;
								$arr_notes['content'] = $note->content;
								$arr_notes['content_ja'] = $note->content_ja;
								$arr_notes['use_th'] = $note->use_th;
								$arr_notes['key_sentence'] = $note->key_sentence;
								$arr_notes['furigana'] = $note->furigana;
								$arr_notes['created_at'] = $note->created_at;
								$arr_notes['updated_at'] = $note->updated_at;
								$arr_notes['user_id'] = $note->user_id;
								$arr_notes['background'] = $background[0]->background;
								/* ------------------ */
										$relationships = array();
										$relationships = $m_relationships->query_relationship('note_id', $note->id, Session::get('id_user'), 20,  'id', 'desc');
										if(isset($relationships) and count($relationships) > 0) { 
											$m_groups = new Groups();
											$groups_result = array();
											foreach($relationships as $relationship) {
												$group_id=''; $group_id = $relationship->group_id;
												$groups = $m_groups->query_group($group_id, Session::get('id_user'));
												if(isset($groups) and count($groups) > 0) { 
													$background= '';
													$background = $m_backgrounds->query_background($groups[0]->background_id);
													$arr_groups= array();
													$arr_groups['id'] = $groups[0]->id;
													$arr_groups['title'] = $groups[0]->title;
													$arr_groups['background'] = $background[0]->background;
													$groups_result[] = $arr_groups;
												}
											}
											$arr_notes['groups'] = $groups_result;
										}
								/* ------------------ */
								$notes_result[] = $arr_notes;
						}
						$notes = array(); $notes = $notes_result;
					}
					// $this->pr_die($notes);
					$backgrounds = $this->get_backgrounds();
					$groups = $this->get_groups(Session::get('id_user'));
					return view('edit_note', compact('notes', 'backgrounds', 'groups'));
				}
			} else {
					return redirect('/login');
			}
			
			
		}
		/* ============= */
		public function update_note(Request $request) {
			
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
						$m_notes = new Notes();
						$id_update = $request->id;
						$arr_update = array();
						if(isset($request->title) and $request->title!='') { $arr_update['title'] = $request->title;}
						if(isset($request->title_ja) and $request->title_ja!='') { $arr_update['title_ja'] = $request->title_ja;}
						if(isset($request->content) and $request->content!='') {  $arr_update['content'] = $request->content;}
						if(isset($request->content_ja) and $request->content_ja!='') {  $arr_update['content_ja'] = $request->content_ja;}
						if(isset($request->use_th) and $request->use_th!='') { $arr_update['use_th'] = $request->use_th;}
						if(isset($request->furigana) and $request->furigana!='') {  $arr_update['furigana'] = $request->furigana;}
						if(isset($request->background_id) and $request->background_id!='') {  $arr_update['background_id'] = $request->background_id;}
						if( (isset($request->title) and $request->title!='') or (isset($request->content) and $request->content!='') or  (isset($request->title_ja) and $request->title_ja!='') or (isset($request->content_ja) and $request->content_ja!='') or (isset($request->background_id) and $request->background_id!='') or (isset($request->group) and $request->group!='') ) {
							$update_note = $m_notes->query_update_note($id_update, $arr_update, Session::get('id_user'));
							
							// xóa và tạo relationship group
							/* ------------------ */
							if(isset($request->group) and $request->group!='') {
								$groups = $request->group;
								$m_relationships = new Relationships();
								$current_relationships = array();
								$current_relationships = $m_relationships->query_relationship('note_id', $id_update, Session::get('id_user'),20, 'id', 'desc');
								if(isset($current_relationships) and count($current_relationships) > 0) { 
									foreach($current_relationships as $current_relationship) {
										$delete_current_relationship = $m_relationships->query_delete_relationship('note_id', $id_update, Session::get('id_user'));
									}
								}
								/* ------------------ */
								if(isset($groups) and count($groups) > 0) { 
									foreach($groups as $group) {
										$arr_create = array();
										$arr_create['note_id'] = $id_update; // id note vừa sinh ra ở trên
										$arr_create['group_id'] = $group;
										$arr_create['user_id'] = Session::get('id_user');
										$create_relationship = $m_relationships->query_create_relationship($arr_create);
									}
								}
								/* ------------------ */
							
							} else {
								$m_relationships = new Relationships();
								$current_relationships = array();
								$current_relationships = $m_relationships->query_relationship('note_id', $id_update, Session::get('id_user'), 20,  'id', 'desc');
								if(isset($current_relationships) and count($current_relationships) > 0) { 
									foreach($current_relationships as $current_relationship) {
										$delete_current_relationship = $m_relationships->query_delete_relationship('note_id', $id_update, Session::get('id_user'));
									}
								}
							}
							// kết thúc xóa và tạo relationship group
							if(isset($request->key_sentence) and $request->key_sentence==0) {
									return redirect('/notes');
								} else if (isset($request->key_sentence) and $request->key_sentence==1) {
									return redirect('/notes?mail');
								}
						}
					}
			} else {
					return redirect('/login');
			}
		}
		/* ============= */

		public function update_note_ajax(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					$arr_update = array();
					if(isset($request->id) and $request->id!='') { $id = $request->id;}
					if(isset($request->flag) and $request->flag!='') { 
					$flag = $request->flag;
						if($flag=='title') {
							if(isset($request->sentence) and $request->sentence!='') { $arr_update['title'] = $request->sentence;}
						} elseif($flag=='content') {
							if(isset($request->sentence) and $request->sentence!='') { $arr_update['content'] = $request->sentence;}
						}
					
					}
					
					
					$user_id = Session::get('id_user');
					if(isset($request->sentence) and $request->sentence!=''  ){
						$update_note = $m_notes->query_update_note($id, $arr_update, $user_id);
						 return $update_note;
					}
			} else {
					return redirect('/login');
			}
			
		}
		
				/* ============= */
		
		public function trash_note(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
						$id_restore = $request->id;
						$m_notes = new Notes();
						$arr_update =  array();
						$arr_update['trash'] = 1;
						$restore_note = $m_notes->query_update_note($id_restore, $arr_update, Session::get('id_user'));
						$link_return = $_SERVER['HTTP_REFERER'];
      					return redirect( $link_return );
					}
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function delete_note(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
						$id_delete = $request->id;
						$m_notes = new Notes();
						$m_relationships = new Relationships();
						$delete_note = $m_notes->query_delete_note($id_delete, Session::get('id_user'));
						
						/* ------------------ */
							$relationships = array();
							$relationships = $m_relationships->query_relationship_02('note_id', $id_delete, Session::get('id_user'), 'id', 'desc');
							if(isset($relationships) and count($relationships) > 0) { 
								foreach($relationships as $relationship) {
									$delete_relationship = $m_relationships->query_delete_relationship('note_id', $id_delete, Session::get('id_user'));
								}
							}
						/* ------------------ */
						
						
						$link_return = $_SERVER['HTTP_REFERER'];
      					return redirect( $link_return );
					}
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function delete_all_note() {
			if(Session::has('username') and Session::has('id_user')){
					$m_notes = new Notes();
					$m_relationships = new Relationships();
					
					$note_need_dels = array();
					$note_need_dels = $m_notes->query_note_need_del(Session::get('id_user'), 1);
					if(isset($note_need_dels) and count($note_need_dels) > 0) { 
							foreach($note_need_dels as $note_need_del) {
								$delete_relationship = $m_relationships->query_delete_relationship('note_id', $note_need_del->id, Session::get('id_user'));
							}
					}
					$delete_all_note = $m_notes->query_delete_all_note(Session::get('id_user'));
					return redirect('/trash');
					
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function restore_note(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
						$id_restore = $request->id;
						$m_notes = new Notes();
						$arr_update =  array();
						$arr_update['trash'] = 0;
						$restore_note = $m_notes->query_update_note($id_restore, $arr_update, Session::get('id_user'));
						return redirect('/trash');
					}
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function create_group(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					$m_groups = new Groups();
					$arr_create = array();
					
					if(isset($request->title) and $request->title!='') { $arr_create['title'] = $request->title;}
					if(isset($request->content) and $request->content!='') {  $arr_create['content'] = $request->content;}
					if(isset($request->background_id) and $request->background_id!='') {  $arr_create['background_id'] = $request->background_id;}
					$arr_create['user_id'] = Session::get('id_user');
					if(isset($request->title) and $request->title!='' ) {
						$create_group = $m_groups->query_create_group($arr_create);
						return $create_group;
					}
			} else {
					return redirect('/login');
			}
			
		}
		/* ============= */
		public function update_group(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					$m_groups = new Groups();
					$arr_update = array();
					if(isset($request->id) and $request->id!='') { $id = $request->id;}
					if(isset($request->title) and $request->title!='') { $arr_update['title'] = $request->title;}
					$user_id = Session::get('id_user');
					if(isset($request->title) and $request->title!='' ) {
						$update_group = $m_groups->query_update_group($id, $arr_update, $user_id);
						 return $update_group;
					}
			} else {
					return redirect('/login');
			}
			
		}
		/* ============= */
		public function delete_group(Request $request) {
			if(Session::has('username') and Session::has('id_user')){
					if(isset($request->id) and $request->id!='') { 
						$id_delete = $request->id;
						$m_groups = new Groups();
						$m_relationships = new Relationships();
						$delete_group = $m_groups->query_delete_group($id_delete, Session::get('id_user'));
						
						/* ------------------ */
							$relationships = array();
							$relationships = $m_relationships->query_relationship_02('group_id', $id_delete, Session::get('id_user'), 'id', 'desc');
							if(isset($relationships) and count($relationships) > 0) { 
								foreach($relationships as $relationship) {
									$delete_relationship = $m_relationships->query_delete_relationship('group_id', $id_delete, Session::get('id_user'));
								}
							}
						/* ------------------ */
						
						
						
						return redirect('/notes');
					}
			} else {
					return redirect('/login');
			}
		}
		/* ============= */
		public function login_form() {
			if(Session::has('username') and Session::has('id_user')){
					 return redirect('/notes');
			} else {
					return view('login');
			}
		}
		/* ============= */
		public function login(Request $request) {
			$m_users = new Users();
			$request_username = $request->username; // nhận user từ form
			$request_password = $request->password; // nhận pass từ form
			
			$get_user_login=''; $get_user_pass='';
			$get_username = $m_users->query_user( 'username', $request_username, 'id', 'desc');
			$get_email = $m_users->query_user( 'email',$request_username,  'id', 'desc');
			if( (isset($get_username[0]->id) and $get_username[0]->id!='') or  (isset($get_email[0]->id) and $get_email[0]->id!='') ) {
				// kiếm tra tồn tại user
				if(isset($get_username[0]->id) and $get_username[0]->id!='') {
					$user_id = $get_username[0]->id;
				} elseif(isset($get_email[0]->id) and $get_email[0]->id!='') {
					$user_id = $get_email[0]->id;
				}
				// kết thúc kiếm tra tồn tại user
				$user = array();
				$user = $m_users->query_user( 'id', $user_id, 'id', 'desc'); // lấy pass
				$get_password = $user[0]->password; // định dạng md5

				// kiểm tra tài khoản và mật khẩu
				$alert_fail='';
				if($get_password == md5($request_password)) {
								$get_status = $user[0]->status;
								if($get_status==0) {
									$alert_fail = 'Tài khoản chưa được kích hoạt !';
								} else {
									// xử lý
												Session::put('id_user', $user[0]->id);
												Session::put('username', $user[0]->username);
												/*Session::put('email', $user[0]->email);
												Session::put('display_name', $user[0]->display_name);*/
												
												Session::push('user_session.id_user', $user[0]->id);
												Session::push('user_session.username', $user[0]->username);
												Session::push('user_session.email', $user[0]->email);
												Session::push('user_session.display_name', $user[0]->display_name);

												if(Session::get('username')!=''){
														 return redirect('/notes'); // khác 0 thì vào trang admin
												}  else {
														return redirect('/login'); // trở lại trang đăng nhập
												}
									// kết thúc xử lý
								}

							} else {
								$alert_fail = 'Sai mật khẩu!';
								return view('login', compact('alert_fail'));
							}
				// kết thúc kiểm tra tài khoản và mật khẩu

			} else {
				$alert_fail = 'Tài khoản không tồn tại !';
				return view('login', compact('alert_fail'));
			}

			
		}
		/* ============= */
		public function logout() {
			Session::flush();
			return redirect('/login');
		  }
		/* ============= */
		public function register() {
		}
		/* ============= */
		public function reset_password() {
		}
		/* ============= */
}