@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> بيانات ارصدة اقساط المكينات </h1>
</div>

<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$agent_pos_balance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الاقساط </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$agent_pos_balance_payed}}
            </div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الاقساط المدفوعة
            </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$agent_pos_balance_unpayed}}
            </div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الاقساط غير المدفوعة
            </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap" method="get">
        <div class="col-span-12">
            <label>بحت باسم التاجر : </label>

            <input type="text" class="input w-full border mt-2 " name="name" placeholder="بحث باسم التاجر .">

        </div>
        <div class="col-span-6">
            <label>بحث بنوع القسط : </label>

            <input class="input w-full border mt-2 " type="text" name="contract_name" placeholder="بحث بنوع القسط  .">
        </div>
        <div class="col-span-6">
            <label>من : </label>

            <input class="input w-full border mt-2 " type="date" name="from_date" id="from_date"
                placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <label>الي : </label>

            <input class="input w-full border mt-2 " type="date" name="to_date" id="to_date"
                placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2"
                style="position: relative;top: 59px;">بحث</button>
        </div>
        <div>
            <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-9 text-white text-white m-2" id="excel"
                data-id="{{ $id}}" style="margin-right: 5px;position: relative;top: 59px;">
                <i class="fa fa-download"></i><a style="color:white;"> تحميل ملف اكسيل </a>
            </button>
        </div>

    </form>
</div>

@if(Session::has('message'))
<br>
<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}
</p>
@endif


<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">اسم التاجر</th>
                <th class="text-center whitespace-no-wrap"> رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap"> نوع القسط </th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">الحالة</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
                <th class="text-center whitespace-no-wrap">العمليات</th>

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
                        {{$installment->customer? $installment->customer->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{ $installment->pos->machine_code ? $installment->pos->machine_code : '' }} </div>
                </td>

                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$installment->Contract? $installment->Contract->name : ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$installment->value}} </div>
                </td>


                @if($installment->status == 0)
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        غير مدفوع </div>
                </td>
                @else
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        تم الدفع</div>
                </td>
                @endif

                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$installment->created_at}}
                    </div>
                </td>
                @if($installment->status==0)
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        <button class="button w-24 mr-1 mb-2 bg-theme-6 text-white change change-{{$installment->id}}"
                            data-id="{{$installment->id}}">
                            دفع القسط
                        </button>
                    </div>
                </td>
                @else
                <td>
                    <button class="button w-24 mr-1 mb-2 bg-theme-9 text-white change change-{{$installment->id}}">
                        مدفوع
                    </button>
                </td>
                @endif
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $installments->links() }}

</div>



@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- new-pos ----------------- */
    $(document).on("click", "#excel", function(e) {
        to_date = $("#to_date").val();
        from_date = $("#from_date").val();
        agent_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-all-transactions-pos/' + agent_id + '?from_date=' + from_date +
                '&to_date=' + to_date,
            success: function(data) {
                window.location.href = 'export-all-transactions-pos/' + agent_id +
                    '?from_date=' + from_date + '&to_date=' + to_date;
            }
        });
        e.preventDefault();
    });
    /* ------------------- edit-pos-active ----------------- */
    $(document).on("click", ".change", function(e) {
        var pos_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'edit-pos-custoday/' + pos_id,
            success: function(data) {
                $(".change-" + pos_id).replaceWith(
                    "<button class='btn btn-success change change-" + data.id +
                    "' data-id='" + data.id + "'>  مدفوع </button>");

            }
        });
        e.preventDefault();
    })

})
</script>
@endsection