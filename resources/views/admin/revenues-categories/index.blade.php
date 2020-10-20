@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> انواع الايرادات </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <button>
        <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
            class="button mr-1 mb-2 inline-block bg-theme-1 text-white">
            اضافة
            &#10010
        </a>
    </button>

</div>





<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="بحث بنوع الايراد .">

        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"><a
                    href="{{route('company-revenues-categories')}}">رجوع</a></button>
        </div>
    </form>
</div>




<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">#</th>
                <th class="whitespace-no-wrap">نوع الايراد</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>

            </tr>
        </thead>
        <tbody>
            @foreach($revenues as $row)
            <tr class="revenue-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->id}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->name ? $row->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->created_at ? $row->created_at : ''}} </div>
                </td>
            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $revenues->links() }}
</div>










<div class="content-wrapper">
    <div>
        <section class="content-header text-center">
            <h1 class="p-3 text-center">

            </h1>
        </section>
        <!-- /.box-header -->

        <section class="row">
            <!-- new-Modal -->
            <div class="modal" id="superlarge-modal-size-preview">
                <div class="modal__content modal__content--xl p-10 text-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title m-auto" id="exampleModalLongTitle"> اضافه نوع ايراد </h5>
                        </div>
                        <div class="modal-body">
                            {{Form::open(array('id'=>'add-revenue-category-form','enctype'=>'multipart/form-data'))}}
                            {{Form::label('name', 'نوع الايراد ')}}
                            {{Form::text('name','',['class' => 'input w-full border mt-2 '])}}<br><br>
                            {{Form::submit('حفظ',['class' => 'button w-24 mr-1 mb-2 bg-theme-1 text-white','id'=>'add-revenue-category'])}}
                            {{ Form::close() }}
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-amwal-2" data-dismiss="modal">اغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @stop
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        /* ------------------- new-pos ----------------- */
        $(document).on("click", "#add-revenue-category", function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'revenue-category',
                data: new FormData($("#add-revenue-category-form")[0]),
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
                    $('#add-revenue-category-form').trigger("reset");
                    $(".revenues-table").prepend("<tr class='revenue-" + data.id + "'>" +
                        "<th scope='row'>" + data.id + "</th>" +
                        "<td>" + data.name + "</td>" +
                        "<td>" + data.created_at + "</td>" +
                        "</tr>");

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