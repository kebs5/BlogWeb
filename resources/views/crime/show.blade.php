@extends('layouts.app')

@section('content')
<a href="/crime" class = "btn btn-secondary">Go Back</a>
    <h1>{{$post ->title}}</h1>
    <img style="width:100%"src="/storage/cover_images/{{$post->cover_image}}">
    <br>
    
    <div>
        <p>{!!$post ->body!!}</p>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <small>Written On {{$post ->created_at}}</small>
            <hr>
            <a href = "/crime/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
            {!! Form::open(array( 'route'=> array('crime.destroy',$post->id),'class' => 'float-right')) !!} 
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
            {!! Form::close() !!}
        @endif    
    @endif    
@endsection