@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> بيانات ارصدة اقساط المكينات </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="width: 39%;margin: auto;height: fit-content;text-align: center;">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $installment_total_values }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الاقساط</div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex" method="get">
        <div class="col-span-12 m-2">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="بحث باسم المندوب .">

        </div>
        <div class="col-span-6 m-2">
            <input class="input w-full border mt-2 " name="contract_name" placeholder="بحث بنوع القسط  .">
        </div>
        <div class="col-span-6 m-2">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
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
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">اسم التاجر</th>
                <th class="text-center whitespace-no-wrap"> رقم المكنة</th>
                <th class="text-center whitespace-no-wrap"> نوع القسط </th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">الحالة</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>

            </tr>
        </thead>

        <tbody>
            @foreach( $installments as $installment )
            <tr class=" intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$installment->agent ? $installment->agent->name : ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                        {{$installment->customer ? $installment->customer->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$installment->pos ? $installment->pos->serial : '' }} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$installment->Contract ? $installment->Contract->name : ''}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$installment->value}} </div>
                </td>
                @if($installment->status == 0)
                <td class="text-center">
                    <div class="flex items-center justify-center ">غير مدفوع </div>
                </td>
                @else
                <td class="text-center">
                    <div class="flex items-center justify-center ">تم الدفع </div>
                </td>
                @endif

                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$installment->created_at}}</div>
                </td>

            </tr>
            @endforeach

        </tbody>
      

    </table>
    {{ $installments->links() }}
</div>





@stop