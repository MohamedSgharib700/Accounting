<!DOCTYPE html>
<html dir="rtl" >
<head>
    <style>
        body {
            font-family: 'Riyaz', sans-serif;
        }
        table {
  border-collapse: collapse;
  width: 100%;
}

th {
  background-color: #f2f2f2;
  padding: 8px;
  text-align: right;
  border-bottom: 1px solid #ddd;
}

th, td {
  padding: 8px;
  text-align: right;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
    </style>
</head>
<body style="font-family: 'Amiri', sans-serif; direction: rtl">
<div class="header-holder " style="background:#410156;padding:30px;border-raduis:5px;">
    <img src="../public/dist/images/logo.png" class="img-fluid" style="margin-left: 200px">
    <span class="font-weight-bold" style="color:#fff;font-size:25px;"> التاريخ : {{$my_time }} </span>

</div>
<br><br>
<div class="row">
    <div class="col-md-12" style="text-align: center">
       <h2>تقرير عام</h2>
        <hr>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
        <strong>
            -
            <span style="font-size:18px"> اجمالي العمليات : </span>
            <span > {{number_format($total_transactions, 1, '.', '')}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong >
            -
            <span style="font-size:18px"> اجمالي المحول للماكينات : </span>
            <span > {{$pos_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong >
            -
            <span style="font-size:18px"> اجمالي المحول للمندوبين : </span>
            <span > {{$agent_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong >
            -
            <span style="font-size:18px"> اجمالي المخصوم للمندوبين : </span>
            <span > {{$agent_discount_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong>
            -
            <span style="font-size:18px"> اجمالي المحول للبنك : </span>
            <span > {{$bank_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong>
            -
            <span style="font-size:18px"> اجمالي المطلوب من المندوبين : </span>
            <span > {{$order_agent_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong>
            -
            <span style="font-size:18px"> اجمالي المتاح تحويله للمندوبين : </span>
            <span> {{$available_agent_balances}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong>
            -
            <span style="font-size:18px"> اجمالي الخزينه : </span>
            <span > {{$Treasure}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم الشركه</th>
                <th scope="col">الرصيد</th>
                <th scope="col">التاريخ</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
            @foreach( $AmwalBalances as $row )
                <tr class="amwal-{{$row->id}}">
                    <td>{{$row->id}}</td>
                    <td>{{$row->company ? $row->company->name : ''}}</td>
                    <td>{{$row->Balance}}</td>
                    <td>{{$row->created_at}}</td>
                </tr>
            @endforeach
            <tr class="amwal-{{$row->id}}" style="background-color: black;color: white">
                <td> </td>
                <td><strong style="color: white">الاجمالي</strong></td>
                <td><strong style="color: white"> {{ $amwal_balances }}</strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>