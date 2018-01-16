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
		<div class="col-md-8">
			<h3>Posted by , {{ $user->name }}</h3>
		</div>

		<div class="col-md-4">
			<h3>Profile , {{ $user->name }}</h3>
		</div>
	</div>
	<div class="row">

		<div class="col-md-8">
		@foreach( $user->posts as $post )
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
						                	<a href="#"> {{ $post->user->name }}</a>
						                </p>
					                </div>
					                @auth
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
					                @endauth
				                </div>
				            </div>
		            
				            
		        		</div>
		        	</div>
				</div>

				
			</div>
		@endforeach
	
	
		</div>


		<div class="col-md-4">
			@auth
				<div class="col-md-12 list-group">

					<a href="#" class="list-group-item active">Operaciones</a>
					<a href="{{ url('posts') }}" class="list-group-item">Todos los posts</a>
					<a href="{{ url('posts/create') }}" class="list-group-item">Crear un post</a>

					@if( Auth::user()->id == $user->id )
						<a href="#" class="list-group-item">Modificar Perfil</a>				
					@endif
				</div>
			@endauth

			@guest
				
				<ul class="list-group col-md-12">
				  
				  <li class="list-group-item active">
				    Datos
				  </li>
				  <li class="list-group-item ">
				    Name:
				    <span class="pull-right">{{ $user->name }}</span>
				  </li>
				  <li class="list-group-item ">
				    Email:
				    <span class="pull-right">{{ $user->email }}</span>
				  </li>
				  <li class="list-group-item ">
				    Role: 
				    <span class="pull-right">Admin</span>
				  </li>
				</ul>

				
			@endguest
				
			

			
		</div>
	</div>
</div>
@endsection
