<?php if($cart = array_reverse($this->cart->contents())){ ?>
					<?php foreach($cart as $item): ?>
					<div class="box">
						<a style="float:right;" href="<?php echo base_url(); ?>cart/remove/<?php echo $item['rowid']; ?>">remove item</a>
						<h3><?php echo $item['name']; ?></h3>
						<br><img class="proPic" src="<?php echo base_url(); ?>images/item<?php echo $item['id']; ?>APin.jpg" /><br><br>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="form<?php echo $item['id']; ?>">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="<?php echo $item['email_add']; ?>">
							<input type="hidden" name="item_name" value="<?php echo $item['name']; ?>">
							<input type="hidden" name="item_number" value="<?php echo $item['id']; ?>">
							<input type="hidden" name="amount" value="<?php echo $item['price']; ?>">
							<input type="hidden" name="shipping" value="<?php echo $item['shipping']; ?>">
							<input type="hidden" name="quantity" value="1">	
							<input type="hidden" name="custom" value="<?php echo $item['custom']; ?>">		
							<input type="hidden" name="no_note" value="1">
							<input type="hidden" name="on0" value="Note to seller">
							<label>Note to seller:</label>
							<textarea name="os0"></textarea>
							<input type="hidden" name="return" value="<?php echo base_url(); ?>cart/done/<?php echo $item['rowid']; ?>">
							<input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>cart">
							<input type="hidden" name="image_url" value="http://testing.collegecanvas.org/img/logoSmaller.png">
							<input type="hidden" name="notify_url" value="<?php echo base_url(); ?>cart/ipn">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="lc" value="US">
    					</form>
						<p class="caption">Item total: <?php echo "$".money_format('%i', $item['price']); ?></p>
						<p class="caption">Shipping: <?php echo "$".money_format('%i', $item['shipping']); ?></p>
						<div class="split"></div>
						<p class="caption">Order total: <?php echo "$".money_format('%i', $item['order_total']); ?> 
						<img src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" onclick="document.forms['form<?php echo $item['id']; ?>'].submit(); return false;" align="left" style="float:right; margin-right:7px; cursor:pointer;">
						</p>
						</div>
					<?php endforeach; ?>
										
<?php } else{
	echo "<img src='".base_url()."img/emptycart.jpg' />";
} ?>