<div id="leftBar">
<div id="leftBarInside">
<ul>
	<li><a href="<?php echo base_url(); ?>about">About Home</a></li>
	<li><a href="<?php echo base_url(); ?>about/terms">Terms</a></li>
	<li><a href="<?php echo base_url(); ?>about/privacy">Privacy</a></li>
	<li><a href="<?php echo base_url(); ?>about/copyright">Copyright</a></li>
	<li><a href="<?php echo base_url(); ?>about/beta">Beta</a></li>
    </ul>
</div>
<div id="leftBarInside">
<ul>
	<li>Sign up for our newsletter:</li>
	<form name="signup" action="<?php echo base_url(); ?>about/add"  method="post">
		<input type="text" style="width:155px;" name="email" />
		<a class="btn" onclick="document.forms['signup'].submit(); return false;">Sign Up</a>
	</form>
    </ul>
</div>
</div>
<div id="rightContent">
<h3>Information about the Beta Version</h3>
<div class="split"></div>
College Canvas is currently in Beta testing. We are recruiting student sellers at the University of Georgia and will soon be expanding to other campuses. We are constantly updating the site, fixing bugs, and making improvements. If you have any suggestions or encounter problems, please contact us here.<br></br>
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
</div>
<div id="clear"></div>