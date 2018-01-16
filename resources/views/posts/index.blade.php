@extends('layouts.app')

@section('content')

@if(Session::has('flash_message'))
	<div class="alert alert-success alert-dismissible" role="alert">
      
      <button type="button" class="close" data-dismiss="alert" arial-label="Close">
      	<span aria-hidden="true">x</span>
      </button>
      
      {{Session::get('flash_message')}}	
    
    </div>
@endif

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>All posts ({{ count( $posts ) }})</h3>
		</div>
	</div>
	<div class="row">

		<div class="col-md-8">
		@foreach( $posts as $post )
			<div class="row">
				<div class="col-md-12">
					<div id="postlist">
						<div class="panel">
		                	<div class="panel-heading">
		                    	<div class="text-center">
		                        	<div class="row">
		                            	<div class="col-sm-9">
		                                	<h3 class="pull-left">
		                                		<a href="{{ url('posts', ['id' => $post->id]) }}" style="text-decoration: none;">{{ $post->title }}</a>
		                                	</h3>
		                            	</div>
			                            <div class="col-sm-3">
			                                <h4 class="pull-right">
			                                	<small>
			                                		<em>
			                                			{{ $post->created_at }}
			                                		</em>

			                                	</small>
			                                </h4>
			                            </div>
		                        	</div>
		                    	</div>
		                	</div>
		                
				            <div class="panel-body">
				                <div class="row">
				                	<div class="col-md-12">
					                	<p>
						                	{{ $post->subtitle }} 
						                	
						                </p>
						                <p class="pull-right">
						                	By, 
						                	<a href="{{ url('users', ['id' => $post->user->id]) }}"> {{ $post->user->name }}</a>
						                </p>
					                </div>
					                <div class="col-md-12">
						                @if( Auth::user()->id == $post->user->id )
						                	<a href="{{ url('posts', ['id' => $post->id]) }}/edit" class="btn btn-default">
							                		Edit
							                </a>

							                <a class="btn btn-danger" href="#"
												          onclick="event.preventDefault();
												               document.getElementById('post-destroy-form-{{$post->id}}').submit();">
											        Delete
											</a>
										    <form id="post-destroy-form-{{$post->id}}" action="{{ url('posts', ['id' => $post->id]) }}" method="POST" style="display: none;">
										          {{ method_field('DELETE') }}
										          {{ csrf_field() }}
										          
											</form>
						                @endif

						                <a href="{{ url('posts', ['id' => $post->id]) }}"  class="btn btn-info">
						                		Show more
						                </a>
						            </div>
				                </div>
				            </div>
		            
				            
		        		</div>
		        	</div>
				</div>

				
			</div>
		@endforeach
	
	
		</div>


		
		<div class="col-md-4">
			<div class="col-md-12 list-group">
				<a href="#" class="list-group-item active">Operaciones</a>
				<a href="{{ url('posts/create') }}" class="list-group-item">Crear post</a>
			</div>
		</div>
		
		


	</div>
</div>
@endsection
