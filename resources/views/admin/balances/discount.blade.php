@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->


<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> خصم رصيد للمندوب
    </h1>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
    @endif
</div>
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10 content-holder" style="text-align:center; margin:auto;width:60%">
    <form role="form" action="{{route('discount.action')}}" method="post">
        @csrf
      
        <div class=""style="display: flex;flex-wrap: wrap;justify-content: space-around;align-items: center;">
            <div class="">
                <label>القيمه المضافه للمندوب </label>
                <input type="text" class="input w-full border mt-2 col-span-4" name="balance" placeholder=" ادخل القيمة"
                    style="height:38px">
            </div>
            <div class="">
                <label>اضافة المندوب</label>
                <div class="mt-2">
                    <select class="select2 w-full " name="agent_id">
                        @foreach($agents as $agent)
                        <option value='{{$agent->id}}'>{{$agent->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>

        <input type="hidden" class="form-control" value="0" name="type">
        <input type="hidden" class="form-control" value="{{auth()->user()->id}}" name="supervisor">

        <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-9 text-white my-10">خصم الرصيد</button>
    </form>

</div>








@stop

@section('script')