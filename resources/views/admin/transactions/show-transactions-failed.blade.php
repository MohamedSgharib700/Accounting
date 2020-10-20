@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> العمليات</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد العمليات </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{number_format($sum, 1, '.', '')}} </div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه العمليات </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count_momkn}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد عمليات ممكن </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{number_format($sum_momkn, 1, '.', '')}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه عمليات ممكن </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count_aman}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد عمليات امان</div>
            <div class="text-3xl font-bold leading-8 mt-6">{{number_format($sum_aman, 1, '.', '')}} </div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه عمليات امان </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap;">
        <div class="col-span-12 m-2">
        <label>بحث باسم المندوب</label>
            <input type="text" class="input w-full border mt-2 " name="name" id="agent_name"
                placeholder="بحث باسم المندوب .">

        </div>
        <div class="col-span-12 m-2">
        <label>بحث برقم الماكينه</label>
            <input type="text" class="input w-full border mt-2 " name="serial" placeholder="بحث برقم الماكينه .">

        </div>

        <div class="col-span-12 m-2">
        <label>بحث برقم العمليه : </label>

            <input type="text" class="input w-full border mt-2 " name="operation_id" placeholder="بحث برقم العمليه .">

        </div>
        <div class="col-span-12 m-2">
        <label>بحث باسم الشركه : </label>

            <input type="text" class="input w-full border mt-2 " name="company" placeholder="بحث باسم الشركه .">

        </div>
        <div class="col-span-12">
            <label>من : </label>
            <input type="date" class="input w-full border mt-2 " name="from_date" id="from_date" class="form-control"
                placeholder="بحث بالتاريخ .">

        </div>
        <div class="col-span-12">
            <label>الي : </label>

            <input type="date" class="input w-full border mt-2 " name="to_date" id="to_date"
                placeholder="بحث بالتاريخ .">

        </div>
        <div >
            <label> تحميل :</label>
            <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-9 text-white m-2" id="excel"
                style="margin-right: 5px;">
               <a style="color:white;"> تحميل ملف اكسيل </a>
            </button>
            
        </div>
        <div class="col-span-6 m-2" >
            <button class="button inline-block bg-theme-1 text-white m-2" style="    position: relative;
    top: 50px;">بحث</button>
        </div>
        <div class="box-footer m-2">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2" style="position: relative;top: 50px"><a
                    href="{{route('agents.index')}}" >رجوع</a></button>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap"> رقم الهاتف المحول له</th>
                <th class="text-center whitespace-no-wrap"> رقم العملية</th>
                <th class="text-center whitespace-no-wrap">اسم الخدمه</th>
                <th class="text-center whitespace-no-wrap">نوع الخدمه</th>
                <th class="text-center whitespace-no-wrap"> اسم الشركه</th>
                <th class="text-center whitespace-no-wrap"> التاريخ</th>
                <th class="text-center whitespace-no-wrap">القيمه </th>
                <th class="text-center whitespace-no-wrap">الرسوم</th>
                <th class="text-center whitespace-no-wrap">العموله</th>
            </tr>
        </thead>


        <tbody>
            @foreach($transactions as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="" style="width: 13%;">
                    <div class="flex">
                        <div class=" h-10 ">{{$row->pos->user? $row->pos->user->name: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->pos->serial}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->user_service_number}}</div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->operation_id}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->service? $row->service->name: ''}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->category? $row->category->name: ''}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->company? $row->company->name: ''}}
                    </div>
                </td>
                <td class="" style="width: 13%;">
                    <div class="flex items-center justify-center text-theme-3">
                        {{$row->created_at}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    {{number_format($row->value, 3, '.', '')}} </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->fees ? $row->fees: ''}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        {{$row->commissions ? $row->commissions: ''}}
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
       

    </table>
    {{ $transactions->links() }}
</div>







<!-- <div class="content-wrapper">
    <div>
        <section class="content-header text-center">


            <button class="p-3 text-center btn btn-success">

                <br>
            </button>
        </section>

        <section class="row">
            <div class="table-holder table-responsive">
                <table class="table text-center pos-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">رقم الماكينه</th>
                            <th scope="col">رقم الهاتف المحول له</th>
                            <th scope="col">رقم العملية</th>
                            <th scope="col">اسم الخدمه</th>
                            <th scope="col">نوع الخدمه</th>
                            <th scope="col">اسم الشركه</th>
                            <th scope="col">التاريخ</th>
                            <th scope="col">القيمه</th>
                            <th scope="col">الرسوم</th>
                            <th scope="col">العموله</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $row)
                        <tr class="pos-{{$row->id}}">
                            <td>{{$row->pos->user->name}}</td>
                            <td>{{$row->pos->serial}}</td>
                            <td>{{$row->user_service_number}}</td>
                            <td>{{$row->operation_id}}</td>
                            <td>{{$row->service? $row->service->name: ''}}</td>
                            <td>{{$row->category? $row->category->name: ''}}</td>
                            <td>{{$row->company? $row->company->name: ''}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->value}}</td>
                            <td>{{$row->fees ? $row->fees: ''}}</td>
                            <td>{{$row->commissions ? $row->commissions: ''}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>

        </section>
    </div>
</div> -->
@stop
@section('script')

<script>
$(document).ready(function() {
    /* ------------------- new-pos ----------------- */
    $(document).on("click", "#excel", function(e) {
        to_date = $("#to_date").val();
        from_date = $("#from_date").val();
        agent_name = $("#agent_name").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-transactions-failed?from_date=' + from_date + '&to_date=' + to_date +
                '&agent_name=' + agent_name,
            success: function(data) {
                window.location.href = 'export-all-transactions-failed?from_date=' + from_date +
                    '&to_date=' + to_date + '&agent_name=' + agent_name;
            }
        });
        e.preventDefault();
    });
})
</script>
@endsection