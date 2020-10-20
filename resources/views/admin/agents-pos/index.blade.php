@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> المخازن الفرعيه</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex" method="get">
        <div class="col-span-12 m-2">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="بحث بالاسم .">

        </div>
        <div class="col-span-6 m-2">
            <input class="input w-full border mt-2 " type="text" name="code" placeholder="بحث بالكود .">
        </div>
        <div class="col-span-6 m-2">
            <input class="input w-full border mt-2 " name="email" placeholder="بحث بالبريد الالكتروني .">
        </div>
        <div class="col-span-6 m-2">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">#</th>
                <th class="whitespace-no-wrap">الاسم </th>
                <th class="text-center whitespace-no-wrap"> الكود</th>
                <th class="text-center whitespace-no-wrap"> البريد الالكتروني</th>
                <th class="text-center whitespace-no-wrap">رقم الموبايل</th>
                <th class="text-center whitespace-no-wrap">الماكينات</th>
                <th class="text-center whitespace-no-wrap">الماكينات المتاحه</th>
                <th class="text-center whitespace-no-wrap">الماكينات الغير متاحه</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $row)
            <tr class="supervisor-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->id}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->name}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->user_code ? $row->user_code: ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->email}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->phone}} </div>
                </td>

                <td >
                    <div class="flex items-center justify-center text-theme-1">
                        <a class="button w-30 mr-1 mb-2 bg-theme-1 text-white" href="{{route('agent.pos.available',[$row->id])}}">
                            الماكينات المتاحه
                            ({{ ($row->pos()->where('customer_id','=',null)->orWhere('customer_id','=',0)->count()) }})
                            <i class="nav-icon fa fa-calculator"></i>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="flex items-center justify-center text-theme-9">
                        <a class="button  mr-1 mb-2 bg-theme-9 text-white" href="{{route('agent.pos.available',[$row->id])}}">
                            الماكينات المتاحه
                            ({{ ($row->pos()->where('customer_id','=',null)->orWhere('customer_id','=',0)->count()) }})
                            <i class="nav-icon fa fa-calculator"></i>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="flex items-center justify-center mb-2 text-theme-6">
                        <a class="button  mr-1 mb-2 bg-theme-6 text-white" href="{{route('agent.pos.customer',[$row->id])}}">
                            الماكينات الغير متاحه ({{ ($row->pos()->where('customer_id','>',0)->count()) }})
                            <i class="nav-icon fa fa-calculator"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $users->links() }}
</div>











@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(document).ready(function() {})
</script>
@endsection