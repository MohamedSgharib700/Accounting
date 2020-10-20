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
            <td>{{$row->delegate? $row->delegate->user_code: ''}}</td>
            <td>{{$row->delegate? $row->delegate->name: ''}}</td>
            <td>{{$row->customer? $row->customer->name: ''}}</td>
            <td>{{$row->pos? $row->pos->serial: ''}}</td>
            <td>{{$row->value? $row->value: ''}}</td>
            <td>{{$row->created_date}}</td>
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
