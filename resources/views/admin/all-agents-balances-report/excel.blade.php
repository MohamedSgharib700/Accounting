<table class="table text-center pos-table">
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
    @isset($balances)
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
    @endisset
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="pos" style="background-color: black ; color: white">
        <td></td>
        <td></td>
        <td colspan="2">الاجمالي</td>
        @isset($sum)<td >{{$sum}}</td>@endisset
    </tr>
    </tbody>
</table>