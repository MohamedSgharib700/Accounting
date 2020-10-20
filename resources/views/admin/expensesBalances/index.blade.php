@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 ">بيانات مصروفات شركة اموال</h1>
</div>

<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد مصروفات </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{ $sum }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه مصروفات </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white " href="{{route('expensesBalances.create')}}">اضافة
        &#10010</a>
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap" method="get" action="{{route('expensesBalances.index')}}">
        <div class="col-span-12">
            <label>البحث : </label>
            <input type="text" class="input w-full border mt-2 " name="category" placeholder="بحث بالفئة .">

        </div>
        <div class="col-span-6">
            <label>من : </label>
            <input class="input w-full border mt-2 " type="date" name="from_date" placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <label>الي : </label>
            <input class="input w-full border mt-2 " type="date" name="to_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2"
                style="position: relative;top:59px">بحث</button>
        </div>

    </form>
</div>
@if(Session::has('message'))
<br>
<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
@endif
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">الرصيــد المصروف</th>
                <th class="whitespace-no-wrap">فئة صرف النقدية </th>
                <th class="text-center whitespace-no-wrap"> التاريــــخ</th>

            </tr>
        </thead>
  

        <tbody>
        @foreach( $expensesBalances as $expensesBalance )
            <tr class="intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$expensesBalance->value? $expensesBalance->value: ''}}</div>
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    {{$expensesBalance->created_at? $expensesBalance->created_at: ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$expensesBalance->note? $expensesBalance->note: ''}}</div>
                </td>
            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $expensesBalances->links() }}
</div>




@stop