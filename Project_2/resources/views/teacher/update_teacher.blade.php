
@extends('layout')
@section('content')

<section class="content" style="margin-left:200px">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <!-- jquery validation -->
                        <div class="card card-primary">
                        <!-- form start -->
                            <form id="quickForm" method="post" action="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @foreach ($arr_teacher as $each)
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Teacher Name:</label>
                                                <input type="text" name="teacher_name" class="form-control" value="{{ $each->teacher_name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number:</label>
                                                <input type="text" name="teacher_phone_number" class="form-control" value="{{ $each->teacher_phone_number }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sex:</label>
                                                <input type="radio" name="sex" checked value="0"
                                                @if($each->sex == 0){
                                                    "checked";
                                                };
                                                @endif>Male
                                                <input type="radio" name="sex" value="1"
                                                @if($each->sex == 1){
                                                    "checked";
                                                };
                                                @endif>Female
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address:</label>
                                                <input type="text" name="address" class="form-control" value="{{ $each->address }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Date of Birth:</label>
                                                <input type="date" name="date_of_birth" class="form-control" value="{{ $each->date_of_birth }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email:</label>
                                                <input type="text" name="email" class="form-control" value="{{ $each->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password:</label>
                                                <input type="text" name="password" class="form-control" value="{{ $each->password }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                    <button class="btn btn-primary">Edit</button>
                                    </div>
                            </form>
                    </div>
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