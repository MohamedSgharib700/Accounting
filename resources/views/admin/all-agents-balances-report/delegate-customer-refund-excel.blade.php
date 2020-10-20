<table class="table text-center pos-table">
    <thead class="mainHead" >
    <tr>
        <th scope="col">كود المندوب </th>
        <th scope="col">اسم المندوب </th>
        <th scope="col">اسم العميل </th>
        <th scope="col">رقم الماكينه </th>
        <th scope="col">القيمه</th>
        <th scope="col">التاريخ</th>
    </tr>
    </thead>
    <tbody>

    @foreach($balances as $row)
        <tr class="pos-{{$row->id}}">
            <td>{{$row->CreatedBy? $row->CreatedBy->user_code: ''}}</td>
            <td>{{$row->CreatedBy? $row->CreatedBy->name: ''}}</td>
            <td>{{$row->clients? $row->clients->name: ''}}</td>
            <td>{{$row->pos? $row->pos->serial: ''}}</td>
            <td>{{$row->money? $row->money: ''}}</td>
            <td>{{$row->created_at}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="pos" style="background-color: black ; color: white">
        <td></td>
        <td></td>
        <td></td>
        @isset($sum)<td >{{$sum}}</td>@endisset
        <td colspan="2">الاجمالي</td>
    </tr>
    </tbody>
</table>
