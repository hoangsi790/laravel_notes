<?php if(isset($alert_fail) and $alert_fail!='') { ?>
<div class="alert alert-danger">
 <?php echo $alert_fail; ?>
</div>
<?php } ?>
{!! Form::open([
		'action' => 'NotesController@login',
        'method' => 'post',
        'id' => 'login_form'
]) !!}
      
<input type="text" name="username" id="username" required>
<input type="text" name="password" id="password" required>
<button type="submit">Submit</button>
      
{!! Form::close() !!}