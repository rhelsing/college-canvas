<div id="one1" style="float:left;">
<h1>Sign In</h1>
<form action="<?php echo base_url(); ?>signin" name="signin" method="post" id="signin">
<br />
<label>Email or Username</label>
<input type="text" name="user" />
<br />
<label>Password</label>
<input type="password" name="pass" />
<br />
<input type="checkbox"><span class="checkTitle">Remember Me</span><br />
<br />
<a class="btn-other" onclick="document.forms['signin'].submit(); return false;">Sign In</a>
</form>
<div>
<a href="#">Forgot password?</a>
<br />
<a href="#">Forgot email or username?</a>
</div>
</div>

<div id="two2" style="float:right;">
<h1>Want to sell?</h1>
<form action="<?php echo base_url(); ?>request" method="post" name="request">
<br>
<label>Your .edu email address</label>
<input type="text" name="email" />
<br />
<a class="btn-other" href="#" onclick="document.forms['request'].submit(); return false;">Request invite to sell</a>
</form>
</div>
<div id="clear"></div>
<script>
	$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#signin").submit();
    }
    });
</script>