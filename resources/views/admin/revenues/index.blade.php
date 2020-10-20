@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> الايرادات </h1>
</div>
<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{ $count}}</div>
            <div class="text-base text-gray-600 mt-1"> عدد الايرادات </div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6">{{ $sum }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي قيمه الايرادات </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <button>

        <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
            class="button mr-1 mb-2 inline-block bg-theme-1 text-white">
            اضافة &#10010
        </a>
    </button>

</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap;">
        <div class="col-span-12 m-2">
            <label> بحث باسم مسجل البيان </label>

            <input type="text" class="input w-full border mt-2 " name="name" placeholder="بحث باسم مسجل الايراد .">

        </div>
        <div class="col-span-12 m-2">
            <label> نوع الايراد</label>

            <input type="text" class="input w-full border mt-2 " name="category" placeholder="بحث بنوع الايراد .">
        </div>
        <div class="col-span-12 m-2">
            <label> بحث بالقيمه </label>

            <input type="text" class="input w-full border mt-2 " name="value" placeholder="بحث بالقيمه .">
        </div>
        <div class=" text-right m-2">
            <label>من : </label>
            <input type="date" name="from_date" class="input w-full border mt-2 " placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-xs-4 text-right m-2">
            <label>الى : </label>
            <input type="date" name="to_date" class="input w-full border mt-2 " placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6 m-2">
            <button class="button inline-block bg-theme-1 text-white m-2" style="position: relative;
    top: 59px;">بحث</button>
        </div>
        <div class="box-footer m-2">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2" style="position: relative;
    top: 59px;"><a href="{{route('company-revenues')}}">رجوع</a></button>
        </div>


    </form>
</div>






<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">#</th>
                <th class="whitespace-no-wrap">اسم المسجل</th>
                <th class="text-center whitespace-no-wrap"> اسم المندوب</th>
                <th class="text-center whitespace-no-wrap"> نوع الايراد</th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">الصورة</th>
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
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->user ? $row->user->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->agent ? $row->agent->name : ''}} </div>
                </td>

                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->category ? $row->category->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->value ? $row->value: ''}} </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> <img style="width: 80px; height: 80px;"
                            src="{{asset($row->image)}}"> </div>
                </td>

                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->created_at ? $row->created_at : ''}}
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       
    </table>
    {{ $revenues->links() }}
</div>
<!-- new-Modal -->
<div class="modal" id="superlarge-modal-size-preview">
    <div class="modal__content modal__content--xl p-10 text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-auto" id="exampleModalLongTitle"> اضافه ايراد</h5>
            </div>
            <div class="modal-body">
                {{Form::open(array('id'=>'add-revenue-form','enctype'=>'multipart/form-data'))}}
                {{Form::label('category_id', 'نوع الايراد')}}
                {{Form::select('category_id', $categories,null, array('class' => 'input w-full border mt-2','id'=>'category-id-edit'))}}<br>
                {{Form::label('agent_id', 'اسم المندوب')}}
                {{Form::select('agent_id', $agents,null, array('class' => 'input w-full border mt-2','id'=>'agent-id-edit'))}}<br>
                {{Form::label('value', 'القيمه ')}}
                {{Form::number('value','',['class' => 'input w-full border mt-2'])}}<br>
                {{Form::label('notes', 'البيان')}}
                {{Form::textarea('notes','',['class' => 'input w-full border mt-2','rows' =>3,'cols'=>10,'placeholder'=>'البيان','id'=>'notes-edit'])}}<br><br>
                {{Form::label('image', 'الصوره')}}
                {{Form::file('image',['class'=>'form-control-file'])}}<br><br>
                {{Form::submit('حفظ',['class' => 'button w-24 mr-1 mb-2 bg-theme-9 text-white','id'=>'add-revenue'])}}
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
    $(document).on("click", "#add-revenue", function(e) {
        var path = "/";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'revenue',
            data: new FormData($("#add-revenue-form")[0]),
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
                $('#add-revenue-form').trigger("reset");
                $(".revenues-table").prepend("<tr class='revenue-" + data.id + "'>" +
                    "<th scope='row'>" + data.id + "</th>" +
                    "<td>" + data.user.name + "</td>" +
                    "<td>" + data.agent.name + "</td>" +
                    "<td>" + data.category.name + "</td>" +
                    "<td>" + data.value + "</td>" +
                    "<td>" + data.notes + "</td>" +
                    "<td><img src='" + path + data.image + "' width='100px'></td>" +
                    "<td>" + data.created_at + "</td>" +
                    "</tr>");
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'revenue-report',
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