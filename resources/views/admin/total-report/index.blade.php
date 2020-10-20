@extends('admin.layouts.app')
@section('content')


<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

<h1 class="p-3 "> تقرير عام </h1>
</div>
<div class="col-span-12 lg:col-span-12 my-10">
<label>تقرير عام</label>
    <button type="submit" class="button  bg-theme-1 text-white">

        <a class="p-3 text-center btn btn-info " href="{{route('total-report-pdf')}}"> طباعه <i
                class="nav-icon  fa fa-file"></i></a>
    </button>
    <button type="submit" class="button  bg-theme-1 text-white">

        <a class="p-3 text-center btn btn-info " href="{{route('report-pdf')}}"> طباعه التقرير المجمع <i
                class="nav-icon  fa fa-file"></i></a>
    </button>
</div>
<div class="col-span-12 lg:col-span-3 my-10">
    <label>من : </label>
    <input class="datepicker input w-56 border block mx-auto" id="from-date" name="from_date">
</div>
<div class="col-span-12 lg:col-span-3 my-10">
    <label>الى : </label>
    <input class="datepicker input w-56 border block mx-auto" id="to-date" name="to_date">
</div>

<div class="col-span-12 lg:col-span-3 my-10">
    <label> تحميل تقرير تحويلات المندوبين :</label><br>
    <button type="submit" class="button  bg-theme-1 text-white" id="excel">
        <i class="fa fa-download"></i><a style="color:white;"> تحميل ملف اكسيل </a>
    </button>
    <button type="submit" class="button  bg-theme-1 text-white" id="pdf">
        <i class="fa fa-download"></i><a style="color:white;"> تحميل pdf </a>
    </button>
</div>
<div class="col-span-12 lg:col-span-3 my-10">
    <label> تحميل اكسيل :</label><br>
    <button type="submit" class="button bg-theme-9 text-white" id="delegate-excel">
        <i class="fa fa-download"></i><a style="color:white;"> تحويلات مندوبين الي ماكينات </a>
    </button>
    <button type="submit" class="button bg-theme-9 text-white" id="pos-excel">

        <i class="fa fa-download"></i><a style="color:white;"> تحويلات ماكينات الي مندوبين </a>
    </button>
</div>


<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{number_format($total_transactions, 1, '.', '')}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي العمليات</div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$pos_balances}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي المحول للماكينات</div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$bank_balances}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي المحول للبنك </div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$Treasure}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي الخزينه </div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$agent_balances}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي المحول للمندوبين </div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$agent_discount_balances}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي المخصوم من المندوبين </div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$available_agent_balances}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي المتاح تحويله للمندوبين </div>
        </div>
    </div>
</div>
<!------------------------------------------------>
<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{$order_agent_balances}}</div>
            <div class="text-base text-gray-600 mt-1">اجمالي المطلوب من المندوبين </div>
        </div>
    </div>
</div>
<!-- /.content -->
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- excel ----------------- */
    $(document).on("click", "#excel", function(e) {
        from_date = $("#from-date").val();
        to_date = $("#to-date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-agent-balances?from_date=' + from_date + '&to_date=' +
                to_date,
            success: function(data) {
                window.location.href = 'export-all-agent-balances?from_date=' +
                    from_date + '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });

    $(document).on("click", "#pdf", function(e) {
        from_date = $("#from-date").val();
        to_date = $("#to-date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/pdf",
            url: 'agent-balances-pdf?from_date=' + from_date + '&to_date=' + to_date,
            success: function(data) {
                window.location.href = 'agent-balances-pdf?from_date=' + from_date +
                    '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });
    $(document).on("click", "#delegate-excel", function(e) {
        from_date = $("#from-date").val();
        to_date = $("#to-date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-agent-customer-balances?from_date=' + from_date +
                '&to_date=' + to_date,
            success: function(data) {
                window.location.href =
                    'export-all-agent-customer-balances?from_date=' + from_date +
                    '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });
    $(document).on("click", "#pos-excel", function(e) {
        from_date = $("#from-date").val();
        to_date = $("#to-date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-customer-agent-balances?from_date=' + from_date +
                '&to_date=' + to_date,
            success: function(data) {
                window.location.href =
                    'export-all-customer-agent-balances?from_date=' + from_date +
                    '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });

})
</script>
@endsection