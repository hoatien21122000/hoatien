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
          <a href="{{ route('subject_management.subject_insert') }}"><i class="fas fa-plus-circle"> </i>New Insert</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1">
            <table class="table table-">
               <tr style="text-align:center; background :#0099FF; color:white;">
                  <th>Subject Id</th>
                  <th>Subject Name</th>
                  <th>Edit</th>
               </tr>
               @foreach($arr_subject as $each)
               <tr>
                  <td style="text-align:center; ">{{$each->subject_id}}</td>
                  <td style="padding-left:250px;">{{$each->subject_name}}</td>
                  <td style="text-align:center; "><a href="{{ route('subject_management.subject_update',['subject_id' =>$each->subject_id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
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
            $('#subject_management').addClass('active');
        });
    </script>
@endpush