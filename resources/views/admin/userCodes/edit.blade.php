@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة كود للمندوب</h1>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}
    </p>
    @endif
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 content-holder " style="margin:auto;width:60%;text-align:center" >
    <form class=""  method="POST" action="{{route('userCodes.update' , $user->id)}}">
        @csrf
        @method('put')
        <div class="col-span-12">
            <label for="exampleInputEmail1">اضافة كود المندوب</label>
            <input type="text" class="input w-full border mt-2" name="user_code" placeholder="ادخل الكود"
                value="{{$user->user_code}}">
        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">اضافه</button>
        </div>
    </form>
</div>















@stop