@extends('layouts.app')

@section('content')
    <h1>Add New Crime</h1>
    {{-- {!! Form::open(['action' => 'posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} --}}
    {!! Form::open(array( 'route'=>'crime.store','enctype' => 'multipart/form-data')) !!} 

        <div class = "form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}  
        </div>     
        <div class = "form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body '])}}  
        </div>
        <div class ="form-group">
            {{{Form::file('cover_image')}}}
        </div>         
        {{{ Form::submit('Submit', ['class'=> 'btn btn-primary'])}}}
    {!! Form::close() !!}

@endsection