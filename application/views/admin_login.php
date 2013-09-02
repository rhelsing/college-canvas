<h1>Sign In</h1>
<form action="<?php echo base_url(); ?>admin/adminLogin" name="signin" method="post" id="signin">
<br />
<label>Username</label>
<input type="text" name="user" />
<br />
<label>Password</label>
<input type="password" name="pass" />
<br />
<input type="checkbox"><span class="checkTitle">Remember Me</span><br />
<br />
<a class="btn-other" onclick="document.forms['signin'].submit(); return false;">Sign In</a>
</form>