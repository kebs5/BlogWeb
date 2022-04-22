@extends('layouts.app')

@section('content')
    <h1>Crimes</h1>
    @if(count($posts) > 0)
        @foreach ($posts as $post )
        <div class="card  mb-3" >
            <div class="card-body">          
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                         <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="product image ">
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="well">
                            <h3><a href = "/crime/{{$post->id}}"> {{$post->title}}</a></h3>
                            <small> Written on {{$post->created_at}} by {{$post->user['name']}}</small>
                            <p>{!!$post->body !!}</p>
                        </div>
                      </div>
                    </div>
                </div>       
            </div>    
           
        @endforeach
        {{$posts ->links()}}
    @else
        <p> No posts found</p>
    @endif
@endsection

