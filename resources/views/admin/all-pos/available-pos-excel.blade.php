<table class="table text-center pos-table">
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
