<div id="leftBar">
<div id="leftBarInside">
Note: Your email address must be registered with Paypal to recieve payment.
</div>
</div>
<div id="rightContent">
<h3>Sign Up</h3>
<div class="box">
<?php if($errors == "invalid_input"){ ?> 
	<span class="error">Something went wrong! Please check your input.</span><br /><br />
	<?php } ?>
<form action="<?php echo base_url(); ?>signup" method="post" name="signup">
	<input type="hidden" name="hash" value="<?php echo $hash; ?>" />
	<label>Username</label> 
	<input type="text" name="username" /> <?php if($errors == "error_username_taken"){ ?> 
	<span class="error">Username Taken</span>
	<?php } ?>
	<label>Password</label>
	<input type="password" name="pw1" />
	<label>Password, again</label>
	<input type="password" name="pw2" />
	<label>School</label>
	<select name="school">
		<?php include('lists/schoolsOptions.txt'); ?>
	</select>
	<label>Major</label><input type="text" name="major" />
	<input type="hidden" value="<?php echo $id; ?>" name="id" /><br><br>
	<a class="btn-other" onclick="document.forms['signup'].submit(); return false;">Sign Up</a>
</form>
</div>
</div>
<div id="clear"></div>