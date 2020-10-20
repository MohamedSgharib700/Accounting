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
        <h2>التقرير اليومي لشركه اموال خاص بتحويل ارصده المندوبين  </h2>
        <hr>
        <br><br>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table">
            <thead class="thead-light">
            <tr>
                <th scope="col">رقم المندوب</th>
                <th scope="col">اسم المندوب</th>
                <th scope="col">رقم الهاتف</th>
                <th scope="col">البريد الالكتروني</th>
                <th scope="col">الرصيد</th>
                <th scope="col">التاريخ</th>
                <th scope="col">النوع</th>
            </tr>
            </thead>
            <tbody>
            @foreach($balances as $row)
                <tr class="pos-{{$row->id}}">
                    <td>{{$row->agent_id}}</td>
                    <td>{{$row->user->name}}</td>
                    <td>{{$row->user->phone}}</td>
                    <td>{{$row->user->email}}</td>
                    <td>{{$row->balance}}</td>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->type==1?'تحويل':'خصم'}}</td>
                </tr>
            @endforeach
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
                <td><strong > {{ $sum }}</strong></td>
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