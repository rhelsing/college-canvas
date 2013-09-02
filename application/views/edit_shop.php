<div id="leftBar">
<div id="leftBarInside">
Tips about selling will be displayed here. Include link to a <a href="#" style="color: #0d7cb3;">getting started</a> guide.
</div>
</div>
<div id="rightContent">
<h3>Edit Your Public Profile</h3>
<div class="box">
<form method="post" action="<?php echo base_url(); ?>shop/save" name="save_changes" accept-charset="utf-8" enctype="multipart/form-data">
<label>Profile Picture</label>
<?php
if($picture!=""){
	echo '<img src="'.base_url().'images/'.$picture.'?id='.rand().'" class="proPic"/><br /><br />';
}else{
}
 ?>
<input type="file" name="x" />
<div class="split"></div>
<label>Your Name</label>
<input type="text" name="name" value="<?php echo $name; ?>" />
<p class="caption">Leave field empty if you prefer to display your username on your profile.</p>
<div class="split"></div>
<label>About</label>
<textarea name="about" style="width:350px; height:100px;"><?php echo $about; ?></textarea>
<p class="caption">Tell people a little about yourself.</p>
<div class="split"></div>
<label>City</label>
<input type="text" name="hometown" value="<?php echo $hometown; ?>" />
<p class="caption">Where are you?</p>
</div>
<h3>Shop</h3>
<div class="box">
<label>Shop Name</label>
<input type="text" name="shop_name" value="<?php echo $shop_name; ?>" />
<p class="caption">What would you like to call your shop?</p>
<div class="split"></div>
<label>Shop Banner</label>
<?php
if($shop_banner!=""){
	echo '<img src="'.base_url().'images/bannerSmall'.$id.'.jpg" style="margin-top:10px;"/><br />';
	echo '<input type="checkbox" name="remove"><span class="checkTitle">Remove Current Banner</span><br />';
}
?>
<input type="file" name="z" />
<p class="caption">Ideal size is 720 x 100</p>
</div>
<h3>School</h3>
<div class="box">
<label>School</label>
<input type="text" name="school" value="<?php echo $school; ?>" />
<div class="split"></div>
<label>Major</label>
<input type="text" name="major" value="<?php echo $major; ?>" />
<div class="split"></div>
<label>Year</label>
<input type="text" name="year" value="<?php echo $year; ?>" />
<p class="caption">How many years have you been in school?</p>
</div>
<h3>Social Networks</h3>
<div class="box">
<label>Facebook</label>
<input type="text" name="facebook" value="<?php echo $facebook; ?>" />
<p class="caption">Link to your page!</p>
<div class="split"></div>
<label>Twitter</label>
<input type="text" name="twitter" value="<?php echo $twitter; ?>" />
<div class="split"></div>
<label>Pinterest</label>
<input type="text" name="pinterest" value="<?php echo $pinterest; ?>" />
<div class="split"></div>
<label>Blog</label>
<input type="text" name="blog" value="<?php echo $blog; ?>" />
</div>
</form>
<div class="center"><a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save changes</a></div>
</div>
<div id="clear"></div>