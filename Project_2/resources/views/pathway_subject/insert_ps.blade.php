@extends('layout')
@section('content')
<div style="margin-left:200px">
<form action="" method="Post">

@if(count($errors) > 0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{$err}}<br>
			@endforeach
		</div>
@endif
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<b>Choose Major</b>
    <Select id="choose_pathway" class="form-control" name="pathway_id" style="width:600px">
        <option value="">----- Choose Major -----</option>
        @foreach($arr_pathway as $each)
            <option value="{{$each->pathway_id}}">
                {{$each->pathway_name}}
            </option>
        @endforeach
    </Select>
    <br/><br/>
<b>Choose Subject</b>
    <Select id="choose_subject" class="form-control" name="subject_id" style="width:600px">
        <option value="">------ Choose Subject -----</option>
        @foreach($arr_subject as $each)
            <option value="{{$each->subject_id}}">
                {{$each->subject_name}}
            </option>
        @endforeach
    </Select>

    @if(session('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> subject already exists
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif

    <br/><br/>
    <button class="btn btn-primary" >Add New Subject-Pathway</button>
</form>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#li_manage_list').addClass('menu-open');
            $('#manage_list').addClass('active');
            $('#pathway_subject_management').addClass('active');
        });
    </script>
@endpush
