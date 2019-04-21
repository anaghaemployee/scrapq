<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Url;
$homeurl = Url::base();
$cartindex = Yii::$app->UrlManager->createUrl(['/cart/cart']);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Sell Scrap</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->
	<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			
			<div class="product-slider owl-carousel">
			<?php if($scraps !=''){
					foreach($scraps as $key=>$value){?>
				<div class="product-item">
					<div class="pi-pic">
						<img src="<?php echo './frontend/web/'. $value['scrap_image'] ?>" alt="">
						
					</div>
					
					<div class="pi-text">
						<h6 id="price-<?= $key;?>" price="<?= $value['scrap_price']?>">Rs. <?= number_format($value['scrap_price'],2)?></h6>
						<p><?= $value['scarp_name']?> </p>
					</div>
					<div class="quantity">
						<p>Select Weight</p>
                        <div class="pro-qty"><span class="dec qtybtn" decid="<?= $key;?>">-</span><input type="text" id="scrap-<?= $key;?>"  value="0"><span class="inc qtybtn" incid="<?= $key;?>" >+</span></div>
                    </div>
                    <div>
					<button class="add-to-cart" cartid="<?= $key;?>" scrapid = "<?= $value['scrap_id'];?>"> Add to Cart </button>
				</div>
				</div>
				
				<?php }}?>
			</div>
		</div>
		<div style="text-align:right;padding-right:100px;">
		<a href="<?php echo $cartindex;?>"><button id="viewcart"> View Cart </button></a>
		</div>
	</section>
	<!-- RELATED PRODUCTS section end -->
	<?php  $url =Yii::$app->UrlManager->createUrl(['/site/weightupdation']);
	$carturl =Yii::$app->UrlManager->createUrl(['/cart/cart/add']);?>
<style>
 .owl-carousel .owl-nav.disabled {
     display: block; 
}
</style>
	<script type="text/javascript">
<!--

//-->
jQuery(document).ready(function() {
	  jQuery(".owl-carousel").owlCarousel({
		  navigation: true, // Show next and prev buttons
		    slideSpeed: 300,
		    paginationSpeed: 400,
		    singleItem: true,
		    transitionStyle: "fadeUp",
		    autoPlay: true,
		    navigationText: [
		    "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"     
		    ]
	  });
	  var cartdata = '<?php  echo $cartdata;?>';
	  if(cartdata == 0){
		  document.getElementById("viewcart").disabled = true;
	  }
	});

$(function () {
	$(".add-to-cart").on('click',function(){
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
		    	   var obj = JSON.parse(response);
		    	   if(obj['status'] == 'Success'){
			    	   alert("Cart addeded Successfully");
		    		   document.getElementById("viewcart").disabled = false;
		    	   }
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
		else{
    	   	document.getElementById(qtyupdate).value = 0;
		}
	});
});
</script>
