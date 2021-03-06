@extends('layouts.admin_layout')

@section('title', 'Create Employee')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="col-md-5">
                <div class="card card-primary">
                    <!-- form start -->
                    <form action="{{ route('employees.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputFile">Photo</label>

                                <div class="input-group">
                                    <div>
                                        <input type="file" name="photo">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" name="pos_name" >
                                    @foreach($positions as $position)
                                        <option type="text" value="{{ $position['name'] }}">{{ $position['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Salary, $</label>
                                <input type="text" class="form-control" name="salary" placeholder="Enter salary">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of employment</label>
                                <input type="date" class="form-control" name="date" placeholder="Enter date">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" value="submit" name="submitbutton" class="btn btn-primary">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ route('employees.index') }}">Cancel</a>
                        </div>

                    </form>


                </div>
            </div>

            <!-- /.card -->



        </section>

        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
            integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
            crossorigin="anonymous">

    </script>
    <script type="application/javascript">
        $(document).ready(function(){
            $("#phone").mask("+38(999)-999-99-99")
        });
    </script>
@endsection
