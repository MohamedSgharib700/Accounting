@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> حسابات الخزينة
    </h1>
</div>

<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $revenuesSum }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي الايرادات</div>
        </div>
    </div>
</div>



<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $expensesSum }}</div>
            <div class="text-base text-gray-600 mt-1"> اجمالي المصروفات
            </div>
        </div>
    </div>
</div>

<div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y my-10" style="text-align:center">
    <div class="report-box zoom-in">
        <div class="box p-5">
            <div class="flex">

            </div>
            <div class="text-3xl font-bold leading-8 mt-6"> {{ $treasuryBalance }}
            </div>
            <div class="text-base text-gray-600 mt-1"> القيمة الحالية بالخزينة

            </div>
        </div>
    </div>
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">

    <h1 class="p-3 "> الايرادات
    </h1>
</div>




<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <label>بحث بالقيمه</label>
            <input type="text" class="input w-full border mt-2 " name="value" placeholder="بحث بالقيمة .">
        </div>

        <div class="col-span-6">
            <label>من</label>

            <input class="input w-full border mt-2 " type="date" name="from_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <label> الي</label>

            <input class="input w-full border mt-2 " type="date" name="to_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2"
                style="position: relative;    top: 59px;">بحث</button>
        </div>
        <div class="box-footer">
            <a class="button w-24 mr-1 mb-2 bg-theme-6 text-white" href="{{route('dashboard')}}"
                style="position: relative;    top: 74px;">رجوع</a>
        </div>
    </form>
</div>

<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">اسم المورد</th>
                <th class="whitespace-no-wrap">قيمة الايرادات</th>
                <th class="text-center whitespace-no-wrap"> فئة الايرادات</th>
                <th class="text-center whitespace-no-wrap"> التاريــــخ</th>
                <th class="text-center whitespace-no-wrap">التعليق</th>
            </tr>
        </thead>


        <tbody>
            @foreach( $revenues as $revenue )
            <tr class=" intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class=" h-10 ">{{$revenue->user->name? $revenue->user->name: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$revenue->value? $revenue->value: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$revenue->category->name?$revenue->category->name: ''}} </div>
                </td>


                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$revenue->created_at? $revenue->created_at: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$revenue->note? $revenue->note: ''}}
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
       

    </table>
    {{ $revenues->links() }}
</div>



<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex">
        <div class="col-span-12">
            <label>بحث بالقيمه</label>
            <input type="text" class="input w-full border mt-2 " name="value" placeholder="بحث بالقيمة .">
        </div>

        <div class="col-span-6">
            <label>من</label>

            <input class="input w-full border mt-2 " type="date" name="from_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <label> الي</label>

            <input class="input w-full border mt-2 " type="date" name="to_date" placeholder="بحث بالتاريخ .">
        </div>

        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2"
                style="position: relative;top: 59px;">بحث</button>
        </div>
    </form>
</div>



<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">قيمة المصروفات </th>
                <th class="whitespace-no-wrap">فئة المصروفات</th>
                <th class="text-center whitespace-no-wrap"> التاريــــخ</th>
                <th class="text-center whitespace-no-wrap">التعليق</th>
            </tr>
        </thead>


        <tbody>
            @foreach( $expenses as $expense )
            <tr class=" intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class=" h-10 ">{{$expense->value? $expense->value: ''}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                        {{$expense->category->name? $expense->category->name: ''}}
                    </div>
                </td>



                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                        {{$expense->created_at? $expense->created_at: ''}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">
                        {{$expense->note? $expense->note: ''}}
                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
        {{ $expenses->links() }}

    </table>
</div>
@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
</script>

@endsection