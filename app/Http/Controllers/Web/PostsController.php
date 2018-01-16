<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;
use Telegram;
use App\Post;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'content' => 'required',
        ]);

        $newPost = new Post();

        $newPost->user_id = Auth::user()->id;
        $newPost->subtitle = $request->subtitle;
        $newPost->content = $request->content;
        $newPost->title   = $request->title;
        
        if (!$newPost->save()) {
            
            return back();
        }

        Session::flash('flash_message', 'Done, post added!');
        // enviar mensaje a telegram
        $mensaje_telegram = 'Hola , Puede que te interese. El usuario ' . Auth::user()->name . ' ha creado un nuevo post .. Titulo del post : ' . $newPost->title . ' Saludos desde el blog.';
        $response = Telegram::sendMessage([
          'chat_id' => '-190334946', 
          'text' => $mensaje_telegram
        ]);

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with(compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'content' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        if ($post->save()) {
            Session::flash('flash_message', 'Done, post updated!');
            return redirect('posts');
        } else {

            return back();
        }

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post->delete()) {

            return back();
        }

       Session::flash('flash_message', 'Done, post deleted!');
       return redirect('posts');
    }
}
