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
                <div class="col-md-8">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <!-- form start -->
                                <form id="quickForm" method="post" action="">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @foreach ($arr_subject as $each)
                                            <div class="card-body">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">Subject ID:</label>
                                                    <input type="text" name="subject_id" class="form-control" value="{{ $each->subject_id }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Subject Name:</label>
                                                    <input type="text" name="subject_name" class="form-control" value="{{ $each->subject_name }}">
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
            $('#subject_management').addClass('active');
        });
    </script>
@endpush