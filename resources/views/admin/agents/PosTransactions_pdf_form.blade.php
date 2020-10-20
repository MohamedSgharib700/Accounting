<!DOCTYPE html>
<html dir="rtl">


<body style="font-family: 'Riyaz', sans-serif; direction: rtl ">
    <div class="header-holder " style="background:#410156;padding:30px;border-raduis:5px;">
        <span class="text-center font-weight-bold" style="color:#fff; margin:auto;font-size:25px;"> 
        </span>
        <img src="../public/dist/images/logo.png" class="img-fluid" style="float:right">

    </div>

    <ul class="list-unstyled">
    <li ><span style="font-weight:600;color:#000;font-size:22px">اسم المندوب : </span>  {{$device->user->name}}  </li>
    <li ><span style="font-weight:600;color:#000;font-size:22px">كود المندوب : </span>  {{$device->user->user_code}}  </li>
    <li><span  style="font-weight:600;color:#000;font-size:22px">رقم الماكينة: </span>{{$device->serial}} </li>
    <li><span  style="font-weight:600;color:#000;font-size:22px">الحالة: </span>@if($device->active == 1) مفعل @elseغير مفعل @endif </li>
    </ul>
    _______________________________________________________________________________

    <br>
    <h3 style="color:#000; font-size:30px" class="text-center">معاملات المناديب: </h3><br>

    <section class="container ">
        <div class="table-holder table-responsive">
            <table class="table text-center pos-table py-5" style="margin:auto;">
                <style>
                table {
                    color: #000;
                    text-align:center;
                    background:#ddd;
                    padding:15px 10px;

                }
                table tr{
                    border:1px solid #333

                }
                thead{
                    background-color:#000
                }


                table tr th {
                    color: #000;
                    padding:25px 0;
                }
                td{
                    color:#000;
                    width: 160px;
                    font-size:18px;
                    padding:10px 0
                }
                li{
                    font-size:17px
                }
                </style>
                <thead>
                    <tr style="color:#000">
                        <th scope="col">رقم العميل</th>
                                <th scope="col">اسم الخدمه</th>
                                <th scope="col">القيمه</th>
                                <th scope="col">الرسوم</th>
                                <th scope="col">التاريخ</th>
                                <th scope="col">العموله</th>
                                <th scope="col">رقم الماكينة
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($device->transactions as $transaction)
                        <tr>
                        <td>{{$transaction->user_service_number}}</td>
                        <td>{{$transaction->service? $transaction->service->name: ''}}</td>
                        <td>{{$transaction->value}}</td>
                        <td>{{$transaction->fees ? $transaction->fees: ''}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td>{{$transaction->commissions ? $transaction->commissions: ''}}</td>
                        <td>{{$transaction->Pos->serial? $transaction->Pos->serial: ''}}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>
</body>

</html>