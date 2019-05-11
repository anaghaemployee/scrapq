<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use frontend\modules\scraps\models\Scraps;
$total =0.00;
$appurl =Yii::$app->UrlManager->createUrl(['/scraps/scrapbookings/create']);
?>

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
		<?php if($cart !=[]){?>
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
						
					</div>
				</div>
				<div class="col-lg-4 card-right">
					
					<button type="button" class="site-btn" data-toggle="collapse" data-target="#demo">Book Appointment</button>
					 <div id="demo" class="collapse">
  
   <?php $form = ActiveForm::begin(['action'=>$appurl]); ?>
 <div class="form-group">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickup_address')->hiddenInput(['maxlength' => true,'id'=>'pickupaddress'])->label(false) ?>
    

    <?= $form->field($model, 'pick_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Pick up Date' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>  

    <?= $form->field($model, 'pickup_time')->dropDownList(['08:00-10:00'=>'08:00-10:00','10:00 - 12:00'=>'10:00 - 12:00','12:00-14:00'=>'12:00-14:00','14:00-16:00'=>'14:00-16:00','16:00-18:00'=>'16:00-18:00'
    		
    ],['prompt'=>'Select Pickup Time']) ?>
<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    
   <?php ActiveForm::end(); ?>
	
  
  
</div>

    
        
        <button  class="site-btn sb-dark" id="needcash" name ="ScrapBookings[needcash]" value="needcash">NeedCash</button>
		<button  class="site-btn sb-dark" id="exchangemanagement" name ="ScrapBookings[needcash]" value="exchangemanagement">Exchange Management</button>
			 		
				</div>
			</div>
			<?php }else{?>
			<p>Your Cart Is Empty</p>
			<?php }?>
		</div>
	</section>
	<!-- cart section end -->

	<?php  $url =Yii::$app->UrlManager->createUrl(['/site/weightupdation']);
	$carturl =Yii::$app->UrlManager->createUrl(['/cart/cart/cartupdate']);
	$confirmationurl =Yii::$app->UrlManager->createUrl(['/scraps/scrapbookings/confimation']);
	$removecarturl = Yii::$app->UrlManager->createUrl(['/cart/cart/cartremove']);?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(".site-btn").on('click',function(){
		var address= document.getElementById("searcharea").value;
		document.getElementById("pickupaddress").value = address;
	});

	$(function () {
		$("#needcash").on('click',function(){
			$.ajax({
			       url: '<?php echo $confirmationurl;?>',
			       type: "get",
			       data: {id:'needcash',bookingid:'<?php echo $_GET['id'];?>'} ,
			       success: function (response) {	
				       console.log(response)
				       var obj = JSON.parse(response);
				       if(obj['status'] == 'success'){
				    	   alert("We Will Get Back Soon");
							window.location ='<?php echo Yii::$app->UrlManager->createUrl(['/site/index']);?>';
				       }
				       else{
							alert("Alert You Select NeedCash Option");
				       }		         	       
			    	 // location.reload();	
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
		});
			 
	});
	$(function () {
		$("#exchangemanagement").on('click',function(){
			$.ajax({
			       url: '<?php echo $confirmationurl;?>',
			       type: "get",
			       data: {id:'exchangemanagement',bookingid:'<?php echo $_GET['id'];?>'} ,
			       success: function (response) {	
				       console.log(response)
				       var obj = JSON.parse(response);
				       if(obj['status'] == 'success'){
				    	   
							window.location ='<?php echo Yii::$app->UrlManager->createUrl(['/exchange/exchange/index']);?>&id='+'<?php echo $_GET['id'];?>';
				       }
				       else{
							alert("Alert You Select exchangemanagement Option");
				       }		         	       
			    	 // location.reload();	
			       },
			       error: function(jqXHR, textStatus, errorThrown) {
			          console.log(textStatus, errorThrown);
			       }


			   });
		});
			 
	});
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
			var scrapid =$(this).attr('scrapid');
			var qty = $('#scrap-'+incidofqty).val();
			var price = $('#price-'+incidofqty).attr('price');
			$.ajax({
			       url: '<?php echo $carturl;?>',
			       type: "get",
			       data: {qty: qty , price: price ,scrapid :scrapid,inc :'inc'} ,
			       success: function (response) {
			    	   	  console.log(response);
			    	   	 var obj = JSON.parse(response);
			    	   	 var qtyupdate = 'scrap-'+incidofqty;
			    	   	 var priceupdate = 'price-'+incidofqty;
			    	   	document.getElementById(qtyupdate).value = obj['qty'];
			    	  	document.getElementById(priceupdate).innerHTML = obj['price'];
			    	  	document.getElementById("totalcost").innerHTML = obj['totalvalue'];
			    	  	document.getElementById("cartcount").innerHTML = obj['cartcount'];
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
			       data: {qty: qty , price: price ,inc :'dec',scrapid :scrapid} ,
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