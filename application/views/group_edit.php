<div id="leftBar">
<div id="leftBarInside">
How to create a group tips <a href="#" style="color: #0d7cb3;">getting started</a> guide.
</div>
</div>
<div id="rightContent">
<a class="btn-other" style="float:right;" href="<?php echo base_url(); ?>group/delete/<?php echo $id; ?>">delete group</a><h3>Edit Group</h3>
<div class="box">
<form method="post" action="<?php echo base_url(); ?>group/editSave/<?php echo $id; ?>" name="save_changes" accept-charset="utf-8" enctype="multipart/form-data">
<label>Group Name</label>
<input type="text" name="name" value="<?php echo $name; ?>" />
<div class="split"></div>
<label>Group Picture</label>
<?php if(file_exists('images/groupMain'.$id.'.jpg')){ ?>
	<img src="<?php echo base_url(); ?>images/groupMain<?php echo $id; ?>.jpg?id=<?php echo rand(); ?>" class="proPic"/><br><br>
<? } ?>
<input type="file" name="x" />
<div class="split"></div>
<label>About</label>
<textarea name="about" style="width:350px; height:100px;"><?php echo $about; ?></textarea>
<p class="caption">Tell people a little about yourself.</p>
<div class="split"></div>
<label>Group Banner</label>
<?php if(file_exists('images/groupBannerSmall'.$id.'.jpg')){ ?>
	<img src="<?php echo base_url(); ?>images/groupBannerSmall<?php echo $id; ?>.jpg?id=<?php echo rand(); ?>" style="margin-top:10px;" /><br>
	<input type="checkbox" name="remove"><span class="checkTitle">Remove Current Banner</span><br />
<? } ?>
<input type="file" name="z" />
<p class="caption">Ideal size is 720 x 100</p>
</div>
</form>
<div class="center"><a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save changes</a></div>
</div>
<div id="clear"></div>