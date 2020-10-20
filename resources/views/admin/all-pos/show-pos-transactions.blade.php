
@extends('admin.layouts.app')
@section('content')


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 ">                     العمليات

    </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 "  name="user_service_number" placeholder="بحث برقم العمليه .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="date" name="created_at"  placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
       

        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2">
                <a href="{{route('agent.all.pos.customer')}}">رجوع</a>
            </button>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
        <tr>
                            <th class="whitespace-no-wrap">رقم العمليه</th>
                            <th class="whitespace-no-wrap">اسم الخدمه</th>
                            <th class="text-center whitespace-no-wrap">نوع الخدمه</th>
                            <th class="text-center whitespace-no-wrap">اسم الشركه</th>
                            <th class="text-center whitespace-no-wrap">التاريخ</th>
                            <th class="text-center whitespace-no-wrap">القيمه</th>
                            <th class="text-center whitespace-no-wrap">الرسوم</th>
                            <th class="text-center whitespace-no-wrap">العموله</th>
                        </tr>
         
        </thead>

        <tbody>
        @foreach($transactions as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$row->user_service_number}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                    {{$row->service? $row->service->name: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->category? $row->category->name: ''}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    {{$row->company? $row->company->name: ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->created_at}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->value}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->fees ? $row->fees: ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->commissions ? $row->commissions: ''}}</div>
                </td>
              

            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $transactions->links() }}
</div>














   


@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script>
    </script>

@endsection



