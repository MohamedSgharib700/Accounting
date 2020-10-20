@extends('admin.layouts.app')
@section('content')


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 ">الماكينات المرتجعه
</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="margin:auto;width:50%;text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> العدد
            </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap: wrap;">
        <div class="col-span-12">
            <label> بحث برقم المكينه :</label>
            <input type="text" class="input w-full border mt-2 " name="serial" placeholder="بحث برقم الماكينه .">

        </div>
        <div class="col-span-6">
            <label> بحث بالكود :</label>
            <input class="input w-full border mt-2 " name="code" type="text" placeholder="بحث بالكود .">
        </div>
        <div class="col-span-6 ">
            <button class="button inline-block bg-theme-1 text-white m-2"
                style="position:relative;top:59px">بحث</button>
        </div>

        <div class="col-span-6 " style="padding-right: 82px;">
            <label> من :</label>
            <input class="input w-full border mt-2 " type="date" name="from_date" id="from_date"
                placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <label> الي :</label>
            <input class="input w-full border mt-2 " type="date" name="to_date" id="to_date"
                placeholder="بحث بالتاريخ .">
        </div>
      
        <div class="col-span-6">

        <label> تحميل :</label>
        <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-9 text-white" id="excel" 
        style="margin-right: 5px;height: fit-content;position:relative;top:10px">
        <a style="color:white;" > تحميل ملف اكسيل </a>
        </button>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center -mt-2 large-table">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">كود المندوب </th>
                <th class="text-center whitespace-no-wrap"> اسم العميل</th>
                <th class="text-center whitespace-no-wrap"> رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap">رمز التفعيل</th>
                <th class="text-center whitespace-no-wrap">رقم سيريال الشريحه</th>
                <th class="text-center whitespace-no-wrap">رقم شريحه الماكينه</th>
                <th class="text-center whitespace-no-wrap">تاريخ التفعيل</th>
                <th class="text-center whitespace-no-wrap">نوع البيع</th>
                <th class="text-center whitespace-no-wrap">اجمالي العمليات</th>
                <th class="text-center whitespace-no-wrap"> رصيد المكينة الحالي</th>
                <th class="text-center whitespace-no-wrap"> العمليات</th>


            </tr>
        </thead>
        <tbody>
            @foreach($pos as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->user ? $row->user->name: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->user ? $row->user->user_code: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->customer ? $row->customer->name: ''}}</div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->serial}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->machine_code}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->sim_card_serial ? $row->sim_card_serial: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->sim_card ? $row->sim_card: ''}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->customer ? $row->customer->created_at: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$row->installments->first->value ? $row->installments->first->value->contract->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{ ($row->transactions()->sum('value')) }}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        <a class="button w-24 mr-1 mb-2 bg-theme-9 text-white">
                            @php
                            $TransferCredit = $row->TransferMoneyFromDelegateToPos->sum('money');
                            $transaction = $row->transactions->sum('value');
                            $commissions = $row->commissions->sum('commission');
                            $refundMoney=$row->refundMoney()->whereDate('created_at','>=','2020-09-14')->sum('value');
                            @endphp
                            {{$TransferCredit - $transaction -$refundMoney +$commissions}}

                        </a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        <a class="button w-30 mr-1 mb-2 bg-theme-1 text-white"
                            href="{{route('all.customer.pos.transactions.show',[$row->id])}}">
                            العمليات ({{ ($row->transactions()->count()) }})
                            <i class="nav-icon fa fa-credit-card"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $pos->links() }}
</div>








@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script>
        $( document ).ready(function(){
            /* ------------------- excel ----------------- */
            $(document).on("click", "#excel", function (e) {
                to_date=$("#to_date").val();
                from_date=$("#from_date").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/csv",
                    url: 'export-all-returns-pos?from_date='+from_date+'&to_date='+to_date,
                    success: function(data){
                        window.location.href = 'export-all-returns-pos?from_date='+from_date+'&to_date='+to_date;
                    }
                });
                e.preventDefault();
            });
            $(document).on("click", "#pdf", function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/pdf",
                    url: 'export-all-customer-pos-pdf',
                    success: function(data){
                        window.location.href = 'export-all-customer-pos-pdf';
                    }
                });
                e.preventDefault();
            });

        })
    </script>
@endsection