<table class="table text-center agents-table">
                        <thead class="thead-light">

                            <tr>
                                <th>اسم المندوب</th>
                                <th>اسم التاجر</th>
                                <th>رقم المكنة </th>
                                <th>نوع القسط </th>
                                <th>القيمة</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $installments as $installment )
                            <tr>
                                <td>{{$installment->agent ? $installment->agent->name : ''}}</td>
                                <td>{{$installment->customer? $installment->customer->name : ''}}</td>
                                <td>{{ $installment->pos->machine_code ? $installment->pos->machine_code : '' }}</td>
                                <td>{{$installment->Contract? $installment->Contract->name : ''}}</td>
                                <td>{{$installment->value}}</td>
                                @if($installment->status == 0)
                                <td>غير مدفوع</td>
                                @else
                                <td>تم الدفع </td>
                                @endif
                                <td>{{$installment->created_at}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>