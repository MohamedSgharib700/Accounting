@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> معاملات المناديب </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$agent_balance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الارصدة المحولة للمناديب </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$allagentsCurrentBallance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي رصيد المندوبين الحالي
            </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$allCustomersCurrentBallance}}
            </div>
            <div class="text-base text-gray-600 mt-1"> اجمالي المبلغ المطلوب تحصيله من المناديب

            </div>
        </div>
    </div>
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="البحث بالاسم">

        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
    </form>
</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">#</th>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="text-center whitespace-no-wrap">جميع الارصدة المحولة للمندوب</th>
                <th class="text-center whitespace-no-wrap"> رصيد المندوب الحالي</th>
                <th class="text-center whitespace-no-wrap">المطلوب تحصيله من المندوب</th>

            </tr>
        </thead>


        <tbody>
            @foreach( $users as $user )
            <tr class=" intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$user->id}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->name}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$user->balance()->whereDate('created_at','<=',$date)->sum('balance')}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center ">
                        @php
                        $getallmoneysendtoagent = $user->balance()->whereDate('created_at','<=',$date)->
                            where('type' , 1)->sum('balance');
                            $getallmoneysendTobank =
                            $user->TransferCreditToCustomer()->whereDate('created_at','<=',$date)->
                                sum('value');
                                $getallmoneysendTocustomer =
                                $user->TransferCreditFromDelegateToCustomers()->whereDate('created_at','
                                <=',$date)->sum('money');
                                    $getallmoneyrefundedfromAgent =
                                    $user->RefundMoneyFromClientToDelegates()->whereDate('created_at','
                                    <=',$date)->sum('value');
                                        $discountsForAgent = App\Models\AgentBalance::where('agent_id',
                                        $user->id)->whereDate('created_at','<=',$date)->where('type' ,
                                            0)->sum('balance');
                                            $discountsfinally = $discountsForAgent * -1 ;
                                            $AgentCurrentBalance = $getallmoneysendtoagent -
                                            $discountsfinally- $getallmoneysendTocustomer +
                                            $getallmoneyrefundedfromAgent ;

                                            $AgentBalance = $getallmoneysendtoagent - $discountsfinally-
                                            $getallmoneysendTobank ;

                                            @endphp
                                            {{ $AgentCurrentBalance}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center text-theme-9">
                        {{ $AgentBalance }} </div>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $users->links() }}

</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <div class="">
        <button type="button" id="excel" class="button w-30 mr-1 mb-2 bg-theme-9 text-white" data-date="{{$date}}"><i
                class="fa fa-download"></i>
            تحميل التقرير Excel
        </button>

    </div>
</div>



@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- excel ----------------- */
    $(document).on("click", "#excel", function(e) {
        date = $(this).data('date');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'agents-export-excel/' + date,
            success: function(data) {
                window.location.href = 'agents-export-excel/' + date;
            }
        });
        e.preventDefault();
    });

})
</script>
@endsection