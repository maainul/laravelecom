@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Add Product</a></li>
			</ul>

			<p class="alert-success">
				<?php
					$message = Session::get('message');
					if($message){
						echo $message;
						Session::put('message',null);
					}
				?>
			</p>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Product</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
											<form class="form-horizontal" action="{{url('/save-product')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for ="data01" >Product  Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_name" required="true">
							  </div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError3">Product category</label><div class="controls">
									<select id="selectError3" name="category_id">

										<option>Select category</option>

									<?php
										$all_pub_cat = DB::table('tbl_category')
											->where('publication_status',1)
											->get();
										foreach($all_pub_cat as $v_cat){?>
										
											<option value="{{$v_cat->category_id}}">{{$v_cat->category_name}}</option>

										<?php } ?>
										
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="selectError3">Product manufacture</label><div class="controls">
									<select id="selectError3" name="manufature_id">

										<option>Select manufacture</option>

									<?php
										$all_pub_mono = DB::table('tbl_manufacture')
											->where('publication_status',1)
											->get();
										foreach($all_pub_mono as $v_mono){?>
											<option value="{{$v_mono->manufature_id}}">{{$v_mono->manufature_name}}</option>
										<?php } ?>

										
									</select>
								</div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="textarea2">Product Short description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_short_description" rows="3" ></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Product Long description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" rows="3" ></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for ="data01" >Product  Price</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_price" required="true">
							  </div>
							</div>

							  <div class="control-group">
							  <label class="control-label" for ="data01" >Product  Image</label>
							  <div class="controls">
								 <input class="input-file uniform-label" for="fileInput"type="file" name="product_image">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for ="data01" >Product  Size</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_size" required="true">
							  </div>
							</div>


							<div class="control-group">
							  <label class="control-label" for ="data01" >Product  Color</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="product_color" required="true">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label">Publication status</label>
							  <div class="controls">
								<input type="checkbox" name="product_status" value="1">
							  </div>
							</div>          
						
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save</button>
							
							</div>
						  </fieldset>
						</form> 
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

@endsection