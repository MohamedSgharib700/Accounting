<!DOCTYPE html>
<html dir="rtl">


<body style="font-family: 'Riyaz', sans-serif; direction: rtl ">
    <div class="header-holder " style="background:#410156;padding:30px;border-raduis:5px;">
        <span class="text-center font-weight-bold" style="color:#fff; margin:auto;font-size:25px;"> 
        </span>
        <img src="../public/dist/img/logo.png" class="img-fluid" style="float:right">

    </div>

    <ul class="list-unstyled">
        <li><span style="font-weight:600;color:#000;font-size:22px"> اجمالي الارصدة المحولة للمناديب : </span>
            {{$agent_balance}} </li>
        <li><span style="font-weight:600;color:#000;font-size:22px"> اجمالي  رصيد المندوبين الحالي:
            </span>{{$allagentsCurrentBallance}} </li>
        <li><span style="font-weight:600;color:#000;font-size:22px">اجمالي المبلغ المطلوب تحصيله من المناديب:
            </span>{{$allCustomersCurrentBallance}} </li>
    </ul>
    _______________________________________________________________________________

    <br>
    <h3 style="color:#000; font-size:30px" class="text-center">معاملات المناديب: </h3><br>

    <section class="container ">
        <div class="table-holder table-responsive">
            <table class="table text-center pos-table py-5" style="margin:auto;">
                <style>
                table {
                    color: #000;
                    text-align:center;
                    background:#ddd;
                    padding:15px 10px;

                }
                table tr{
                    border:1px solid #333

                }
                thead{
                    background-color:#000
                }


                table tr th {
                    color: #000;
                    padding:25px 0;
                }
                td{
                    color:#000;
                    font-size:18px;
                    padding:10px 0
                }
                li{
                    font-size:17px
                }
                </style>
                <thead >
                    <tr style="color:#000">
                        <th>#</th>
                        <th>اسم المندوب</th>
                        <th>جميع الارصدة المحولة للمندوب</th>
                        <th>رصيد المندوب الحالي</th>
                        <th>    المطلوب تحصيله من المندوب </th>
                        <th>كود المندوب</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach( $users as $user )
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td><a class="btn btn-primary btn-amwal-2 "
                               >{{$user->balance->sum('balance')}}  </a>
                        </td>
                        <td>
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
                            <a class="btn btn-primary btn-success ">
                                {{ $AgentCurrentBalance}} </a>
                        </td>

                        <td>
                            <a class="btn btn-primary btn-danger "
                               >{{ $AgentBalance }}
                            </a>
                        </td>

                        <td><a class="btn btn-primary btn-amwal-2 "
                               >{{$user->user_code}}</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>
</body>

</html>