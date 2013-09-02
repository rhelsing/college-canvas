<h3>Contact Us</h3>
<div class="split"></div>
<div class="box">
	<form method="post" name="send" action="<?php echo base_url(); ?>contact/send">
	<label>Your Email Address</label>
	<input type="text" name="email" style="width:300px;" />
	<p class="caption">So we can respond to you!</p>
	<label>Subject</label>
	<input type="text" name="subject" style="width:300px;" />
	<label>Message</label>
	<textarea name="message" style="width:400px; height:200px;"></textarea><br>
	<a class="btn-other" onclick="document.forms['send'].submit(); return false;">send</a>
	</form>
</div>