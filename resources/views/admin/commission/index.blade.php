
@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 ">                 العمولات 
  </h1>
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="margin:auto;width:60%;text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-5xl font-bold leading-8 mt-6">  {{number_format($sum, 1, '.', '')}}</div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
                    <div class="">
                    <div class="col-sm-12 text-right">
                        <button id="commission" class="button w-30 mr-1 mb-2 bg-theme-9 text-white m-2">اضافه عموله الماكينات</button>
                        <button type="submit" class="button inline-block bg-theme-1 text-white m-2" id="excel"  style="margin-left: 20px;">
                                <i class="fa fa-download"></i><a style="color:white;" > تحميل ملف اكسيل </a>
                        </button>
                        <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-6 text-white m-2" id="pdf"  style="margin-left: 20px;">
                                <i class="fa fa-download"></i><a style="color:white;" > تحميل ملف pdf </a>
                        </button>
                </div>



                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
        <tr>

<th class="whitespace-no-wrap">رقم الماكينه</th>
<th class="whitespace-no-wrap"> المندوب</th>
<th class="text-center whitespace-no-wrap"> العميل</th>                           
<th class="text-center whitespace-no-wrap">  العموله</th>
<th class="text-center whitespace-no-wrap">  التاريخ</th>
</tr>
    
        </thead>
        <tbody>
        @foreach($commissions as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class="h-10 ">{{$row->pos ? $row->pos->serial: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->pos->user ? $row->pos->user->name: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->pos->customer ? $row->pos->customer->name: ''}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    {{number_format($row->commission, 1, '.', '')}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->date ? $row->date: ''}} </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       

    </table>
    {{ $commissions->links() }}
</div>










@stop
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $( document ).ready(function(){
                       /* ------------------- commissions ----------------- */
                       $(document).on("click", "#commission", function (e) {
                Swal.fire({
                    title: 'هل انت متاكد?',
                    text: "سيتم اضافه العموله للتجار",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'الغاء',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم'
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: 'pos-commissions',
                            processData: false,
                            success: function (res) {
                                if((res.errors)){
                                    Swal.fire({
                                        type: 'error',
                                        title: 'عفوا حاول مره اخري',
                                        text: 'حدث خطا ',
                                    })
                                }else{
                                    Swal.fire(
                                        'تمت العمليه',
                                        'بنجاح',
                                        'success'
                                    )
                                }
                            },
                            error:function (data) {
                                Swal.fire({
                                    type: 'error',
                                    title: 'عفوا',
                                    text: 'حدثت مشكله !حاول من جديد',
                                });
                            }
                        });
                    } else {
                        swal("تم الغاء الاضافه", "لم تتم العمليه :)", "error");
                    }
                });
                e.preventDefault();
            });
             /* ------------------- excel ----------------- */
             $(document).on("click", "#excel", function (e) {
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/csv",
                    url: 'export-daily-commissions',
                    success: function(data){
                        window.location.href = 'export-daily-commissions';
                    }
                });
                e.preventDefault();
            });
            /* ------------------- pdf ----------------- */
            $(document).on("click", "#pdf", function (e) {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                Content: "text/pdf",
                url: 'export-daily-commissions-pdf',
                success: function(data){
                    window.location.href = 'export-daily-commissions-pdf';
                }
            });
            e.preventDefault();
        });
        })
    </script>
@stop


