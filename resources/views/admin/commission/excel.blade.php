<table class="table text-center pos-table">
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
