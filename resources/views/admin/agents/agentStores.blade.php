@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> عهد اقساط المكينة للمناديب</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex" method="get" action="{{route('PosStores')}}">
        <div class="col-span-12 m-2">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder=" البحث باسم المندوب">

        </div>
        <div class="col-span-6 m-2">
            <input class="input w-full border mt-2 " type="text" name="user_code" placeholder="البحث بكود المندوب">

        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2" style="position:relative;top:8px">بحث</button>
        </div>

    </form>
</div>


<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">كود المندوب</th>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="text-center whitespace-no-wrap">اقساط المكينات</th>
            </tr>
        </thead>


        <tbody>
            @foreach( $users as $user )
            <tr class=" intro-x">
                <td >
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$user->user_code}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->name}}
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        <a class="button w-24 mr-1 mb-2 bg-theme-1 text-white"
                            href="{{route('financialCustodays.index' , $user->id)}}">الاقساط({{$user->financialCustoday->count()}})
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