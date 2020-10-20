@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> الماكينات المتاحه</h1>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="margin:auto;width:50%;text-align:center;">
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
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="serial" placeholder="بحث برقم الماكينه .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="date" name="created_at" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div>
            <button type="submit" class="button w-30 mr-1 mb-2 bg-theme-12 text-white m-2" id="excel" data-id="{{$id}}"
                style="margin-right: 5px;">
                <i class="fa fa-download"></i><a style="color:white;"> تحميل ملف اكسيل </a>
            </button>
        </div>

        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2">
                <a href="{{route('agents-pos')}}">رجوع</a>
            </button>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">رقم الماكينه</th>
                <th class="whitespace-no-wrap">رمز التفعيل</th>
                <th class="text-center whitespace-no-wrap"> رقم سيريال الشريحه</th>
                <th class="text-center whitespace-no-wrap"> رقم شريحه الماكينه</th>
            </tr>
        </thead>

        <tbody>

            @foreach($pos as $row)
            <tr class="pos-{{$row->id}}">
                <td>{{$row->serial}}</td>
                <td>{{$row->machine_code}}</td>
                <td>{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</td>
                <td>{{$row->sim_card ? $row->sim_card: ''}}</td>
            </tr>
            @endforeach

        </tbody>
        <tbody>
            @foreach($pos as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->serial}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->machine_code}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$row->sim_card ? $row->sim_card: ''}}</div>
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
        agentid = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'export-available-agent-pos/' + agentid,
            success: function(data) {
                window.location.href = 'export-available-agent-pos/' + agentid;
            }
        });
        e.preventDefault();
    });

})
</script>
@endsection