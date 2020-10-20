<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

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
<body>
<div class="header-holder " style="background:#410156;padding:30px;border-raduis:5px;">
&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<span class="text-center font-weight-bold" style="color:#fff; margin:auto;font-size:25px;"> تقرير المندوب</span>
<img src="../public/dist/img/logo.png" class="img-fluid" style="float:right">

</div>

<ul>
<li><span>اسم المندوب : </span>{{$agent->name}} </li>
    <li><span>الرصيد المتاح للمندوب : </span>{{$availableBalance}} </li>
    <li><span>الرصيد المطلوب منه : </span>{{$requiredBalance}}</li>
</ul>
_______________________________________________________________________________

<br><h3 align="center" style="color:#410156; font-size:30px">الارصده المحوله للمندوب </h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$agent_balance}} </li>
            </ul>
<section class="container" >
    <div>
        <table>

            <thead>
                <tr>
                    <th>القيمة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>

              @foreach($balances as $row)
                <tr class="pos-{{$row->id}}">
                    <td>{{$row->balance}}</td>
                    <td>{{$row->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
             <br> 
        </table>
    </div>
</section>

----------------------------------------------------------------------------------------------------------------------------------------------

<br><h3 align="center" style="color:#410156; font-size:30px">الارصده المخصمة للمندوب</h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$discountsForAgent}} </li>
            </ul>

<section class="container" >
    <div align="right" class="table-holder table-responsive">
        <table  style="margin:auto;">

            <thead class="mainHead" >
                <tr>
                    <th>القيمة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>

                @foreach($discounts as $row)
                    <tr class="pos-{{$row->id}}">
                        <td>{{$row->balance}}</td>
                        <td>{{$row->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
             <br>
        </table>
    </div>
</section>

----------------------------------------------------------------------------------------------------------------------------------------------

<br><h3 align="center" style="color:#410156; font-size:30px">الارصدة التي تم تحويلها للعملاء :</h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$customer_balance}} </li>
            </ul>

<section class="container" >
    <div align="right" class="table-holder table-responsive">
        <table  style="margin:auto;">

            <thead class="mainHead" >
                <tr>
                    <th>اسم العميل</th>
                    <th>رقم الماكينة</th>
                    <th>القيمة</th>
                    <th>التاريخ</th>
                    <th>الملاحظات</th>
                </tr>
            </thead>
            <tbody>

             @foreach($customer_balances as $row)
                <tr class="pos-{{$row->id}}">
                    <td>{{$row->clients? $row->clients->name: ''}}</td>
                    <td>{{$row->pos? $row->pos->serial: ''}}</td>
                    <td>{{$row->money? $row->money: ''}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->notes}}</td>
                </tr>
            @endforeach
            </tbody>
             <br>
        </table>
    </div>
</section>

----------------------------------------------------------------------------------------------------------------------------------------------

<br><h3 align="center" style="color:#410156; font-size:30px">الارصدة التي تم تحويلها للمندوب من العميل  :</h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$customer_delegate_balance}} </li>
            </ul>

<section class="container" >
    <div align="right" class="table-holder table-responsive">
        <table  style="margin:auto;">

            <thead class="mainHead" >
            <tr>
                                <th scope="col">اسم العميل </th>
                                <th scope="col">رقم الماكينه </th>
                                <th scope="col">القيمه</th>
                                <th scope="col">التاريخ</th>
                            </tr>
            </thead>
            <tbody>

            @foreach($customer_delegate_balances as $row)
                                <tr class="pos-{{$row->id}}">
                                    <td>{{$row->customer? $row->customer->name: ''}}</td>
                                    <td>{{$row->pos? $row->pos->serial: ''}}</td>
                                    <td>{{$row->value? $row->value: ''}}</td>
                                    <td>{{$row->created_date}}</td>
                                
                                </tr>
             @endforeach
            </tbody>
             <br>
        </table>
    </div>
</section>
----------------------------------------------------------------------------------------------------------------------------------------------
<br><h3 align="center" style="color:#410156; font-size:30px">الارصدة التي تم ايداعها للبنك :</h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$bank_balance}} </li>
            </ul>

<section class="container" >
    <div align="right" class="table-holder table-responsive">
        <table  style="margin:auto;">

            <thead class="mainHead" >
                <tr>
                    <th scope="col">رقم العمليه</th>
                    <th scope="col">الرصيد</th>
                    <th scope="col">التاريخ</th>
                </tr>
            </thead>
            <tbody>

            @foreach($bank_balances as $row)
                <tr class="pos-{{$row->id}}">
                    <td>{{$row->number_order}}</td>
                    <td>{{$row->value}}</td>
                    <td>{{$row->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
             <br>
        </table>
    </div>
</section>

----------------------------------------------------------------------------------------------------------------------------------------------

<br><h3 align="center" style="color:#410156; font-size:30px">الارصدة التي تم ايداعها للخزينة:</h3><br>
<ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> الاجمالي  : </span>
            {{$agent_expenses_balances}} </li>
            </ul>

<section class="container" >
    <div align="right" class="table-holder table-responsive">
        <table  style="margin:auto;">

            <thead class="mainHead" >
                <tr>
                <th scope="col">#</th>
                    <th scope="col">اسم المسجل</th>
                    <th scope="col">اسم المندوب</th>
                    <th scope="col">نوع الايراد</th>
                    <th scope="col">القيمه</th>
                    <th scope="col">البيان</th>
                    <th scope="col">التاريخ</th>
                </tr>
            </thead>
            <tbody>

            @foreach($revenues as $row)
                            <tr class="revenue-{{$row->id}}">
                                <td>{{$row->id}}</td>
                                <td>{{$row->user ? $row->user->name : ''}}</td>
                                <td>{{$row->agent ? $row->agent->name : ''}}</td>
                                <td>{{$row->category ? $row->category->name : ''}}</td>
                                <td>{{$row->value ? $row->value: ''}}</td>
                                <td>{{$row->notes ? $row->notes: ''}}</td>
                                <td>{{$row->created_at ? $row->created_at : ''}}</td>
                            </tr>
                        @endforeach
            </tbody>
             <br>
        </table>
    </div>
</section>
</body>
</html>