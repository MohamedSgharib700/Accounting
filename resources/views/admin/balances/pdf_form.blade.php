
         
         <h2> Device data </h2>
         <hr>
          <strong>Username: </strong> {{$device->user->name}} <br>
            <strong>Machine code: </strong> {{$device->machine_code}} <br>
            <strong>Status: </strong> @if($device->active == 1) Active @else Unactive @endif <br>

        -------------------------------------------------------------------------------------------------
        <br><strong>All charges :</strong><br>
        
        
          <table class="table table-striped" border="1">
          
            <thead>
            <tr>
              <th>Supervisor</th>
              <th>Value</th>
              <th>Date</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($device->balances as $transactions)
            <tr>
              <td>{{$transactions->supervisor}}</td>
              <td>{{$transactions->charge_value}}</td>
              <td>{{$transactions->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
            <strong>total charges: {{$device->balances->sum('charge_value')}}</strong>  <br> 
          </table>