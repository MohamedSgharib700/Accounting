@extends('admin.layouts.app')
@section('content')


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> عملاء الشركة
    </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white " href="{{route('customers.create')}}">اضافة &#10010</a>

</div>

<div class="col-sm-12 text-right text-theme-6">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible callout callout-info">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="البحث بالاسم">

        </div>


        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>

    </form>
</div>






<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">اسم العميل</th>
                <th class="whitespace-no-wrap">البريد الالكتروني</th>
                <th class="text-center whitespace-no-wrap"> الهاتف</th>
                <th class="text-center whitespace-no-wrap"> العنوان</th>
                <th class="text-center whitespace-no-wrap">كود العميل</th>
                <th class="text-center whitespace-no-wrap">صورة البطاقة</th>
                <th class="text-center whitespace-no-wrap">الادوات</th>

            </tr>
        </thead>


        <tbody>
            @foreach( $customers as $customer )
            <tr class=" intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$customer->name}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$customer->email}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$customer->phone}}</div>
                </td>

                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$customer->address?$customer->address: ''}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$customer->user_code?$customer->user_code: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> <img style="width: 60px; height: 60px;" src="{{asset($customer->image)}}"></div>
                </td>
                @if(!$customer->user_code)
                <td class="w-40">
                    <div class=" button w-24 mr-1 mb-2 bg-theme-9 text-white">
                        <a class="btn btn-primary btn-amwal-2 " href="{{route('customers.edit' ,$customer->id )}}">
                            تعديل</a>
                    </div>
                </td>
                @else
                <td>
                </td>
                @endif

            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $customers->links() }}
</div>









@stop