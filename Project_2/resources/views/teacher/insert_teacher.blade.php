@extends('layout')
@section('content')

    <section class="content" style="margin-left:200px">
    @if(count($errors) > 0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{$err}}<br>
			@endforeach
		</div>
@endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <!-- jquery validation -->
                <div class="card card-primary">
                <!-- form start -->
                    <form id="quickForm" method="post" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Teacher Name:</label>
                                    <input type="text" name="teacher_name" class="form-control" placeholder="Enter Teacher Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number:</label>
                                    <input type="number" name="teacher_phone_number" class="form-control" placeholder="Enter Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sex:</label>
                                    <select name="sex" class="form-control">
                                        <option value="">------------------</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address:</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date of Birth:</label>
                                    <input type="date" name="date_of_birth" class="form-control" placeholder="Enter Date of Birth">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email:</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password:</label>
                                    <input type="text" name="password" class="form-control" placeholder="Enter Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button class="btn btn-primary">Insert</button>
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