@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> بيانات الارصدة المخصمة من المندوبين</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <button class="button w-24 mr-1 mb-2 bg-theme-1 text-white"><a href="{{route('show.balance.discount')}}">خصم
        </a></button>

    <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
        class="button mr-1 mb-2 inline-block bg-theme-1 text-white">خصم
        لاكثر من مندوب &#10010</a>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="form-horizontal" method="get" action="{{route('agents.index')}}">
        <div class="grid grid-cols-12 gap-2">

            <div class=" col-span-3">

                <input type="text" name="name" class="input w-full border mt-2" placeholder="البحث بالاسم">

            </div>

            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white">بحث</button>
        </div>
    </form>
</div>

<div>

    @if(Session::has('message'))
    <br>
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}
    </p>
    @endif

</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">القيمة </th>
                <th class="text-center whitespace-no-wrap">المنطقة</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
            </tr>
        </thead>
        <tbody>

            @foreach( $users as $user )
            <tr class=" intro-x">
                <td class="">
                    <div class="flex">
                        <div class=" h-10 ">
                            {{$user->user->name}}
                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->balance}}
                    </div>
                </td>
                <td class="text-center">{{ $user->user->area?$user->user->area->name : '' }}</td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9"> {{$user->created_at}} </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       
    </table>
    {{ $users->links() }}

</div>
<!-------------------------------------------------->

<div class="modal" id="superlarge-modal-size-preview">
    <div class="modal__content modal__content--xl p-10 text-center" >
            <div class="modal-header">
                <h5 class="modal-title m-auto" id="exampleModalLongTitle"> اضافه رصيد</h5>
            </div>
            <div class="modal-body col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
                <form id="add-balance-form">

                    <label>الرصيد</label>
                    <input type="number" class="input w-full border mt-2" name="balance"><br>
                    <input type="hidden" class="input w-full border mt-2" value="{{auth()->user()->id}}"
                        name="supervisor">
                    <label>اختر اسماء المندوبين </label>
                    <select class="select2 w-full" multiple
                        name="agent_id[]">
                        <option value="">اسم المندوب</option>

                        @foreach($agents_only as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        <br>
                        <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2" id="add-balance">حفظ</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white m-2" data-dismiss="modal">اغلاق</button>
            </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {

    $('.js-example-basic-multiple').select2({
        dropdownAutoWidth: true,
        multiple: true,
        width: '100%',
        height: '30px',
        placeholder: "Select POS",
        allowClear: true
    });
});
</script>
@stop
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- new-pos ----------------- */
    $(document).on("click", "#add-balance", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'more-balance-discount',
            data: new FormData($("#add-balance-form")[0]),
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
                $('#add-balance-form').trigger("reset");

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
@stop