<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use frontend\modules\scraps\models\Scraps;
$total =0.00;
$murl  = 'http://papex.in/image/cache/catalog/gettyimages-81726300-1024x1024-180x180.jpg';

$appurl =Yii::$app->UrlManager->createUrl(['/scraps/scrapbookings/create']);
?>

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
		<?php if($cart !=[]){?>
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Exchange Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="size-th">S.no</th>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									
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
										<img src="<?php echo $murl; ?>" alt="">
										<div class="pc-title">
											<h4><?=$value['scrap_name']?></h4>
											<p>Rs. <?=$value['price']?></p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
					                        <div class="pro-qty"><span class="dec qtybtn" decid="<?= $key;?>" scrapid = "<?= $value['scrap_id'];?>">-</span>
												<input type="text" id="scrap-<?= $key;?>"  value="<?=$value['weightquantity']?>">
											<span class="inc qtybtn" incid="<?= $key;?>" scrapid = "<?= $value['scrap_id'];?>" >+</span></div>
                    					</div>
									</td>
									
									
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
							<h6>Total <span id="totalcost">Rs. <?=number_format($total,2);?></span></h6>
						</div>
						<div class="total-cost">
							<h6>Exchange Amount <span id="exchange">Rs. <?=number_format($exchangeprice,2);?></span></h6>
						</div>
						<div class="total-cost">
							<h6>Remaining Amount <span id="payble">Rs. <?=number_format(-($total-$exchangeprice),2);?></span></h6>
						</div>
						<div class="total-cost">
							<a href="<?php echo Yii::$app->UrlManager->createUrl(['/order/order/create','bookingid'=>$_GET['id']])?>">Confirm order</a>
						</div>
					</div>
				</div>
				
			</div>
			<?php }else{?>
			<p>Your Cart Is Empty</p>
			<?php }?>
		</div>
	</section>
	<!-- cart section end -->

	<?php  $url =Yii::$app->UrlManager->createUrl(['/site/weightupdation']);
	$carturl =Yii::$app->UrlManager->createUrl(['/exchange/exchange/cartupdate']);
	$confirmationurl =Yii::$app->UrlManager->createUrl(['/scraps/scrapbookings/confimation']);
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
		$(".inc").on('click',function(){
			var incidofqty = $(this).attr('incid');
			var scrapid =$(this).attr('scrapid');
			var qty = $('#scrap-'+incidofqty).val();
			var price = $('#price-'+incidofqty).attr('price');
			$.ajax({
			       url: '<?php echo $carturl;?>',
			       type: "get",
			       data: {qty: qty , price: price ,scrapid :scrapid,inc :'inc',bookingid:'<?php echo $_GET['id'];?>'} ,
			       success: function (response) {
			    	   	  console.log(response);
			    	   	 var obj = JSON.parse(response);
			    	   	 if(obj['status'] == 'Success'){
			    	   	 var qtyupdate = 'scrap-'+incidofqty;
			    	   	 var priceupdate = 'price-'+incidofqty;
			    	   	document.getElementById(qtyupdate).value = obj['qty'];
			    	  	document.getElementById(priceupdate).innerHTML = obj['price'];
			    	  	document.getElementById("totalcost").innerHTML = obj['totalvalue'];
			    	  	document.getElementById("cartcount").innerHTML = obj['cartcount'];
			    	  	document.getElementById("payble").innerHTML = obj['exchange'];
			    	   	 }
			    	   	 else{
							alert('exchange limit amount is exceeded');
			    	   	 }
				    	   //location.reload();
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
			var scrapid =$(this).attr('scrapid');
			var qtyupdate = 'scrap-'+decidofqty;
		    var priceupdate = 'price-'+decidofqty;
			if(qty > 1){
			$.ajax({
			       url: '<?php echo $carturl;?>',
			       type: "get",
			       data: {qty: qty , price: price ,inc :'dec',scrapid :scrapid,bookingid:'<?php echo $_GET['id'];?>'} ,
			       success: function (response) {
			    	   	  //console.log(response);
			    	   	  var obj = JSON.parse(response);
							if(obj['qty'] == 0){
				    	   	location.reload();
							}else{
			    	   	document.getElementById(qtyupdate).value = obj['qty'];
			    	  	document.getElementById(priceupdate).innerHTML = obj['price'];
			    	  	document.getElementById("totalcost").innerHTML = obj['totalvalue'];
			    	  	document.getElementById("cartcount").innerHTML = obj['cartcount'];
			    	  	document.getElementById("payble").innerHTML = obj['exchange'];
						}
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
			}
		});
	});
	
	</script>