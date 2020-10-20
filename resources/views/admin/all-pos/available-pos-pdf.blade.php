
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
        <h2>التقرير اليومي لشركه اموال خاص بجميع الماكينات الغير مفعله  </h2>
        <hr>
        <br><br>
    </div>
</div>
<div class="row">
    <div class="table-holder table-responsive">
        <table class="table text-center revenues-table">
            <thead class="thead-light">
            <tr>
                <th scope="col">اسم المندوب </th>
                <th scope="col">كود المندوب </th>
                <th scope="col">رقم الماكينه</th>
                <th scope="col">رمز التفعيل</th>
                <th scope="col">رقم سيريال الشريحه</th>
                <th scope="col">رقم شريحه الماكينه</th>
            </tr>
            </thead>
            <tbody>

            @foreach($pos as $row)
                <tr class="pos-{{$row->id}}">
                    <td>{{$row->user ? $row->user->name: ''}}</td>
                    <td>{{$row->user ? $row->user->user_code: ''}}</td>
                    <td>{{$row->serial}}</td>
                    <td>{{$row->machine_code}}</td>
                    <td>{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</td>
                    <td>{{$row->sim_card ? $row->sim_card: ''}}</td>
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
                    <td><strong > {{ $count }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div >
            <br><br>
            <strong > توقيع رئيس الشركه</strong>
            <br><br>
            <strong > -----------------------</strong>
        </div>
    </div>


    </body>
    </html>




