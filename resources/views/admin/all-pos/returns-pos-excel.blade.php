<table class="table text-center pos-table">
    <thead class="thead-light">

    <tr>
        <th scope="col">اسم المندوب </th>
        <th scope="col">كود المندوب </th>
        <th scope="col">اسم العميل</th>
        <th scope="col">رقم الماكينه</th>
        <th scope="col">رمز التفعيل</th>
        <th scope="col">رقم سيريال الشريحه</th>
        <th> تاريخ التفعيل</th>
        <th> تاريخ الاسترجاع</th>
        <th scope="col">  اجمالي العمليات</th>
        <th scope="col">رقم شريحه الماكينه</th>
        <th scope="col">  نوع البيع</th>
        <th scope="col">  رصيد المكينة الحالي</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pos as $row)
        <tr class="pos-{{$row->id}}">
            <td>{{$row->user ? $row->user->name: ''}}</td>
            <td>{{$row->user ? $row->user->user_code: ''}}</td>
            <td>{{$row->customer ? $row->customer->name: ''}}</td>
            <td>{{$row->serial}}</td>
            <td>{{$row->machine_code}}</td>
            <td>{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</td>
            <td>{{$row->customer ? $row->customer->created_at: ''}}</td>
            <td>{{$row->updated_at ? $row->updated_at: ''}}</td>
            <td> {{ ($row->transactions()->sum('value')) }}</td>
            <td>{{$row->sim_card ? $row->sim_card: ''}}</td>
            <td>{{$row->installments->first->value ? $row->installments->first->value->contract->name : ''}}</td>
            <td>
                 <a class="show-transactions  btn  btn-amwal-2" >
                 @php
                 $TransferCredit = $row->TransferMoneyFromDelegateToPos->sum('money');
                 $transaction = $row->transactions->sum('value');
                 $commissions = $row->commissions->sum('commission');
                 $refundMoney=$row->refundMoney()->whereDate('created_at','>=','2020-09-14')->sum('value');
                 @endphp 
                 {{$TransferCredit - $transaction -$refundMoney  +$commissions}}
                                        
               </a>
       </td>
        </tr>
    @endforeach

    </tbody>
</table>
