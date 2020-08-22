@extends('layout')
@section('content')
@if(count($errors) > 0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{$err}}<br>
			@endforeach
		</div>
@endif
<section class="content" style="margin-left:200px">
      <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <!-- jquery validation -->
                        <div class="card card-primary">
                        <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>Update Student</h4></div>
                        <!-- form start -->
                            <form id="quickForm" method="post" action="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @foreach ($arr_student as $each)
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student Id:</label>
                                                <input type="number" name="student_id" class="form-control" value="{{ $each->student_id }}" readonly="readonly">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Class:</label>
                                                <!-- <input type="text" name="class_id" class="form-control" value="{{ $each->class_id}}"> -->
                                                <Select class="form-control" name="class_id" id="choose_class">
                                                    <option value="0">-----Choose Class-----</option>
                                                    @foreach($arr_class as $each_class)
                                                        <option value="{{$each_class->class_id}}"
                                                        @if($each_class->class_id == $each->class_id)
                                                            selected
                                                        @endif
                                                        >
                                                            {{$each_class->class_name}}
                                                        </option>
                                                    @endforeach
                                                </Select>
                                                </Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student Name:</label>
                                                <input type="text" name="student_name" class="form-control" value="{{ $each->student_name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address:</label>
                                                <input type="text" name="address" class="form-control" value="{{ $each->address}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number:</label>
                                                <input type="text" name="student_phone_number" class="form-control" value="{{ $each->student_phone_number}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email:</label>
                                                <input type="text" name="email" class="form-control" value="{{ $each->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password:</label>
                                                <input type="text" name="password" class="form-control" value="{{ $each->password}}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /.card-body -->
                                    <div class="card-footer" style="text-align: center">
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
            $('#student_management').addClass('active');
            $('#choose_class').select2();
        });
    </script>
@endpush