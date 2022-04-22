<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use App\Models\User;
use Illuminate\Http\Request;
use Storage;
use DB;

class CrimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Crime::orderBy('created_at','desc')->paginate(3);
        return view('crime.index') ->with('posts', $posts);
        //return view('crime.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crime.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'default.jpg';
        }
        $post = new Crime;
        $post ->title = $request->input('title');
        $post ->body = $request ->input('body');
        $post ->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post ->save();
        return redirect('/crime') ->with('success','Post created succssfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function show($crime)
    {
        $post = Crime::find($crime);
        return view('crime.show') ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function edit($crime)
    {
        $post = Crime:: find($crime);
        //check for correct users
        if(auth()->user()->id !==$post->user_id){
            return redirect('/crime')->with('error', 'Unauthorised Page');

        }
        return view('crime.edit')->with('post', $post);
       // return view('posts.create');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            ]);
          //Handle file upload
          if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            //Storage::disk('s3')->put($fileNameToStore, fopen($request->file('cover_image'), 'r+'), 'public');
        }
        //create post
        $post = Crime::find($id);
        $post ->title = $request->input('title');
        $post ->body = $request ->input('body');
        if($request->hasFile('cover_image')){
            $post ->cover_image = $fileNameToStore;
        }
        $post ->save();
        return redirect('/crime') ->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crime  $crime
     * @return \Illuminate\Http\Response
     */
    public function destroy($crime)
    {
        $post = Crime:: find($crime);

        if(auth()->user()->id !=$post->user_id){
            return redirect('/crime')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'default.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
           // Storage::disk('s3')->delete($post->cover_image);
        }
        $post->delete();
        return redirect('/crime')->with('success', 'Post Deleted');
        //
    }
}
