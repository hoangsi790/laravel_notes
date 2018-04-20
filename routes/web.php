<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
	'as' => 'user.index',
	'uses' => 'NotesController@login'
]);

Route::get('/login', [
	'as' => 'user.login_form',
	'uses' => 'NotesController@login_form'
]);

Route::post('/login', [
	'as' => 'user.login',
	'uses' => 'NotesController@login'
]);

 Route::get('/logout', [
	'as' => 'user.logout',
	'uses' => 'NotesController@logout'
]);

 Route::get('/register', [
	'as' => 'user.register_form',
	'uses' => 'NotesController@register_form'
]);

 Route::post('/register', [
	'as' => 'user.register',
	'uses' => 'NotesController@register'
]);

/* ============= */


Route::post('/translates', [
	'as' => 'user.translates',
	'uses' => 'NotesController@translates'
]);

Route::get('/notes', [
	'as' => 'note.notes',
	'uses' => 'NotesController@notes'
]);



Route::post('/search', [
	'as' => 'note.search',
	'uses' => 'NotesController@search'
]);

Route::post('/note/check_exist', [
	'as' => 'note.check_exist',
	'uses' => 'NotesController@check_exist'
]);

Route::post('/group/check_exist_group', [
	'as' => 'group.check_exist_group',
	'uses' => 'NotesController@check_exist_group'
]);

Route::post('/sort_note', [
	'as' => 'note.sort_note',
	'uses' => 'NotesController@sort_note'
]);

Route::get('/trash', [
	'as' => 'note.trash',
	'uses' => 'NotesController@trash'
]);

Route::get('/note/new', [
	'as' => 'note.new_note',
	'uses' => 'NotesController@new_note'
]);

Route::post('/note/create', [
	'as' => 'note.create_note',
	'uses' => 'NotesController@create_note'
]);

Route::post('/note/create_ajax', [
	'as' => 'note.create_note_ajax',
	'uses' => 'NotesController@create_note_ajax'
]);

Route::get('/note/{id}/edit', [
	'as' => 'note.edit_note',
	'uses' => 'NotesController@edit_note'
]);

Route::put('/note/{id}/update', [
	'as' => 'note.update_note',
	'uses' => 'NotesController@update_note'
]);

Route::post('/note/{id}/update_note_ajax', [
	'as' => 'note.update_note_ajax',
	'uses' => 'NotesController@update_note_ajax'
]);


Route::get('/note/{id}/trash', [
	'as' => 'note.trash_note',
	'uses' => 'NotesController@trash_note'
]);

Route::get('/note/{id}/delete', [
	'as' => 'note.delete_note',
	'uses' => 'NotesController@delete_note'
]);
Route::get('/trash/delete_all', [
	'as' => 'note.delete_all_note',
	'uses' => 'NotesController@delete_all_note'
]);

Route::get('/note/{id}/restore', [
	'as' => 'note.restore_note',
	'uses' => 'NotesController@restore_note'
]);
/* ============= */

Route::get('/groups', [
	'as' => 'group.groups',
	'uses' => 'NotesController@groups'
]);

Route::get('/group/new', [
	'as' => 'group.new_group',
	'uses' => 'NotesController@new_group'
]);

Route::post('/group/create', [
	'as' => 'group.create_group',
	'uses' => 'NotesController@create_group'
]);

Route::get('/group/{id}/edit', [
	'as' => 'group.edit_group',
	'uses' => 'NotesController@edit_group'
]);

Route::post('/group/{id}/update/', [
	'as' => 'group.update_group',
	'uses' => 'NotesController@update_group'
]);

Route::get('/group/{id}/delete', [
	'as' => 'group.delete_group',
	'uses' => 'NotesController@delete_group'
]);

Route::get('/group/{id}/get_note', [
	'as' => 'group.get_note_by_group',
	'uses' => 'NotesController@get_note_by_group'
]);



/* ============= */
