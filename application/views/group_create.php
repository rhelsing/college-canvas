<div id="leftBar">
<div id="leftBarInside">
How to create a group tips <a href="#" style="color: #0d7cb3;">getting started</a> guide.
</div>
</div>
<div id="rightContent">
<h3>New Group</h3>
<div class="box">
<form method="post" action="<?php echo base_url(); ?>group/createSave" name="save_changes" accept-charset="utf-8" enctype="multipart/form-data">
<label>Group Name</label>
<input type="text" name="name" />
<div class="split"></div>
<label>Group Picture</label>
<input type="file" name="x" />
<div class="split"></div>
<label>About</label>
<textarea name="about" style="width:350px; height:100px;"></textarea>
<p class="caption">Tell people a little about yourself.</p>
<div class="split"></div>
<label>Group Banner</label>
<input type="file" name="z" />
<p class="caption">Ideal size is 720 x 100</p>
</div>
</form>
<div class="center"><a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">create group</a></div>
</div>
<div id="clear"></div>