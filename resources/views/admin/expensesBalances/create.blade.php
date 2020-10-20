@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة المصروفات</h1>
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
    <form class="content-holder" action="{{route('expensesBalances.store')}}" method="post" style="width:50%;margin:auto">
        @csrf
        <div class="col-span-12 my-6">
            <label>اضافة الفئة</label>
            <div class="mt-2">
                <select class=" input w-full border mt-2 select2 w-full" name="category_id">
                <option selected="selected">الفئات</option>
                    @foreach($categories as $category)
                    <option value='{{$category->id}}'>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-span-12 my-6">
            <label>اضافة المصروفات لشركة اموال</label>

            <input type="text" class="input w-full border mt-2 " name="value" placeholder=" ادخل القيمة">

        </div>
        <div class="col-span-6 my-6">
            <label>التعليق</label>
            <input class="input w-full border mt-2 " type="text" name="note" placeholder=" ادخل التعليق">
        </div>
        <input type="hidden" class="form-control" value="{{auth()->user()->id}}" name="user_id">

        <div class="col-span-6 my-6">
            <button type="submit" class="button inline-block bg-theme-1 text-white m-2">اضافة الرصيد</button>
        </div>
    </form>
</div>
@stop

@section('script')