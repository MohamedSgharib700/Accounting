@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة فئة المصروفات </h1>
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
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
    @endif
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10"  style="margin: auto;background: #fff;width: 51%;padding: 15px;">
    <form class="" action="{{route('expensesBalanceCategories.store')}}" method="post">
        @csrf

        <div class="col-span-12 m-2">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder=" ادخل الاســــم">

        </div>
        <div class="col-span-6 ">
            <button type="submit" class="button w-24 mr-1  mb-2 bg-theme-9 text-white" style="position: relative;top:9px">اضافه</button>
        </div>
   
    </form>
</div>
@stop

@section('script')