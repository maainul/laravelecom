@extends('welcome')
@section('content')
<h2 class="title text-center">Brand Items</h2>
	<?php foreach($show_product_brand as $v_show_product){?>
									
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<div class="single-products">
						<div class="productinfo text-center">
						    <img src="{{URL::to($v_show_product->product_image)}}" style="height: 150px; width: 100px; padding: 0px; margin: 0px;">
								<h2>{{$v_show_product->product_price}}</h2>
								<p>{{$v_show_product->product_name}}</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
						<div class="product-overlay">
							<div class="overlay-content">
								<h2>{{$v_show_product->product_price}}</h2>
								<p>{{$v_show_product->product_name}}</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
						</div>
				</div>
				<div class="choose">
					<ul class="nav nav-pills nav-justified">
						<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
						<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
					</ul>
				</div>
			</div>
		</div>

		<?php } ?>
@endsection