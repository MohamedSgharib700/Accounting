@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> الماكينات المفعله</h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="width: 39%;margin: auto;height: fit-content;text-align: center;">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> العدد </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap: wrap;">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="serial" placeholder="بحث برقم الماكينه .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="text" name="code" placeholder="بحث بالكود .">
        </div>


        <div class="col-span-12">
            <input type="date" class="input w-full border mt-2 " name="from_date" id="from_date"
                placeholder="بحث بالتاريخ .">

        </div>
        <div class="col-span-12">
            <input type="date" class="input w-full border mt-2 " name="to_date" id="to_date"
                placeholder="بحث بالتاريخ .">

        </div>










        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div>
            <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-9  text-white m-2" id="pdf"
                style="margin-right: 5px;">
                <i class="fa fa-download"></i><a style="color:white;"> تحميل pdf </a>
            </button>
        </div>
        <div>
            <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-12 text-white m-2" id="excel"
                style="margin-right: 5px;">
                <i class="fa fa-download"></i><a style="color:white;"> تحميل ملف اكسيل </a>
            </button>
        </div>
    </form>
</div>
<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center  large-table -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">كود المندوب</th>
                <th class="text-center whitespace-no-wrap"> اسم العميل</th>
                <th class="text-center whitespace-no-wrap"> رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap">رمز التفعيل</th>
                <th class="text-center whitespace-no-wrap">رقم سيريال الشريحه</th>
                <th class="text-center whitespace-no-wrap">رقم شريحه الماكينه</th>
                <th class="text-center whitespace-no-wrap">تاريخ التفعيل</th>
                <th class="text-center whitespace-no-wrap">نوع البيع</th>
                <th class="text-center whitespace-no-wrap">اجمالي العمليات</th>
                <th class="text-center whitespace-no-wrap">رصيد المكينة الحالي</th>
                <th class="text-center whitespace-no-wrap">العمليات</th>

            </tr>
        </thead>

        <tbody>
            @foreach($pos as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td >
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$row->user ? $row->user->name: ''}}</div>
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
                        {{$row->serial}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->machine_code}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$row->sim_card_serial ? $row->sim_card_serial: ''}}</div>
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
                        <a class="show-transactions  btn  btn-amwal-2">
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
                        <a class="button w-30 mr-1 mb-2 bg-theme-9  text-white"
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- excel ----------------- */
    $(document).on("click", "#excel", function(e) {
        to_date = $("#to_date").val();
        from_date = $("#from_date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-customer-pos?from_date=' + from_date + '&to_date=' + to_date,
            success: function(data) {
                window.location.href = 'export-all-customer-pos?from_date=' + from_date +
                    '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });
    $(document).on("click", "#pdf", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/pdf",
            url: 'export-all-customer-pos-pdf',
            success: function(data) {
                window.location.href = 'export-all-customer-pos-pdf';
            }
        });
        e.preventDefault();
    });

})
</script>
@endsection