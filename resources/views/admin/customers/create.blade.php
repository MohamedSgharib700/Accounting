@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة عميل جديد</h1>
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

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 content-holder" style="margin:auto;width:50%">
    <form class="" action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-span-12 m-2 my-2">
            <label for="exampleInputEmail1"> اسم العميل</label>
            <input type="text" class="input w-full border mt-2 " name="name" placeholder=" ادخل اسم العميل">

        </div>
        <div class="col-span-6 my-2">
            <label for="exampleInputEmail1"> البريد الالكتروني </label>
            <input class="input w-full border mt-2 " type="text" name="email" placeholder=" ادخل بريد العميل">
        </div>
        <div class="col-span-6 m-2">
            <label for="exampleInputEmail1"> كلمه المرور </label>
            <input class="input w-full border mt-2 " type="password" name="password" placeholder=" ادخل كلمة المرور">
        </div>
        <div class="col-span-6 m-2">
            <label for="exampleInputEmail1"> رقم الهاتف </label>
            <input class="input w-full border mt-2 " type="text" name="phone" placeholder=" رقم الهاتف ">
        </div>
        <div class="m-2">
            <label> صورة البطاقة </label>
            <div class="fallback">
                <input name="image" type="file" />
            </div>
        </div>

        <div class="m-2">
            <label>اضافة المنطقة</label>
            <div class="mt-2">
                <select class="select2 w-full" name="area_id">
                    <option selected="selected">المناطق</option>
                    @foreach($areas as $areas)
                    <option value='{{$areas->id}}'>{{$areas->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-span-6 m-2">
            <label for="exampleInputEmail1"> العنوان </label>
            <input class="input w-full border mt-2 " type="text" name="address" placeholder="ادخل العنوان">
        </div>

        
        <input type="hidden" class="form-control" value="6" name="type">
        <input type="hidden" class="form-control" value="{{auth()->user()->id}}" name="created_by">

        <div class="col-span-6 m-2">
            <button type="submit" class="button inline-block bg-theme-1 text-white m-2">اضافه</button>
        </div>

    </form>
</div>











@stop

@section('script')