
<table class="table text-center agents-table">
    <thead class="thead-light">

    <tr>
        <th>#</th>
        <th>اسم المندوب</th>
        <th>جميع الارصدة المحولة للمندوب</th>
        <th>رصيد المندوب الحالي</th>
        <th>    المطلوب تحصيله من المندوب </th>
    </tr>
    </thead>
    <tbody>
    @foreach( $agents as $user )
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->balance()->whereDate('created_at','<=',$date)->sum('balance')}} </td>
            <td class="btn btn-primary btn-success ">
                @php
                    $getallmoneysendtoagent = $user->balance()->whereDate('created_at','<=',$date)->where('type' , 1)->sum('balance');
                    $getallmoneysendTobank =  $user->TransferCreditToCustomer()->whereDate('created_at','<=',$date)->sum('value');
                    $getallmoneysendTocustomer =  $user->TransferCreditFromDelegateToCustomers()->whereDate('created_at','<=',$date)->sum('money');
                    $getallmoneyrefundedfromAgent =  $user->RefundMoneyFromClientToDelegates()->whereDate('created_at','<=',$date)->sum('value');
                    $discountsForAgent = App\Models\AgentBalance::where('agent_id', $user->id)->whereDate('created_at','<=',$date)->where('type' , 0)->sum('balance');
                    $discountsfinally = $discountsForAgent * -1 ;
                    $AgentCurrentBalance = $getallmoneysendtoagent - $discountsfinally- $getallmoneysendTocustomer + $getallmoneyrefundedfromAgent  ;

                    $AgentBalance = $getallmoneysendtoagent - $discountsfinally- $getallmoneysendTobank  ;

                @endphp
                {{ $AgentCurrentBalance}}
            </td>
            <td >
                {{ $AgentBalance }}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>
