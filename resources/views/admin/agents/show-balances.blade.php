@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> حساب المندوب </h1>
</div>

<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-5xl font-bold leading-8 mt-6"> {{ $availableBalance }}</div>
            <div class="text-base text-gray-600 mt-1"> الرصيد المتاح للمندوب </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-5xl font-bold leading-8 mt-6"> {{ $requiredBalance }}</div>
            <div class="text-base text-gray-600 mt-1"> الرصيد المطلوب منه </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:right;font-size:18px">

    <h2>اسم المندوب : {{$agent->name}} </h2>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $agent_balance }}</div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="balance" placeholder="بحث بالرصيد .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " id="date" type="date" name="created_at"
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

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="text-center whitespace-no-wrap">الرصيد</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tbody>
            @foreach($balances as $row)
            <tr class=" intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">
                            {{$row->balance}}
                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->created_at}}
                    </div>
                </td>
                <td class="text-center">{{$row->Balance}}</td>

            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $balances->links() }}
</div>
</div>
<!--------------------------------------------------------------------->
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;font-size:18px">

    <h3> الارصده المخصمة للمندوب </h3>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $discountsForAgent }}</div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="balance" placeholder="بحث بالرصيد .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " id="date" type="date" name="created_at"
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
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="text-center whitespace-no-wrap">الرصيد</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tbody>
            @foreach($discounts as $row)
            <tr class=" intro-x">
                <td >
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">
                            {{$row->balance}}
                        </div>

                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->created_at}}
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
        
    </table>
    {{ $discounts->links() }}
</div>
</div>
<!------------------------------------------------->

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;font-size:18px;">

    <h3> تم تحويله للعميل :</h3>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $customer_balance }}
            </div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="money" placeholder="بحث بالقيمه .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="date" name="created_date" placeholder="بحث بالتاريخ .">
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

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="text-center whitespace-no-wrap">اسم العميل</th>
                <th class="text-center whitespace-no-wrap">رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
                <th class="text-center whitespace-no-wrap">الملاحظات</th>
            </tr>
        </thead>


        <tbody>
            @foreach($customer_balances as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class="h-10 ">
                            {{$row->clients? $row->clients->name: ''}} </div>


                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->pos? $row->pos->serial: ''}}
                    </div>
                </td>
                <td class="text-center">{{$row->money? $row->money: ''}}</td>
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
    {{ $customer_balances->links() }}

</div>
</div>
<!------------------------------------------------------------>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;font-size:18px">

    <h3> الارصدة التي تم ايداعها للبنك :</h3>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $bank_balance }}

            </div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="value" placeholder="بحث بالرصيد .">

        </div>
        <div class="col-span-6">
            <input class="input w-full border mt-2 " type="date" name="created_date" placeholder="بحث بالتاريخ .">
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


<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="text-center whitespace-no-wrap"> رقم العمليه</th>
                <th class="text-center whitespace-no-wrap"> الرصيد</th>
                <th class="text-center whitespace-no-wrap">الصوره</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>
            </tr>
        </thead>


        <tbody>
            @foreach($bank_balances as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 ">{{$row->number_order}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$row->value}}
                    </div>
                </td>
                <td class="text-center"><img style="width: 150px; height: 100px;margin: auto;"
                        src="http://amwal-agent.online/agents/public/{{$row->image}}" /></td>
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9"> {{$row->created_at}} </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       

    </table>
    {{ $bank_balances->links() }}
</div>
</div>
<!------------------------------------------------------->
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;font-size:18px">

    <h3>الارصدة التي تم ايداعها للخزينة :</h3>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $agent_expenses_balances }}

            </div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex;flex-wrap: wrap;">
        <div class="col-span-12">
            <label>بحث بنوع الايرادات : </label>
            <input type="text" class="input w-full border mt-2 " name="category" placeholder="بحث بنوع الايراد .">

        </div>
        <div class="col-span-6">
            <label>من : </label>

            <input type="date" class="input w-full border mt-2 " name="from_date" placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6">
            <label>الى : </label>

            <input type="date" class="input w-full border mt-2 " name="to_date" placeholder="بحث بالتاريخ .">
        </div>
        <div class="col-span-6" style="position:relative;top:20px">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div class="box-footer" style="position:relative;top:20px">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"><a
                    href="{{route('agents.index')}}">رجوع</a></button>
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
                <th class="text-center whitespace-no-wrap">البيان</th>
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
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->category ? $row->category->name : ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->value ? $row->value: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->notes ? $row->notes: ''}}
                    </div>
                </td>

                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$row->created_at ? $row->created_at : ''}} </div>
                </td>

            </tr>
            @endforeach

        </tbody>
        

    </table>
    {{ $revenues->links() }}
</div>
</div>
<!------------------------------------------------------------------------------------>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 box" style="border: 1px solid #ddd;padding: 15px;border-radius: 5px;background:transparent">

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;font-size:19px">

    <h3>تم تحويله للمندوب من العميل</h3>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center;width:35%;margin:auto">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $customer_delegate_balance }}

            </div>
            <div class="text-base text-gray-600 mt-1"> الاجمالي </div>
        </div>
    </div>
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">

        <div class="col-span-6">
            <label>من : </label>

            <input type="date" class="input w-full border mt-2 " name="created_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6" style="position:relative;top:20px">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
        <div class="box-footer" style="position:relative;top:20px">
            <button type="submit" class="button w-24 mr-1 mb-2 bg-theme-9 text-white m-2"><a
                    href="{{route('agents.index')}}">رجوع</a></button>
        </div>
    </form>
</div>


<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>

            <tr>
                <th class="whitespace-no-wrap">اسم العميل</th>
                <th class="text-center whitespace-no-wrap"> رقم الماكينه</th>
                <th class="text-center whitespace-no-wrap">القيمه</th>
                <th class="text-center whitespace-no-wrap">التاريخ</th>

            </tr>
        </thead>
   

        <tbody>
        @foreach($customer_delegate_balances as $row)
            <tr class="pos-{{$row->id}} intro-x">
                <td class="">
                    <div class="flex">
                        <div class=" h-10 ">{{$row->customer? $row->customer->name: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="flex items-center justify-center ">{{$row->pos? $row->pos->serial: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center "> {{$row->value? $row->value: ''}} </div>
                </td>


                <td class="">
                    <div class="flex items-center justify-center ">
                    {{$row->created_date}} </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       

    </table>
    {{ $customer_delegate_balances->links() }}
</div>
</div>


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
                    
                    <button type="button" class="button  mr-1 mb-2 bg-theme-6 text-white" style="margin-right: 5px;">
                        <i class="fa fa-download"></i><a style="color:white;"
                            href="{{route('agent.balance.pdf' , $agent->id ? $agent->id: '')}}"> تحميل التقرير PDF </a>
                    </button>

                </div>

@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
</script>

@endsection