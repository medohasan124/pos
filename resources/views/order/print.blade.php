<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">


<style>
  .head{background: #fff ;    padding: 20px 0px;}
  .logo{
        width: 180px;
  }
  ul{
    margin-top: 31px;
  }
 ul  li{
        font-size: 20px;
    font-weight: 200;
  }

  .totalNumber{
        font-size: 59px;
    color: #007bff;
    font-weight: 200;
  }
</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class='head'>
  <div class="container">

    <div class='row head'>
      <div class='col-6'><img class='img-fluid logo' src='{{asset("upload/settings/").'/'.$settings->logo}}'></div>
      <div class='col-3'>
        <ul class='list-unstyled head-list'>
          <li>{{$settings->sitename_en}}</li>
          <li>{{$settings->sitename_ar}}</li>
          <li>{{$settings->email}}</li>
          
        </ul>
      </div> 
      <div class='col-3'>
        <ul class='list-unstyled'>
          <li>{{$settings->phone1}}</li>
          <li>{{$settings->phone2}}</li>
          <li>{{$settings->description}}</li>
          
        </ul>
      </div>
    </div>
  </div>

  </div>

  <div class='client_info'>
    <div class='container'>
      <div class='row'>
        <div class='col-4'>
          <h6>@lang('user.client_info')</h6>
          <ul class='list-unstyled'>
            <li>name:<strong>{{$client->username}}</strong></li>
            <li>number:<strong>{{$client->number}}</strong></li>
            <li>location:<strong>{{$client->location}}</strong></li>
            <li>email:<strong>{{$client->email}}</strong></li>
          </ul>
        </div>

        <div class='col-2'>
          <h6>ORDER NUMBER</h6>
          <ul class='list-unstyled'>
            <li><strong>0000/{{$order[0]->order_id}}</strong></li>
            <li>Date</li>
            <li><strong>{{$order[0]->created_at}}</strong></li>
           
          </ul>
        </div>
        <div class='col-6 text-right'>
          <div class='total'>
            <h1 class='totalNumber'>{{number_format($totalAll , 2)}}</h1>
            <p>جنية مصري</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <div class='item'>
    <div class='container'>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">code</th>
      <th scope="col">@lang('user.item_name')</th>
      <th scope="col">@lang('user.item_count')</th>
      <th scope="col">@lang('user.price')</th>
      <th scope="col">@lang('user.total')</th>
      <th scope="col">@lang('user.active')</th>
     
    </tr>
  </thead>
  <tbody>
    
     @foreach($item as $index => $row)
     <tr>

      <td>{{$index + 1}}</td>
      <td>{{$row->name_ar}}</td>
      <td>{{$row->name_ar}}</td>
       <td>{{$row->item_count}}</td>
       <td>{{$row->item_price}}</td>
       <td>{{$row->price}}</td>
     
     
      <td>
        
        @if($row->active == 0)
          <div class='badge badge-warning'>@lang('user.wait')</div>
          @endif

          @if($row->active == 1)
          <div class='badge badge-success'>@lang('user.active')</div>
          @endif

          @if($row->active == 2)
          <div class='badge badge-danger'>@lang('user.back')</div>
          @endif
      </td>

    </tr>
     @endforeach
    
  </tbody>
</table>


<div class='row'>
        <div class='col-6 text-right '>
        
        <div class="card" style="width: 18rem;">
        <div class="card-header">
          <h2 class='h4'>@lang('user.info')</h2>
        </div>

        
        
        <ul class="list-group list-group-flush ">
          <li class="list-group-item"><strong>@lang('user.item_count')</strong> :{{$sumitem}}
            
          </li>

          <li class="list-group-item"><strong>@lang('user.active')</strong> :{{$somorderOk}}
            
          </li>

          <li class="list-group-item"><strong>@lang('user.back')</strong> :{{$somorderBack}}
            
          </li>

           <li class="list-group-item"><strong>@lang('user.total')</strong> :{{$sumTotal}}
            
          </li>


          
         
        </ul>
      </div>

      </div>

  </div>

    </div>
  </div>

</body>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/js/printThis.js')}}"></script>

<script >
  

$('body').printThis({
  afterPrint: true
});

afterPrint();


</script>
</body>
</html>
