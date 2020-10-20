<!DOCTYPE html>
<html dir="rtl" >
<head>
    <style>
        body {
            font-family: 'Riyaz', sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: rgb(189, 189, 189);
            padding: 10px;
            text-align: center;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid black;
        }

    </style>
</head>
<body style="font-family: 'Amiri', sans-serif; direction: rtl ">
<div class="header-holder " style="padding:30px;border-raduis:5px; text-align: center">
    <img src="../public/dist/images/logo.png"  width="200px" class="img-fluid" >
</div>
<div class="row">
    <div class="col-md-12" style="text-align: center">
        <h2>التقرير اليومي لشركه اموال خاص بالارصده عن يوم {{$my_time }} </h2>
        <hr>
        <br><br>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table">
            <thead>
            <tr>
                <th rowspan="2">محفظه اموال لدى الشركات الاخرى</th>

                @foreach( $amwal_balance as $row )
                    <td>{{$row->company ? $row->company->name : ''}}</td>
                    <td>{{$row->sum}}</td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table" >
            <tbody>
            <tr>
                <td ><strong > الاجمالي </strong></td>
                <td><strong > {{ $amwal_balances }}</strong></td>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th  style="padding: 10px">  </th>
                <th style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > رصيد محفظه اموال </strong></td>
                <td><strong > {{ $amwal_balances }}</strong></td>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th  style="padding: 10px">  </th>
                <th style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > تحويلات المناديب  </strong></td>
                <td><strong > {{ $agent_balances }}</strong></td>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th  style="padding: 10px">  </th>
                <th style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > الرصيد الباقي في المحفظه  </strong></td>
                <td><strong > {{number_format($wallet, 1, '.', '')}}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table" >
            <thead class="thead-light">
            <tr>
                <th colspan="2" style="padding: 10px">  </th>
                <th colspan="2" style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > اجمالي المحول للماكينات  </strong></td>
                <td><strong > {{$pos_balances}}</strong></td>
                <td ><strong > اجمالي ارصده المناديب  </strong></td>
                <td><strong > {{ $all_agent_balances }}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table" >
            <thead class="thead-light">
            <tr>
                <th  style="padding: 10px">  </th>
                <th style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > اجمالي العمليات </strong></td>
                <td><strong > {{number_format($total_transactions, 1, '.', '')}}</strong></td>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th> النقديه بالخزينه </th>
                <th>الايداعات البنكيه </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong >{{$Treasure}} </strong></td>
                <td><strong > {{$bank_balances}}</strong></td>
            </tr>
            </tbody>
            <thead class="thead-light">
            <tr>
                <th  style="padding: 10px">  </th>
                <th style="padding: 10px"> </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td ><strong > اجمالي عدد الماكينات في المخزن </strong></td>
                <td><strong > {{$all_pos}}</strong></td>
            </tr>
            <tr>
                <td ><strong > اجمالي الماكينات المنصرفه للمندوبين </strong></td>
                <td><strong > {{$agent_pos}}</strong></td>
            </tr>
            <tr>
                <td ><strong > صافي المخزن</strong></td>
                <td><strong > {{$remain_pos}}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div >
        <br><br>
        <strong > توقيع رئيس مجلس الاداره</strong>
        <br><br>
        <strong > -------------------------------</strong>
    </div>
</div>


</body>
</html>