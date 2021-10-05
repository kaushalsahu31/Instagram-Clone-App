@extends('layouts.app')

@section('content')
<div class="container">
   @foreach($posts as $post)
   <div class="row">
   <div class="col-6 offset-3">
   <a href="/profile/{{$post->user->id }}"> <img src="/storage/{{$post->image}}" class="w-100"></a>
   </div>
   </div>
   <div class="row pt-2 pb-4">
   <div class="col-6 offset-3">
        <div class='d-flex align-items-center'>
        <div class='pr-3'>
            <img style='max-width: 40px;' src="/storage/{{$post->user->profile->image}}" class='rounded-circle w-100'> 
        </div>
        <div class='font-weight-bold'>
        <a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a>
         .
        <a class='pl-1' href="#">Follow</a>  
        </div>
        </div>
        <hr>
        <p><span class='font-weight-bold'>
        <a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></span> {{$post->caption}} </p>
   </div>
   </div>
@endforeach
            <div class="d-flex justify-content-center"> 
                {!!$posts->links()!!}
            </div>

</div>
@endsection
