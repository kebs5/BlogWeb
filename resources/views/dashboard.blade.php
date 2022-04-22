<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        {{-- {{ __('You are logged in!') }} --}}
    
                        <ul class = "nav navbar-nav navbar-right">
                            <li><a class="btn btn-primary" href="/crime/create">Add Crime</a></li>
                          </ul> 
                          <h1> Your Crimes </h1>
                          @if(count($posts) > 0)
                          <table class ="table table-striped">
                              <tr>
                                  <th>Title</th>
                                  <th>Date Created</th>
                                  <th></th> 
                              </tr>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <th>{{$post->title}}</th>
                                            <th>{{$post->created_at}}</th>
                                            <th><a href="/crime/{{$post->id}}/edit" class="btn btn-default">Edit</th>
                                            <th>      {!! Form::open(array( 'route'=> array('crime.destroy',$post->id),'class' => 'float-right')) !!} 
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
                                            {!! Form::close() !!}</th>
                                        </tr>     
                                    @endforeach 
                                @else
                                        <small>you have no post</small>
                                @endif     
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
