<table class="table text-center pos-table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">رقم الماكينه</th>
                            <th scope="col">رقم الهاتف</th>
                            <th scope="col">رقم العمليه</th>
                            <th scope="col">اسم الخدمه</th>
                            <th class="text-center whitespace-no-wrap"> اسم الشركه</th>
                            <th scope="col">التاريخ</th>
                            <th scope="col">القيمه</th>
                            <th scope="col">الرسوم</th>
                            <th scope="col">العموله</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $row)
                            <tr class="pos-{{$row->id}}">
                                <td>{{$row->pos->user->name}}</td>
                                <td>{{$row->pos->serial}}</td>
                                <td>{{$row->user_service_number}}</td>
                                <td>{{$row->operation_id}}</td>
                                <td>{{$row->service? $row->service->name: ''}}</td>
                                <td>{{$row->company? $row->company->name: ''}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->value}}</td>
                                <td>{{$row->fees ? $row->fees: ''}}</td>
                                <td>{{$row->commissions ? $row->commissions: ''}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>