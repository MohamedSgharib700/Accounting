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
<div class="header-holder " style="padding:30px;border-raduis:5px; text-align: center">
    <img src="../public/dist/images/logo.png"  width="200px" class="img-fluid" >
</div>
<br><br>
<div class="row">
    <div class="col-md-12" style="text-align: center">
       <h2>تقرير العمولات</h2>
        <hr>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <strong>
            -
            <span style="font-size:18px"> اجمالي   العمولات : </span>
            <span> {{number_format($sum, 1, '.', '')}}</span>
        </strong>
        <br><br><br>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table">
            <thead class="thead-light">
            <tr>

                            <th scope="col">رقم الماكينه</th>
                            <th scope="col"> المندوب</th>
                            <th scope="col"> العميل</th>                           
                            <th scope="col">  العموله</th>
                            <th scope="col">  التاريخ</th>
                        </tr>
            </thead>
            <tbody>
            <tbody>
            @foreach($commissions as $row)
                            <tr class="pos-{{$row->id}}">
                            <td>{{$row->pos ? $row->pos->serial: ''}}</td>
                            <td>{{$row->pos->user ? $row->pos->user->name: ''}}</td>
                            <td>{{$row->pos->customer ? $row->pos->customer->name: ''}}</td>
                            <td>{{number_format($row->commission, 1, '.', '')}}</td>
                            <td>{{$row->date ? $row->date: ''}}</td>
                            </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>