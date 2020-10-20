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
                <th class="text-center whitespace-no-wrap">تاريخ التفعيل</th>
                <th class="text-center whitespace-no-wrap">رصيد المكينة الحالي</th>
                <th class="text-center whitespace-no-wrap">العمليات</th>

            </tr>
        </thead>

        <tbody>
            @foreach($pos as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td >
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$row->user_id==0?$row->pos_note->where('status','=','1')->first->value('old_agent_id')->old_agent->name:$row->user->name }}</div>
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
                    <div class="flex items-center justify-center "> {{$row->customer ? $row->customer->created_at: ''}}
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
                            {{$TransferCredit - $transaction -$refundMoney  +$commissions}}

                        </a>
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                    <a href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview" data-pos="{{$row->id }}" data-delegate="{{$row->user_id==0?$row->pos_note->where('status','=','1')->first->value('old_agent_id')->old_agent_id:$row->user_id }}" data-client="{{$row->customer_id }}" data-value="{{$TransferCredit - $transaction +$commissions}}"
            class="button inline-block bg-theme-1 text-white refund" style="height:38px;line-height:23px"> سحب</a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $pos->links() }}
</div>
<div class="modal" id="basic-modal-preview">
    <div class="modal__content p-10 ">
        {{Form::open(array('id'=>'refund-money-form','enctype'=>'multipart/form-data'))}}
        {{Form::label('value', 'الرصيد ')}}
        {{Form::number('value','',['class' => 'input w-full border mt-2','step'=>'0.0000000001'])}}<br><br>
        {{Form::submit('حفظ',['class' => 'button w-24 mr-1 mb-2 bg-theme-1 text-white','id'=>'refund-money'])}}
        {{ Form::close() }} </div>
</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on("click", ".refund", function() {
        posId = $(this).data('pos');
        delegateId = $(this).data('delegate');
        clientId = $(this).data('client');
        current = $(this).data('value');
    });
/* ------------------- new-refund----------------- */
$(document).on("click", "#refund-money", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'refund-money-to-delegate/'+posId+'/'+delegateId+'/'+clientId+'/'+current,
            data: new FormData($("#refund-money-form")[0]),
            dataType: 'json',
            async: false,
            contentType: false,
            processData: false,
            success: function(data) {
                Swal.fire(
                    'تمت العمليه بنجاح',
                    '',
                    'success'
                );
                $('#refund-money-form').trigger("reset");
               /* $(".revenues-table").prepend("<tr class='amwal-" + data.id + "'>" +
                    "<th scope='row'>" + data.id + "</th>" +
                    "<td>" + data.company.name + "</td>" +
                    "<td>" + data.balance + "</td>" +
                    "<td>" + data.created_at + "</td>" +
                    "<td>" + data.notes + "</td>" +
                    "</tr>");*/
            },
            error: function(data) {
                $.each(data.responseJSON.errors, function(key, value) {
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: value,
                    });
                })
            }
        });
        e.preventDefault();
    });

})
</script>
@endsection