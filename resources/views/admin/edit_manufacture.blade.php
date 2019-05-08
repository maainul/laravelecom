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
					<a href="">Update manufacture</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>update manufacture</h2>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="{{url('/update-manufacture',$manufacture_info->manufature_id)}}" method="post">
							{{csrf_field()}}
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for ="data01" >Category Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" value="{{$manufacture_info->manufature_name}}" name="manufature_name">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Manufacture description</label>
							  <div class="controls">
								<textarea class="cleditor" name="manufature_description" rows="3">{{$manufacture_info->manufature_description}}</textarea>
							  </div>
							</div>        
						
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update</button>
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
@endsection