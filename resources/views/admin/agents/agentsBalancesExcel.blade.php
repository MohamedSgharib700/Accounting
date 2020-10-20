<table class="table text-center agents-table">
                <thead class="thead-light">

                    <tr>
                        <th>#</th>
                        <th>اسم المندوب</th>
                        <th>جميع الارصدة المحولة للمندوب</th>
                        <th>رصيد المندوب الحالي</th>
                        <th>    المطلوب تحصيله من المندوب </th>
                        <th>جميع المكينات الخاصة بالمندوب</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach( $agents as $user )
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->balance->sum('balance')}}</td>
                        <td class="btn btn-primary btn-success ">
                        @php
                           $getallmoneysendtoagent = $user->balance->where('type' , 1)->sum('balance');
                           $getallmoneysendTobank =  $user->TransferCreditToCustomer->sum('value');
                           $getallmoneysendTocustomer =  $user->TransferCreditFromDelegateToCustomers->sum('money');
                           $getallmoneyrefundedfromAgent =  $user->RefundMoneyFromClientToDelegates->sum('value');
                           $discountsForAgent = App\Models\AgentBalance::where('agent_id', $user->id)->where('type' , 0)->sum('balance');
                           $discountsfinally = $discountsForAgent * -1 ;
                           $AgentCurrentBalance = $getallmoneysendtoagent - $discountsfinally- $getallmoneysendTocustomer + $getallmoneyrefundedfromAgent  ;

                           $AgentBalance = $getallmoneysendtoagent - $discountsfinally- $getallmoneysendTobank  ;

                        @endphp
                         {{ $AgentCurrentBalance}}
                        </td>
                        <td >
                          {{ $AgentBalance }} 
                        </td>
                        <td >
                          الماكينات({{$user->pos->count()}})
                        </td>


                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>