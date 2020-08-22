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
            <a href="{{ route('academic_year_management.academic_year_insert') }}"><i class="fas fa-plus-circle"> </i>New Insert</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1">
            <table class="table table-">
               <tr style="text-align:center; background :#0099FF; color:white;">
                  <th>Academic Year Id</th>
                  <th>Academic Year Name</th>
                  <th>Edit</th>
               </tr>
               @foreach($arr_academic_year as $each)
               <tr>
                  <td style="text-align:center; ">{{$each->academic_year_id}}</td>
                  <th style="padding-left:300px;">{{$each->academic_year_name}}</th>
                  <td style="text-align:center;"><a href="{{ route('academic_year_management.academic_year_update',['academic_year_id' =>$each->academic_year_id]) }}"><i class="fas fa-pencil-alt"></a></td>
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
            $('#academic_year_management').addClass('active');
        });
    </script>
@endpush