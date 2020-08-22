
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
                <div class="col-md-10">
                    <!-- jquery validation -->
                        <div class="card card-primary">
                        <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>UPDATE MAJOR</h4></div>
                        <!-- form start -->
                            <form id="quickForm" method="post" action="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @foreach ($arr_pathway as $each)
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Major Id:</label>
                                                <input type="number" name="pathway_id" class="form-control" value="{{ $each->pathway_id }}" readonly="readonly">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Major Name:</label>
                                                <input type="text" name="pathway_name" class="form-control" value="{{ $each->pathway_name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /.card-body -->
                                    <div class="card-footer" style="text-align: center">
                                    <button class="btn btn-primary">Update</button>
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
            $('#pathway_management').addClass('active');
        });
    </script>
@endpush