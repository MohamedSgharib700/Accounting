<table class="table text-center agents-table">
                    <thead class="thead-light">

                    <tr>
                        <th>اسم المندوب </th>
                        <th> قيمة التحويل </th>
                        <th>تاريخ التحويل</th>
                        


                    </tr>
                    </thead>
                    <tbody>
                    @if($transfers)
                    @foreach( $transfers as $transfer )
                        <tr>
                            <td>{{$transfer->user ? $transfer->user->name:''}}</td>
                            <td>{{$transfer->value}}</td>
                            <td>{{$transfer->created_at}}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>