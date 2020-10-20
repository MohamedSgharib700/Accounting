@extends('admin.layouts.app')
@section('content')
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:right">

    <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

        <h1 class="p-3 "> الماكينات</h1>
    </div>

</div>




<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap:wrap">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="serial" placeholder="بحث برقم الماكينه .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="date" name="created_at" class="form-control"
                placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div class="box-footer">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"><a
                    href="{{route('agents.index')}}">رجوع</a></button>
        </div>
    </form>
</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-auto">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">رقم الماكينه</th>
                <th class="whitespace-no-wrap">رمز التفعيل</th>
                <th class="text-center whitespace-no-wrap"> رقم شريحه الماكينه</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
                <th class="text-center whitespace-no-wrap"> الحاله </th>
                <th class="text-center whitespace-no-wrap">الصوره</th>
                <th class="whitespace-no-wrap"> ip</th>
                <th class="whitespace-no-wrap"> اجمالي رصيد المكينة الحالي</th>
                <th class="whitespace-no-wrap"> العمليات</th>

            </tr>
        </thead>
        <tbody>
        @foreach($pos as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->serial}}</div>
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->machine_code}}</div>
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->sim_card ? $row->sim_card: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                    {{$row->created_at}}
                    </div>
                </td>

                <td class="text-center">
                    <div class="flex items-center justify-center "> 
                    
                    
                    
                    
                    @if($row->active==1)
                    <button class="button w-24 mr-1 mb-2 bg-theme-9 text-white change change-{{$row->id}}" data-id="{{$row->id}}"
                        data-active="{{$row->active}}">
                        نشط
                    </button>

                    @else
                    <button class="button w-24 mr-1 mb-2 bg-theme-6 text-white change change-{{$row->id}}" data-id="{{$row->id}}"
                        data-active="{{$row->active}}">
                        غير نشط
                    </button>
                    @endif                    
                    </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center ">
                    @if($row->image)<img src='{{url("/$row->image")}}' width="100px">@endif
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                    {{$row->ip ? $row->ip: ''}}
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    <a class="show-transactions  btn  btn-amwal-2">
                    @php
                 $TransferCredit = $row->TransferMoneyFromDelegateToPos->sum('money');
                 $transaction = $row->transactions->sum('value');
                 $commissions = $row->commissions->sum('commission');
                 $refundMoney=$row->refundMoney()->whereDate('created_at','>=','2020-09-14')->sum('value');
                 @endphp 
                 {{$TransferCredit - $transaction -$refundMoney  +$commissions}}

                    </a>
                    </div>
                </td>
                <td class="w-40">
                    <div class="flex items-center justify-center ">
                    <a class="button inline-block bg-theme-1 text-white m-2"
                        href="{{route('agent.pos.transactions.show',[$row->id])}}">
                        العمليات ({{ ($row->transactions()->count()) }})
                    </a>
                    </div>
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
</script>

@endsection