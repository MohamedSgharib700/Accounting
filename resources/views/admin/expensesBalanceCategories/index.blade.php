@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> فئة مصروفات شركة اموال </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white " href="{{route('expensesBalanceCategories.create')}}">اضافة
        &#10010</a>


</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form style="display:flex" method="get" action="{{route('expensesBalanceCategories.index')}}">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="البحث بالاسم">

        </div>


        <div class="col-span-6">
            <button class="button w-24 mr-1 mb-2 my-2 bg-theme-9 text-white">بحث</button>
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
                <th class="whitespace-no-wrap">الاســـــم</th>
                <th class="whitespace-no-wrap">التاريــــخ</th>

            </tr>
        </thead>
        <tbody>
            @foreach( $expensesBalances as $expensesBalance )
            <tr class="intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$expensesBalance->name}}</div>
                    </div>
                </td>


                <td class="">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$expensesBalance->created_at}}
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       
    </table>
    {{ $expensesBalances->links() }}
</div>









@stop