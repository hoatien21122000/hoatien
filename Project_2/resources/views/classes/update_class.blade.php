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
                        <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>Update Class</h4></div>
                        <!-- form start -->
                            <form id="quickForm" method="post" action="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @foreach ($arr_class as $each)
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Class id:</label>
                                                <input type="number" name="class_id" class="form-control" value="{{ $each->class_id }}" readonly="readonly">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Academic Year Id:</label>
                                                <Select class="form-control" name="academic_year_id">
                                                    <option value="">-----Choose Academic Year-----</option>
                                                    @foreach($arr_academic_year as $each_academic)
                                                        <option value="{{$each_academic->academic_year_id}}"
                                                        @if($each_academic->academic_year_id == $each->academic_year_id)
                                                            selected
                                                        @endif
                                                        >
                                                            {{$each_academic->academic_year_name}}
                                                        </option>
                                                    @endforeach
                                                </Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Major Id:</label>
                                                <Select class="form-control" name="pathway_id">
                                                    <option value="">-----Choose Major-----</option>
                                                    @foreach($arr_pathway as $each_pathway)
                                                        <option value="{{$each_pathway->pathway_id}}"
                                                        @if($each_pathway->pathway_id == $each->pathway_id)
                                                            selected
                                                        @endif
                                                        >
                                                            {{$each_pathway->pathway_name}}
                                                        </option>
                                                    @endforeach
                                                </Select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Class Name:</label>
                                                <input type="text" name="class_name" class="form-control" value="{{ $each->class_name}}">
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
            $('#class_management').addClass('active');
        });
    </script>
@endpush