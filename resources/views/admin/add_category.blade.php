@extends('admin_layout');
@section(@admin_content)

	<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="">Add category</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add category</h2>
						</div>
						<p class="alert-success">
							<?php
							$message=Session::get('message'); 
							if($message){
								echo $message;
								Session::put('message',null);
							}
							
							?>
						</p>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/save-category')}}" method="post">
							{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for ="data01" >Category Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="category_name" required="true">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Category description</label>
							  <div class="controls">
								<textarea class="cleditor" name="category_description" rows="3" ></textarea>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label">Publication status</label>
							  <div class="controls">
								<input type="checkbox" name="publication_status" value="1">
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