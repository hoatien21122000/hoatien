@extends('layout')
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<br /><br />
  <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="{{ route('pathway_management.pathway_insert') }}"><i class="fas fa-plus-circle"> </i> Add a New Major</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1">
            <table class="table table-" >
               <tr style="text-align:center; background :#0099FF; color:white;">
                  <th>Major Id</th>
                  <th>Major Name</th>
                  <th>Edit</th>
               </tr>
               @foreach($arr_pathway as $each)
               <tr>
                  <td style="text-align:center; ">{{$each->pathway_id}}</td>
                  <td style="padding-left:250px;"><b>{{$each->pathway_name}}</b></td>
                  <td style="text-align:center;" ><a href="{{ route('pathway_management.pathway_update',['pathway_id' =>$each->pathway_id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
               </tr>
               @endforeach
            </table>
          </div>
        </div>
      </div>
  </section>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#li_manage_list').addClass('menu-open');
            $('#manage_list').addClass('active');
            $('#pathway_management').addClass('active');
        });
    </script>
@endpush
