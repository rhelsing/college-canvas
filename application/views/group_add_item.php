<div id="leftBar">
<div id="leftBarInside">
Tips about selling will be displayed here. Include link to a <a href="#" style="color: #0d7cb3;">getting started</a> guide.
</div>
</div>
<div id="rightContent">
<h3>List an Item</h3>
<form method="post" action="<?php echo base_url(); ?>item/save_group" name="save_changes" accept-charset="utf-8" enctype="multipart/form-data">
<input type="hidden" name="g_id" value="<?php echo $id; ?>" />
<div class="box">
	<label>Name</label>
	<input type="text" name="name"/>
	<p class="caption">Descriptive titles are best. Try to describe your item the way a shopper would.</p>
	<div class="split"></div>
	<label>Description</label>
	<textarea name="about" style="width:400px; height:100px;"></textarea>
	<p class="caption">Try to answer the questions shoppers will have. Tell the item's story and explain why it's special.</p>
	<div class="split"></div>
	<label>Category</label>
	<select name="category">
		<?php include('lists/categoriesOptions.txt'); ?>
	</select>
	<p class="caption">What category best describes your product?</p>
	<div class="split"></div>
	<label>Photos</label>
	<input type="file" name="a" /><span class="caption">*Required</span><br>
	<input type="file" name="b" /><br>
	<input type="file" name="c" /><br>
	<input type="file" name="d" /><br>
	<input type="file" name="e" />
	<p class="caption">Want to know how to make your item look great? <a href="#">Read this</a>.</p>
</div>
<h3>Pricing</h3>
<div class="box">
	<label>Price</label>
	<input type="text" name="price"/>
	<p class="caption">How much do you want to sell your item for?</p>
	<label>Quantity</label>
	<input type="text" name="quantity"/>
	<p class="caption">How many items do you have to sell?</p>
	<label>Shipping Cost</label>
	<input type="text" name="shipping_cost"/>
	<p class="caption">How much will it cost to ship?</p>
</div>
<h3>Size</h3>
<div class="box">
	<label>Size Options</label>
	<input type="text" name="size"/>
	<p class="caption">Enter size options, seperated by commas. Example: Small, Medium, Large</p>
	<label>Dimensions</label>
	<input type="text" name="dimensions"/>
	<p class="caption">How big is it? Example: 5" x 17" x 12"</p>
</div>
<h3>Details (Optional)</h3>
<div class="box">
	<label>Color</label>
	<input type="text" name="color"/>
	<p class="caption">What color is it? Entering a color will increase the liklihood of being featured on the front page.</p>
	<label>Material</label>
	<input type="text" name="material"/>
	<p class="caption">What's it made of? Materials, seperated by commas.</p>
	<label>Tags</label>
	<input type="text" name="tags"/>
	<p class="caption">Enter tags, seperated by commas</p>
	<label>How it's made</label>
	<textarea name="how_it_is_made" style="width:400px; height:100px;"></textarea>
</div>	
<div class="center"><a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save changes</a></div>
</div>
</form>


<div id="clear"></div>