<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\ScrapAsset;
use common\widgets\Alert;
ScrapAsset::register ( $this );
use yii\widgets\ActiveForm;
$homeUrl = Url::base();
use frontend\modules\cart\models\Cart;
$cartindex = Yii::$app->UrlManager->createUrl(['/cart/cart']);
//$cartcount = Cart::find()->where(['session_id'=>Yii::$app->session->getId()])->count();


if(isset($_GET['id']) && $_GET['id'] !=0){
$id = $_GET['id'];
$cartdata = Cart::find()->where(['booking_id'=>$id])->asarray()->all();
}
else{
	$id =0;
	$cartdata = Cart::find()->where(['session_id'=>Yii::$app->session->getId(),'booking_id'=>$id])->asarray()->all();
	
}
$cartcount = 0;
foreach($cartdata as $key=>$value){
	$cartcount = $cartcount +$value['weightquantity'];
}

?>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<title>Divisima | eCommerce Template</title>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
 <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>

</head>
<body>
<?php $this->beginBody ()?>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<div class="logo">
						<a href="" class="site-logo">
							<img src="<?php echo Url::base().'/v1/img/logo.png'?>" alt="Papex">
						</a>
						 
						 
		<span style="font-size:30px;cursor:pointer" class="loc" onclick="openNav()"><a href="#">Location
          <span class="glyphicon glyphicon-map-marker" id="gly"></span>
        </a></span>
	</div>
		<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <input type="text" id="searcharea" placeholder="Search for area, street name..."/>
  
  <button type="button" class="button" id="getcurrentlocation"><i class="fas fa-search-location"></i>Get Current Location</button>
  
  
</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "450px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.html" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span id="cartcount"><?= $cartcount?></span>
								</div><a href="<?php echo $cartindex;?>&id=<?php echo $id;?>">Shopping Cart</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="#">Home</a></li>
					<li><a href="#">Women</a></li>
					<li><a href="#">Men</a></li>
					<li><a href="#">Jewelry
						<span class="new">New</span>
					</a></li>
					<li><a href="#">Shoes</a>
						<ul class="sub-menu">
							<li><a href="#">Sneakers</a></li>
							<li><a href="#">Sandals</a></li>
							<li><a href="#">Formal Shoes</a></li>
							<li><a href="#">Boots</a></li>
							<li><a href="#">Flip Flops</a></li>
						</ul>
					</li>
					<li><a href="#">Pages</a>
						<ul class="sub-menu">
							<li><a href="./product.html">Product Page</a></li>
							<li><a href="./category.html">Category Page</a></li>
							<li><a href="./cart.html">Cart Page</a></li>
							<li><a href="./checkout.html">Checkout Page</a></li>
							<li><a href="./contact.html">Contact Page</a></li>
						</ul>
					</li>
					<li><a href="#">Blog</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<div id="carousel" class="carousel slide" data-ride="carousel">

				<!-- Menu -->
				<ol class="carousel-indicators">
					<li data-target="#carousel" data-slide-to="0" class="active"></li>
					<li data-target="#carousel" data-slide-to="1"></li>
					<li data-target="#carousel" data-slide-to="2"></li>
				</ol>

				<!-- Items -->
				<div class="carousel-inner">

					<div class="item active">
						<img src="<?php echo './v1/img/1.jpg';?>" alt="Slide 1" />
					</div>

					<div class="item">
						<img src="<?php echo './v1/img/2.jpg';?>" alt="Slide 2" />
					</div>

					<div class="item">
						<img src="<?php echo './v1/img/3.jpg';?>" alt="Slide 3" />
					</div>

				</div>

				<a href="#carousel" class="left carousel-control" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>

				<a href="#carousel" class="right carousel-control" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>

			</div>
	<!-- Header section end -->
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
<?=Breadcrumbs::widget ( [ 'links' => isset ( $this->params ['breadcrumbs'] ) ? $this->params ['breadcrumbs'] : [ ] ] )?>
        <?= Alert::widget()?>
        <?= $content?>
</div>

	<!-- Footer section -->
	<section class="footer-section">
		<div class="container">
			<div class="footer-logo text-center">
				<a href="index.html"><img src="./img/logo-light.png" alt=""></a>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
						<img src="img/cards.png" alt="">
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<ul>
							<li><a href="">About Us</a></li>
							<li><a href="">Track Orders</a></li>
							<li><a href="">Returns</a></li>
							<li><a href="">Jobs</a></li>
							<li><a href="">Shipping</a></li>
							<li><a href="">Blog</a></li>
						</ul>
						<ul>
							<li><a href="">Partners</a></li>
							<li><a href="">Bloggers</a></li>
							<li><a href="">Support</a></li>
							<li><a href="">Terms of Use</a></li>
							<li><a href="">Press</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Questions</h2>
						<div class="fw-latest-post-widget">
							<div class="lp-item">
								<div class="lp-thumb set-bg" data-setbg="img/blog-thumbs/1.jpg"></div>
								<div class="lp-content">
									<h6>what shoes to wear</h6>
									<span>Oct 21, 2018</span>
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
							<div class="lp-item">
								<div class="lp-thumb set-bg" data-setbg="img/blog-thumbs/2.jpg"></div>
								<div class="lp-content">
									<h6>trends this year</h6>
									<span>Oct 21, 2018</span>
									<a href="#" class="readmore">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Questions</h2>
						<div class="con-info">
							<span>C.</span>
							<p>Your Company Ltd </p>
						</div>
						<div class="con-info">
							<span>B.</span>
							<p>1481 Creekside Lane  Avila Beach, CA 93424, P.O. BOX 68 </p>
						</div>
						<div class="con-info">
							<span>T.</span>
							<p>+53 345 7953 32453</p>
						</div>
						<div class="con-info">
							<span>E.</span>
							<p>office@youremail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container">
				<div class="social-links">
					<a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					<a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
					<a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
					<a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					<a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
					<a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
				</div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

			</div>
		</div>
	</section>
	<!-- Footer section end -->

<?php $this->endBody()?>


	</body>
</html>
<?php $this->endPage()?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWyNo2jPv4iWnaoM2_6kTLKx2Zr-9Byb8">
    </script>
<script type="text/javascript">
$(function () {
	
$('#getcurrentlocation').on('click' ,function(){
	
	 if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
		    x.innerHTML = "Geolocation is not supported by this browser.";
		  }	
	});
});
function showPosition(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
	var google_map_position = new google.maps.LatLng( lat, lng );
	  //console.log(google_map_position);
	  var google_maps_geocoder = new google.maps.Geocoder();
	  google_maps_geocoder.geocode(
	      { 'latLng': google_map_position },
	      function( results, status ) {
	    	  if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
                 // console.log( results[0].formatted_address );
	    		  document.getElementById("searcharea").value = results[0].formatted_address;
                  
              }
	      }
	  );
	}
</script>
