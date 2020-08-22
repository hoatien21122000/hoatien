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
            <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>Add A New Academic Year</h4></div>
              <!-- form start -->
              <form id="quickForm" method="post" action="">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Academic Year Name:</label>
                    <input type="text" name="academic_year_name" class="form-control" placeholder="Enter Academic Year Name">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: center">
                  <button class="btn btn-primary">Insert</button>
                </div>
              </form>
            </div>
            </div>
          <div class="col-md-6">
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