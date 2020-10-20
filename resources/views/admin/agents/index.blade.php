@extends('admin.layouts.app')
@section('content')


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> معاملات المناديب
    </h1>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$agent_balance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الارصدة المحولة للمناديب</div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$allagentsCurrentBallance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي رصيد المندوبين الحالي</div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{$allCustomersCurrentBallance}}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي المبلغ المطلوب تحصيله من المناديب</div>
        </div>
    </div>
</div>


<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap;" method="get" action="{{route('agents.index')}}">
        <div class="col-span-12">
            <input type="text" name="name" class="input w-full border mt-2 " placeholder="البحث بالاسم">

        </div>
        <div class="col-span-6">
            <input type="date" name="date" class="input w-full border mt-2 " id="date">
        </div>

        <div class="col-span-6">
            <button id="track" class="button inline-block bg-theme-1 text-white m-2">استعلام</button>
        </div>
        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2">بحث</button>
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
                <th class="text-center whitespace-no-wrap">رصيد المندوب الحالي</th>
                <th class="text-center whitespace-no-wrap">المطلوب تحصيله من المندوب</th>
                <th class="text-center whitespace-no-wrap">جميع المكينات الخاصة بالمندوب</th>

            </tr>
        </thead>

        <tbody>
            @foreach( $users as $user )
            <tr class=" intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">
                            {{$user->id}}

                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->name}} </div>
                </td>
                <td class="text-center">
                    <a class="btn btn-primary btn-amwal-2 "
                        href="{{route('balance.agent' , $user->id)}}">{{$user->balance->sum('balance')}}
                    </a>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        @php
                        $getallmoneysendtoagent = $user->balance->where('type' , 1)->sum('balance');
                        $getallmoneysendTobank = $user->TransferCreditToCustomer->sum('value');
                        $getallmoneysendTocustomer =
                        $user->TransferCreditFromDelegateToCustomers->sum('money');
                        $getallmoneyrefundedfromAgent =
                        $user->RefundMoneyFromClientToDelegates->sum('value');
                        $discountsForAgent = App\Models\AgentBalance::where('agent_id',
                        $user->id)->where('type' , 0)->sum('balance');
                        $discountsfinally = $discountsForAgent * -1 ;
                        $AgentCurrentBalance = $getallmoneysendtoagent - $discountsfinally-
                        $getallmoneysendTocustomer + $getallmoneyrefundedfromAgent ;

                        $AgentBalance = $getallmoneysendtoagent - $discountsfinally- $getallmoneysendTobank
                        ;

                        @endphp
                        <a class="button w-30 mr-1 mb-2 bg-theme-9 text-white m-2" href="{{route('agent.balances.show' , $user->id)}}"> {{ $AgentCurrentBalance}}
                        </a>



                    </div>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex items-center sm:justify-center text-theme-6">

                        <a class="" href="{{route('agents.show-pos' , $user->id)}}">{{ $AgentBalance }} </a>
                    </div>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">

                        <a class="button w-30 mr-1 mb-2 bg-theme-1 text-white m-2"
                            href="{{route('agents.show-pos' , $user->id)}}">الماكينات({{$user->pos->count()}})
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
      
  
    </table>
    {{ $users->links() }}
</div>
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

    <div class="row no-print">
        <div class="col-xs-12">
            <button type="button" class="button w-30 mr-1 mb-2 bg-theme-1 text-white"><i class="fa fa-download"></i><a
                    style="color:white;" href="{{route('agents.exportexcel')}}"> تحميل التقرير Excel </a>
            </button>
            <button type="button" class="button w-30 mr-1 mb-2 bg-theme-9 text-white" style="margin-right: 5px;">
                <i class="fa fa-download"></i><a style="color:white;" href="{{route('exportpdf.totalsforallagents')}}">
                    Download pdf file </a>
            </button>

        </div>
    </div>
</div>

<div class="content-wrapper">

    <!-- /.box-header -->
    <div class="box-body">


        <div class="container text-left">
            <div class="row">

                <div class="col-sm-12 text-right">
                </div>



                <!-- /.box-body -->
            </div>
            <div class="clr"></div>
            <!-- /.box -->
            <section class="row">




            </section>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    /* ------------------- excel ----------------- */
    $(document).on("click", "#track", function(e) {
        date = $("#date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            Content: "text/csv",
            url: 'agents-date-track/' + date,
            success: function(data) {
                window.location.href = 'agents-date-track/' + date;
            }
        });
        e.preventDefault();
    });
})
</script>
@endsection