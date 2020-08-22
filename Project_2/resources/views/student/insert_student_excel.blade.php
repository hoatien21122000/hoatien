
@extends('layout')
@section('content')
<div class="main-content" style="margin-left:200px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>INSERT BY EXCEL</h4></div>
                    <div class="content">
                        <form class="form-horizontal" method="post" action="{{ route('student_management.student_process_insert_excel')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Choose Class</label>
                                <div class="col-md-10">
                                <Select id="choose_class" class="form-control" name="class_id">
                                    <option value="0">----- Choose Class -----</option>
                                    @foreach($arr_class as $each)
                                        <option value="{{$each->class_id}}" >
                                            {{$each->class_name}}
                                        </option>
                                    @endforeach
                                </Select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Click file</label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="file_excel">
                                </div>
                            </div>

                            <div class="form-group" style="text-align: center">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">Insert</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card -->

            </div> <!--  end col-md-6  -->
        </div> 
    </div> 
</div>
@endsection
@push('js')
<script>
        $(document).ready(function(){
            $('#li_manage_list').addClass('menu-open');
            $('#manage_list').addClass('active');
            $('#student_management').addClass('active');
        });
    </script>
@endpush