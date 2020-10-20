@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      View charge operations for this device
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <!-- <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div> -->

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-fax"></i> Device data
            <small class="pull-right">Date: {{$device->created_at}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Username: </strong> {{$device->user->name}} <br>
            <strong>Machine code: </strong> {{$device->machine_code}} <br>
            <strong>Status: </strong> @if($device->active == 1) Active @else Unactive @endif <br>
          </address>
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
       
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
         <p class="lead">Charge operations</p>
          <table class="table table-striped">
            <thead>
            <tr>
              
              <th>Charge Value</th>
              <th>Supervisor</th>
              <th>Date</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($device->balances as $transactions)
            <tr>
              <td>{{$transactions->charge_value}}</td>
              <td>{{$transactions->supervisor}}</td>
              <td>{{$transactions->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-download"></i><a style="color:white;" href="{{route('exportexcel.balances' , $device->id)}}" > Download excel file </a>
          </button>
          <button type="button" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i><a style="color:white;" href="{{route('exportpdf.balances' , $device->id)}}" > Download pdf file </a>
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper --><!-- Content Wrapper. Contains page content -->
 
@stop
