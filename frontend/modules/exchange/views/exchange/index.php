<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
use yii\helpers\Url;
$homeurl = Url::base();
$murl  = 'http://papex.in/image/cache/catalog/gettyimages-81726300-1024x1024-180x180.jpg'

//print_r($prinfo); exit;
?>

	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Exchange PAGE  -<span id="excahngeamount"><?= 'Rs  '.$price;?></span></h4>
			
			<div class="site-pagination">
				<a href="<?= Url::base();?>">Home</a> /
				<a href="">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<section class="related-product-section">
		<div class="container">
			
			<div class="row">
						<?php if($prinfo !=''){
							//echo 'hello' ; exit;
					foreach($prinfo as $key=>$value){
						//echo 'hello' exit;
						?>
				
				<div class="product-item">
					<div class="pi-pic">
						<img src="<?php echo $murl; ?>" alt="image">
						
					</div>
					
					<div class="pi-text">
						<h6 id="price-<?= $key;?>" price="<?= $value['price']?>">Rs.<?php echo number_format($value['price'],2); ?></h6>
						<p> <?php echo $value['name']; ?></p>
					</div>
					<div class="quantity">
						<p>Select Weight</p>
                        <div class="pro-qty"><span class="dec qtybtn" decid="<?= $key;?>" productid = "<?= $value['product_id'];?>">-</span><input type="text" value="0" id="product-<?= $key;?>"><span class="inc qtybtn" incid="<?= $key;?>" productid = "<?= $value['product_id'];?>">+</span></div>
                    </div>
				</div>
						<?php } } ?>
				
			</div>
		</div>
	</section>
	<?php  $url =Yii::$app->UrlManager->createUrl(['/site/weightupdation']);
	$carturl =Yii::$app->UrlManager->createUrl(['/exchange/exchange/cartadd']);?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<script type="text/javascript">
$(function () {
		$(".inc").on('click',function(){
			var incidofqty = $(this).attr('incid');
			var productid =$(this).attr('productid');
			var qty = $('#product-'+incidofqty).val();
			var price = $('#price-'+incidofqty).attr('price');
			//alert(price);
						$.ajax({
			       url: '<?php echo $carturl;?>',
			       type: "get",
			       data: {qty: qty , price: price ,productid :productid,inc :'inc',bookingid :'<?php echo $_GET['id'];?>'} ,
			       success: function (response) {
			    	   	  console.log(response);
			    	   	 var obj = JSON.parse(response);
			    	   	 if(obj['status'] == 'Success'){
			    	   	 var qtyupdate = 'product-'+incidofqty;
			    	   	 var priceupdate = 'price-'+incidofqty;
			    	   	document.getElementById(qtyupdate).value = obj['qty'];
			    	  	document.getElementById(priceupdate).innerHTML = obj['price'];
			    	  	document.getElementById("excahngeamount").innerHTML = obj['totalvalue'];
			    	  	document.getElementById("cartcount").innerHTML = obj['cartcount'];
			    	   	 } else{
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
		var productid =$(this).attr('productid');
		var qty = $('#product-'+decidofqty).val();
		var price = $('#price-'+decidofqty).attr('price');
		//alert(price);
					$.ajax({
		       url: '<?php echo $carturl;?>',
		       type: "get",
		       data: {qty: qty , price: price ,productid :productid,inc :'dec',bookingid :'<?php echo $_GET['id'];?>'} ,
		       success: function (response) {
		    	   	  console.log(response);
		    	   	 var obj = JSON.parse(response);
		    	   	 
		    	   	 var qtyupdate = 'product-'+decidofqty;
		    	   	 var priceupdate = 'price-'+decidofqty;
		    	   	document.getElementById(qtyupdate).value = obj['qty'];
		    	  	document.getElementById(priceupdate).innerHTML = obj['price'];
		    	  	document.getElementById("excahngeamount").innerHTML = obj['totalvalue'];
		    	  	document.getElementById("cartcount").innerHTML = obj['cartcount'];
			    	   //location.reload();
		       },
		       error: function(jqXHR, textStatus, errorThrown) {
		          console.log(textStatus, errorThrown);
		       }


		   });
		   
	});
});
</script>


