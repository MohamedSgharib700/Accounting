@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> انواع عقود المكينات لشركة اموال
    </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">


    <a class="button mr-1 mb-2 inline-block bg-theme-1 text-white" href="{{route('contracts.create')}}">اضافة
        &#10010</a>



</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex" method="get" action="{{route('contracts.index')}}">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="البحث بالاسم">

        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
    </form>
</div>


@if(Session::has('message'))
<br>
<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}
</p>
@endif


<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">نوع القسط</th>
                <th class="whitespace-no-wrap">القيـــمة</th>
                <th class="text-center whitespace-no-wrap"> عدد المرات</th>

                <th class="text-center whitespace-no-wrap">التاريخ</th>

            </tr>
        </thead>


        <tbody>
            @foreach( $contracts as $contract )
            <tr class="intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$contract->name}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$contract->value}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$contract->times}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$contract->created_at}}</div>
                </td>

            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $contracts->links() }}
</div>

@stop