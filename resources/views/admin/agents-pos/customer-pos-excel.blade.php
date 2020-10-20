<table class="table text-center pos-table">
    <thead class="thead-light">

    <tr>
        <th scope="col">اسم العميل</th>
        <th scope="col">كود العميل</th>
        <th scope="col">رقم الماكينه</th>
        <th scope="col">رمز التفعيل</th>
        <th scope="col">رقم سيريال الشريحه</th>
        <th scope="col">رقم شريحه الماكينه</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pos as $row)
        <tr class="pos-{{$row->id}}">
            <td>{{$row->customer ? $row->customer->name: ''}}</td>
            <td>{{$row->customer ? $row->customer->user_code: ''}}</td>
            <td>{{$row->serial}}</td>
            <td>{{$row->machine_code}}</td>
            <td>{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</td>
            <td>{{$row->sim_card ? $row->sim_card: ''}}</td>
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
        <td colspan="2">العدد</td>
        @isset($count)<td >{{$count}}</td>@endisset
    </tr>
    </tbody>
</table>
