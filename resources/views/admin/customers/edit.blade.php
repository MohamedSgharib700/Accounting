@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة كود للعميل </h1>
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



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="margin:auto;width:60%;text-align:center">
    <form class="content-holder"  action="{{route('customers.update' , $customer)}}" method="post">
        @csrf
        @method('put')
        <div class="col-span-12">
            <label for="exampleInputEmail1">اضف كود</label>

            <input type="text" class="input w-full border mt-2 " name="user_id" required
                placeholder=" ادخل كود العميل ">

        </div>


        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>

    </form>
</div>








@stop

@section('script')