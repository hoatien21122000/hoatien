@extends('student_layout')
@section('student_content')
@push('js_student')
@endpush
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- jquery validation -->
            <div class="card card-primary">
              <form id="quickForm" action="{{ Route('student.change_information') }}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                @foreach($student as $each)
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Student id</label>
                    <input type="number" name="student_id" class="form-control" id="exampleInputStudentId" placeholder="Enter student id" value="{{$each->student_id}}" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Class name</label>
                    <input type="text" name="class_name" class="form-control" id="exampleInputClassName" placeholder="Enter class name"value="{{$each->class_name}}" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Student name</label>
                    <input type="text" name="student_name" class="form-control" id="exampleInputStudentName" placeholder="Enter student name" value="{{$each->student_name}} " readonly="readonly">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" name="address" class="form-control" id="exampleInputAddress" placeholder="Enter address" value="{{$each->address}}">
                    @if($errors->has('address'))
                        <span class="error-text" style="color: rgb(255, 0, 0); font-size: 13px;">
                          <i><b>{{$errors->first('address')}}</b></i>
                        </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" name="student_phone_number" class="form-control" id="exampleInputPhone" placeholder="Enter phone" value="{{$each->student_phone_number}}">
                     @if($errors->has('student_phone_number'))
                        <span class="error-text" style="color: rgb(255, 0, 0); font-size: 13px;">
                          <i><b>{{$errors->first('student_phone_number')}}</b></i>
                        </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="VD: example@gmail.com" value="{{$each->email}}">
                    @if($errors->has('email'))
                        <span class="error-text" style="color: rgb(255, 0, 0); font-size: 13px;">
                          <i><b>{{$errors->first('email')}}</b></i>
                        </span>
                      @endif
                  </div>
                  <div style="margin-left:400px"><a href="{{route('student.change_password')}}">Change Password</a></div>
                 </div>
                  @endforeach
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <div class="col-md-6">

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection