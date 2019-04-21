<?php
use frontend\modules\scraps\models\Scraps;
$total =0.00;?>

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Scrap Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="size-th">S.no</th>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="quy-th">Edit</th>
									<th class="total-th">Price</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cart as $key=>$value){
								$img =Scraps::findByScrap($value['scrap_id']); 
									
									?>
								<tr>
								<td class="size-col"><h4><?=$key+1?></h4></td>
									<td class="product-col">
										<img src="<?php echo './'. $img->scrap_image ?>" alt="">
										<div class="pc-title">
											<h4><?=$value['scrap_name']?></h4>
											<p>Rs. <?=$value['price']?></p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
					                        <div class="pro-qty"><span class="dec qtybtn" decid="<?= $key;?>">-</span>
												<input type="text" id="scrap-<?= $key;?>" value="<?=$value['weightquantity']?>">
											<span class="inc qtybtn" incid="<?= $key;?>" >+</span></div>
                    					</div>
									</td>
									<td class="cart-product-edit"><a href="#" class="product-edit update" scrapid = "<?= $value['scrap_id'];?>" cartid="<?php echo $key;?>">Edit</a></td>
									
									<td class="total-col"><h4 id="price-<?= $key;?>" price="<?= $value['price']?>">Rs. <?=$value['price_weight']?></h4></td>
									<td class="romove-item"><a href="#" title="cancel" class="icon remove" cartid="<?php echo $value['cart_id'];?>"><i class="fa fa-trash-o"></i></a></td>
								</tr>
						
								<?php 
								$total =$total + $value['price_weight'];
}?>
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>Rs. <?=number_format($total,2);?></span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					
					<a href="" class="site-btn">Book Appointment</a>
					<a href="" class="site-btn sb-dark">Exchange Management</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<?php  $url =Yii::$app->UrlManager->createUrl(['/site/weightupdation']);
	$carturl =Yii::$app->UrlManager->createUrl(['/cart/cart/cartupdate']);
	$removecarturl = Yii::$app->UrlManager->createUrl(['/cart/cart/cartremove']);?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(function () {
		$(".remove").on('click',function(){
			var cartId = $(this).attr('cartid');	
			
			 $.ajax({
			       url: '<?php echo $removecarturl;?>',
			       type: "get",
			       data: {cartId: cartId} ,
			       success: function (response) {			         	       
			    	  location.reload();	
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
		});
			 
	});
	$(function () {
		$(".update").on('click',function(){
			var cartid =$(this).attr('cartid');
			var scrapid =$(this).attr('scrapid');
			var qty = $('#scrap-'+cartid).val();
			var price = $('#price-'+cartid).attr('price');
			if(qty >= 1){
			$.ajax({
			       url: '<?php echo $carturl;?>',
			       type: "get",
			       data: {qty: qty , price: price ,scrapid :scrapid} ,
			       success: function (response) {
			    	   window.location= '<?php echo Yii::$app->UrlManager->createUrl(['/cart/cart'])?>';	
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
			}
			else{
				alert("Please Select Weight");
			}
		});
	});
	$(function () {
		$(".inc").on('click',function(){
			var incidofqty = $(this).attr('incid');
			
			var qty = $('#scrap-'+incidofqty).val();
			var price = $('#price-'+incidofqty).attr('price');
			$.ajax({
			       url: '<?php echo $url;?>',
			       type: "get",
			       data: {qty: qty , price: price ,inc :'inc'} ,
			       success: function (response) {
			    	   	  //console.log(response);
			    	   	  var obj = JSON.parse(response);
			    	   	  var qtyupdate = 'scrap-'+incidofqty;
			    	   	  var priceupdate = 'price-'+incidofqty;
			    	   	document.getElementById(qtyupdate).value = obj['qty'];
			    	   	document.getElementById(priceupdate).innerHTML = obj['price'];
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
		});
	});
	$(function () {
		$(".dec").on('click',function(){
			var decidofqty = $(this).attr('decid');
			var qty = $('#scrap-'+decidofqty).val();
			var price = $('#price-'+decidofqty).attr('price');
			var qtyupdate = 'scrap-'+decidofqty;
		    var priceupdate = 'price-'+decidofqty;
			if(qty > 1){
			$.ajax({
			       url: '<?php echo $url;?>',
			       type: "get",
			       data: {qty: qty , price: price ,inc :'dec'} ,
			       success: function (response) {
			    	   	  //console.log(response);
			    	   	  var obj = JSON.parse(response);
				    	document.getElementById(qtyupdate).value = obj['qty'];
			    	   	document.getElementById(priceupdate).innerHTML = obj['price'];
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
			}
		});
	});
	
	</script>