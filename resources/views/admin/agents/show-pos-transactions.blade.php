@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> العمليات </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:right">

    <h2>اسم المندوب : {{$pos->user->name}} </h2>
</div>




<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="user_service_number"
                placeholder="بحث برقم العمليه .">

        </div>
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " type="date" name="created_at" placeholder="بحث بالتاريخ .">

        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"><a
                    href="{{route('agents.index')}}">رجوع</a></button>
        </div>
    </form>
</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">رقم العمليه</th>
                <th class="whitespace-no-wrap">اسم الخدمه</th>
                <th class="text-center whitespace-no-wrap"> نوع الخدمه</th>
                <th class="text-center whitespace-no-wrap"> اسم الشركه</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">الرسوم</th>
                <th class="text-center whitespace-no-wrap">العموله</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->operation_id}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->service? $row->service->name: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->category? $row->category->name: ''}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->company? $row->company->name: ''}} </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->created_at}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->value}} </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-1">
                        {{$row->value}} </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->commissions ? $row->commissions: ''}} </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $transactions->links() }}

</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">
    @isset($row)
    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <button type="button" class="button w-30 mr-1 mb-2 bg-theme-1 text-white"><i class="fa fa-download"></i><a
                    style="color:white;"
                    href="{{route('exportexcel.posTransactions' , $row->pos_id ? $row->pos_id: '')}}">
                    Download
                    excel file </a>
            </button>
            <button type="button" class="button w-30 mr-1 mb-2 bg-theme-6 text-white" style="margin-right: 5px;">
                <i class="fa fa-download"></i><a style="color:white;"
                    href="{{route('exportpdf.posTransactions' , $row->pos_id ? $row->pos_id: '')}}">
                    Download
                    pdf file </a>
            </button>

        </div>
    </div>
    @endisset
</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
</script>

@endsection