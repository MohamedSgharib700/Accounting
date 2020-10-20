@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> تحويلات المندوبين للبنك
    </h1>
</div>


<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $transferCount}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد التحويلات الحالية </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $transferTotal }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه التحويلات </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap: wrap;" method="get" action="{{route('transfers.bank')}}">
        <div class="col-span-12">
        <label>بحث بقيمه التحويل</label>
            <input type="text" class="input w-full border mt-2 " name="value" placeholder="بحث بقيمة التحويل .">

        </div>
        <div class="col-span-6">
        <label>بحث  باسم المندوب</label>

            <input class="input w-full border mt-2 " type="text" name="name" placeholder="بحث  باسم المندوب .">
        </div>
        <div class="col-span-12">
        <label>من</label>

            <input class="input w-full border mt-2 " type="date" name="from_date" placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
        <label>الي</label>

            <input class="input w-full border mt-2 " type="date" name="to_date" placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2" style="position: relative;top: 59px;">بحث</button>
        </div>
        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2" style="position: relative;top: 59px;"><a
                    href="{{route('agents.index')}}">رجوع</a></button>
        </div>

 

    </form>
</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">اسم المندوب </th>
                <th class="whitespace-no-wrap">قيمة التحويل </th>
                <th class="text-center whitespace-no-wrap"> تاريخ التحويل</th>
                <th class="text-center whitespace-no-wrap"> صورة التحويل</th>
                <th class="text-center whitespace-no-wrap">تعديل</th>
            </tr>
        </thead>


        <tbody>
            @if($transfers)
            @foreach( $transfers as $transfer )
            <tr class="bank-{{$transfer->id}} intro-x">
                <td class="">
                    <div class="flex">
                        <div class=" h-10 ">{{$transfer->user ? $transfer->user->name:''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap echange-{{$transfer->id}}">
                        {{$transfer->value}}
                    </div>
                </td>

                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$transfer->created_at}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        <img style="width: 150px; height: 100px;"
                            src="http://amwal-agent.online/agents/public/{{$transfer->image}}" />
                    </div>
                </td>

                <td>
                    <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
                        class="button mr-1 mb-2 inline-block bg-theme-1 text-white" data-id="{{$transfer->id}}"
                        data-value="{{$transfer->value}}">تعديل
                    </a>
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>

    </table>
</div>
<div class="modal" id="superlarge-modal-size-preview">
        <div class="modal__content modal__content--xl p-10 text-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-auto" id="exampleModalLongTitle"> تعديل </h5>
                </div>
                <div class="modal-body">
                    {{Form::open(array('id'=>'edit-bank-form','enctype'=>'multipart/form-data'))}}
                    {{Form::label('value', 'القيمه ')}}
                    {{Form::number('value','',['class' => 'input w-full border mt-2','id'=>'edit-value'])}}<br>
                    {{Form::submit('حفظ',['class' => 'button w-24 mr-1 mb-2 bg-theme-9 text-white','id'=>'edit-bank'])}}
                    {{ Form::close() }}
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-amwal-2" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>





@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    /* ------------------- edit-bank ----------------- */
    $(document).on("click", ".edit-bank", function() {
        $("#edit-value").val($(this).data('value'));
        Id = $(this).data('id');
    });
    /* ------------------- edit-bank ----------------- */
    $(document).on("click", "#edit-bank", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'edit-bank-transfer/' + Id,
            data: new FormData($("#edit-bank-form")[0]),
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
                $('#edit-bank-form').trigger("reset");

                $(".bank-" + Id).replaceWith("<tr class='bank-" + data.id + "'>" +
                    "<td>" + data.user.name + "</td>" +
                    "<td>" + data.value + "</td>" +
                    "<td>" + data.created_at + "</td>" +
                    "<td><img style='width: 150px; height: 100px;'src='http://amwal-agent.online/agents/public/" +
                    data.image + "'></td>" +
                    "<td><button class='edit-bank btn btn-primary btn-amwal-2'  data-toggle='modal' data-target='#edit-bank-modal' data-value='" +
                    data.value + "' data-id='" + data.id + "' > تعديل </button>" +
                    "</td>" +
                    "</tr>");
            },
            error: function(data) {
                $.each(data.responseJSON.errors, function(key, value) {
                    $('.popup').hide(300);
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