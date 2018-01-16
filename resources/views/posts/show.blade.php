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
				                		<h4> {{ $post->subtitle }}</h4>
					                	<p>
						                	{{ $post->content }} 
						                	
						                </p>
						                <p class="pull-right">
						                	By, 
						                	<a href="{{ url('users', ['id' => $post->user->id]) }}"> {{ $post->user->name }}</a>
						                </p>
					                </div>
					                
				                </div>
				            </div>
		            
				            
		        		</div>
		        	</div>
				</div>

				
				<div class="col-md-12">
					<h3>Comentarios ({{ count( $post->comments ) }})</h3>
				</div>
				
				@foreach($post->comments as $comment)

				<div class="col-md-12">
					<div id="postlist">
						<div class="panel">
		                	
		                
				            <div class="panel-body">

				            	
							    <div class="row">
									<div class="col-md-12">
							          	<span>
							          		<a href="{{ url('users', ['id' => $comment->user->id]) }}"> 
							          			{{ $comment->user->name }}
							          		</a>
							          	</span>
							          	<br>
							          	<span>{{ $comment->content }}</span>
							          	<br>
							          	<span>{{ $comment->created_at }}</span> 
							           
							            @if( Auth::user()->id == $comment->user->id )

							            	<a href="#"
							                  onclick="event.preventDefault();
							                       document.getElementById('comment-destroy-form-{{ $comment->id }}').submit();">Destroy
							            	</a>

									          <form id="comment-destroy-form-{{ $comment->id }}" action="{{ url('comments', ['id' => $comment->id]) }}" method="POST" style="display: none;">
									          {{ csrf_field() }}
									            {{ method_field('DELETE') }}
											          
									          </form>
									    @endif  
							        </div>					                
								</div>
							    
							        
				            </div>
		        		</div>
		        	</div>
				</div>
				@endforeach


				<div class="col-md-12">
					<h3>Agregar un comentario</h3>
				</div>

				<div class="col-md-12">
					<form action="{{ url('comments') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="post_id" value="{{ $post->id }}">
						<div class="form-group">
							<textarea name="content" class="form-control" id="content" placeholder="Comment Content"></textarea>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>
				</div>
				
			</div>

		</div>


		<div class="col-md-4 list-group">
			<a href="#" class="list-group-item active">Operaciones</a>
			<a href="{{ url('posts') }}" class="list-group-item">Todos los posts</a>
			<a href="{{ url('posts/create') }}" class="list-group-item">Crear un post</a>

			@if( Auth::user()->id == $post->user->id )
						
				<a href="{{ url('posts', ['id' => $post->id]) }}/edit" class="list-group-item">Editar este post</a>
						
				<a class="list-group-item" href="#" onclick="event.preventDefault();
												               document.getElementById('post-destroy-form-{{$post->id}}').submit();">
							Eliminar este post
				</a>
						
				<form id="post-destroy-form-{{$post->id}}" action="{{ url('posts', ['id' => $post->id]) }}" method="POST" style="display: none;">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}				          
				</form>

			@endif
				@if( Auth::user()->id != $post->user->id )
						<a href="{{ url('users', ['id' => $post->user->id]) }}" class="list-group-item">Acerca del autor</a>
				@endif
		</div>
				
	</div>
</div>
@endsection
