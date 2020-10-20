@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة انواع العقود
    </h1>
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


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="content-holder"  action="{{route('contracts.store')}}" method="post" style="width:50%; margin:auto">
        @csrf
        <div class="col-span-12 my-6">
            <label for="exampleInputEmail1">نوع التقسيط</label>

            <input type="text" class="input w-full border mt-2 " name="name"
             placeholder=" ادخل نوع التقسيط">

        </div>
        <div class="col-span-6 my-6">
            <label for="exampleInputEmail1">القيمة</label>

            <input class="input w-full border mt-2 " type="text" name="value" 
            placeholder=" ادخل  القيمة ">
        </div>
        <div class="my-6">
            <label>اضافة عدد شهور القسط</label>
            <div class="mt-2">
                <select class="select2 w-full"  name="times">
                    <option selected="selected">عدد الشهور</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='5'>5</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                    <option value='8'>8</option>
                    <option value='9'>9</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                </select>
            </div>
        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2" type="submit">اضافه</button>
        </div>
     
    </form>
</div>
@stop

@section('script')