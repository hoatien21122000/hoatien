@extends('layout')
@section('content')
<br /><br />
  <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="{{ route('teacher_management.teacher_insert') }}"><i class="fas fa-plus-circle"> </i>Add new Teacher</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1">
            <table class="table table-">
               <tr style="background :#0099FF; color:white;">
                  <th>Teacher Name</th>
                  <th>Phone Number</th>
                  <th>Sex</th>
                  <th>Address</th>
                  <th>Date of Birth</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Edit</th>
               </tr>
               @foreach($arr_teacher as $each)
               <tr>
                  <td>{{$each->teacher_name}}</td>
                  <td>{{$each->teacher_phone_number}}</td>
                  <td>
                      @if($each->sex == 0)
                      {{'Male'}}
                      @else
                      {{'Female'}}
                      @endif
                  </td>
                  <td>{{$each->address}}</td>
                  <td>{{$each->date_of_birth}}</td>
                  <td>{{$each->email}}</td>
                  <td>{{$each->password}}</td>
                  <td><a href="{{ route('teacher_management.teacher_update',['email' =>$each->email]) }}"><i class="fas fa-pencil-alt"></i></a></td>
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
            $('#teacher_management').addClass('active');
        });
    </script>
@endpush


