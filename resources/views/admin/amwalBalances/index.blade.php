@extends('admin.layouts.app')
@section('content')




<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> بيانات أرصدة شركة اموال
    </h1>
</div>


<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الارصده</div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{ $sum }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه الارصده</div>
        </div>
    </div>
</div>
<br>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <div> <a href="javascript:;" data-toggle="modal" data-target="#basic-modal-preview"
            class="button inline-block bg-theme-1 text-white" style="width:97px;height:38px;line-height:23px"> اضافه</a>
    </div>

</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 flex intro-y my-10" style="text-align:center">
    <form class="" style="display:flex;flex-wrap: wrap;">


        <div class="mx-2"> 
        <label> بحث باسم الشركه </label> 
        <input type="text" class="input w-full border mt-2" name="name"
                placeholder="بحث باسم الشركه ."> </div>

        <div class="mx-2">
            <label> بحث بالرصيد</label>
            <input type="text" class="input w-full border mt-2" name="balance" placeholder="بحث بالرصيد .">
        </div>
        <div class=" text-right mx-2">
        <label>من : </label>
        <input type="date"  id="from-date" name="from_date" class="input w-full border mt-2" placeholder="بحث بالتاريخ .">
    </div>
    <div class=" text-right mx-2">
        <label>الى : </label>
        <input type="date" id="to-date" name="to_date" class="input w-full border mt-2" placeholder="بحث بالتاريخ .">
    </div>
        <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-1 text-white btn-amwal"
            style="position:relative;top:63px">بحث</button>


        <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-9 text-white"
            style="position:relative;top:63px">
            <a class="btn btn-primary btn-amwal-2" href="{{route('company-revenues')}}">رجوع</a>
        </button>
    </form>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 flex intro-y my-3" style="text-align:center">



</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">#</th>
                <th class="whitespace-no-wrap">اسم الشركه</th>
                <th class="text-center whitespace-no-wrap">الرصيد</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
                <th class="text-center whitespace-no-wrap">التعليق</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $AmwalBalances as $row )
            <tr class="amwal-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">
                            {{$row->id}}
                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->company ? $row->company->name : ''}}
                    </div>
                </td>
                <td class="text-center">{{$row->Balance}}</td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9"> {{$row->created_at}} </div>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">

                        <a class="flex items-center "> {{$row->Notes}} </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $AmwalBalances->links() }}

</div>
<div class="modal" id="basic-modal-preview">
    <div class="modal__content p-10 ">
        {{Form::open(array('id'=>'add-amwal-form','enctype'=>'multipart/form-data'))}}
        {{Form::label('company_id', 'اسم الشركه')}}
        {{Form::select('company_id', $companies,null, array('class' => 'input w-full border mt-2','id'=>'company-id-edit'))}}<br>
        {{Form::label('balance', 'الرصيد ')}}
        {{Form::number('balance','',['class' => 'input w-full border mt-2'])}}<br>
        {{Form::label('notes', 'التعليق')}}
        {{Form::textarea('notes','',['class' => 'input w-full border mt-2','rows' =>3,'cols'=>10,'placeholder'=>'التعليق','id'=>'notes-edit'])}}<br><br>
        {{Form::submit('حفظ',['class' => 'button w-24 mr-1 mb-2 bg-theme-1 text-white','id'=>'add-amwal'])}}
        {{ Form::close() }} </div>
</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- new-pos ----------------- */
    $(document).on("click", "#add-amwal", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'amwal-balance',
            data: new FormData($("#add-amwal-form")[0]),
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
                $('#add-amwal-form').trigger("reset");
                $(".revenues-table").prepend("<tr class='amwal-" + data.id + "'>" +
                    "<th scope='row'>" + data.id + "</th>" +
                    "<td>" + data.company.name + "</td>" +
                    "<td>" + data.balance + "</td>" +
                    "<td>" + data.created_at + "</td>" +
                    "<td>" + data.notes + "</td>" +
                    "</tr>");
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'amwal-report',
                    success: function(data) {
                        $(".sum").html(data.sum);
                        $(".count").html(data.count);
                    }
                });

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