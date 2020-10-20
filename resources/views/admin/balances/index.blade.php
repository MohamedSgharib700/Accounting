@extends('admin.layouts.app')
@section('content')


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> بيانات تحويل أرصدة للمندوبين
    </h1>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 flex intro-y my-10" style="text-align:center">


    <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-1 text-white btn-amwal"
        style="position:relative;top:26px">
        <a class="btn btn-primary btn-amwal " href="{{route('balances.create')}}">اضافة &#10010</a>
    </button>


    <button type="submit" style="position:relative;top:26px">
        <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
            class="button mr-1 mb-2 inline-block bg-theme-9 text-white">
            اضافة لاكثر من مندوب &#10010
        </a>
    </button>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12    intro-y my-10">
    <form class="flex" method="get" action="{{route('agents.index')}}">

        <div class="">
            <input type="text" name="name" class="input w-full border mt-2" placeholder="البحث بالاسم">

        </div>

        <div class="">
            <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-9 text-white"
                style="position:relative;top:5px">بحث</button>
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
    <table class="table table-report -mt-2 text-center">
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
                        <div class=" h-10 " styel="text-align: center;display: block;width: 100%;">
                            {{$user->user->name}}
                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->balance}}</div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center "> {{ $user->user->area?$user->user->area->name : '' }}
                    </div>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center text-theme-9">

                        <a class="flex items-center "> {{$user->created_at}} </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $users->links() }}
</div>



<div class="modal" id="superlarge-modal-size-preview">
    <div class="modal__content modal__content--xl p-10 text-center">
        <div class="modal-header">
            <h5 class="modal-title m-auto" id="exampleModalLongTitle"> اضافه رصيد</h5>
        </div>
        <div class="modal-body">
            <form id="add-balance-form">

                <label>الرصيد</label>
                <input type="number" class="input w-full border mt-2" name="balance">
                <input type="hidden" class="input w-full border mt-2" value="{{auth()->user()->id}}" name="supervisor">
                <div>
                    <label>اختر اسماء المندوبين</label>
                    <div class="mt-2">
                        <select data-placeholder="" class="select2 w-full" multiple
                            name="agent_id[]">
                            <option value="" >اسم المندوب</option>

                            @foreach($agents_only as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    
                    <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"
                        id="add-balance">حفظ</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="button w-24 mr-1 mb-2 bg-theme-6 text-white m-2"
                data-dismiss="modal">اغلاق</button>
        </div>

    </div>
</div>
</div>

<!-------------------------------------------------------------->
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
            url: 'more-balance',
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