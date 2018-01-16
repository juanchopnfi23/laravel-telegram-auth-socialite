@extends('layouts.app')

@section('content')



@if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
@endif


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Creando un post...</h3>
		</div>
	</div>
	<div class="row">

		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div id="postlist">
						<div class="panel">
		                	<div class="panel-heading">
		                    	
		                	</div>
		                
				            <div class="panel-body">
				                <div class="row">
				                	<div class="col-md-12">
				                		<form method="POST" action="{{ url('posts') }}">
				                		  {{ csrf_field() }}
										  <div class="form-group">
										    <label for="title">Title:</label>
										      <input type="title" class="form-control input-lg" name="title" placeholder="Enter title">
										  </div>
										  <div class="form-group">
										    <label for="subtitle">Subtitle:</label>
										      <input type="subtitle" class="form-control input-lg" name="subtitle" placeholder="Enter subtitle">
										  </div>
										  <div class="form-group">
											<label for="content">Content:</label>
											<textarea class="form-control input-lg" rows="5" name="content" placeholder="Enter content..."></textarea>
										  </div>
										  <div class="form-group"> 
										    <button type="submit" class="btn btn-default btn-lg">Submit</button>
										    
										  </div>
										</form>
				                	</div>			
				                </div>
				            </div>
		            
				            <div class="panel-footer">
				               
				            </div>
		        		</div>
		        	</div>
				</div>

				
			</div>	
			
		</div>


		<div class="col-md-4">
			<div class="col-md-12 list-group">
				<a href="#" class="list-group-item active">Operaciones</a>
				<a href="{{ url('posts') }}" class="list-group-item">Todos los posts</a>
			</div>
		</div>
	</div>
</div>
@endsection
