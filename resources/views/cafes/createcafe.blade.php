@extends('layouts.app')

@section('title', 'Create Customer')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Customer</h1>
        <a href="{{route('cafes.viewcafe')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Customer</h6>
        </div>
        <form method="POST" action="{{route('cafes.storecafe')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Name" 
                            name="name" 
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Student Number --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Student Number</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('student_number') is-invalid @enderror" 
                            id="studentNumber"
                            placeholder="Student Number" 
                            name="student_number" 
                            value="{{ old('student_number') }}">

                        @error('student_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Batch Number --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Batch Number</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('batch_number') is-invalid @enderror" 
                            id="batchNumber"
                            placeholder="Batch Number" 
                            name="batch_number" 
                            value="{{ old('batch_number') }}">

                        @error('batch_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                
                    {{-- Mobile Number --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label> Number</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror" 
                            id="exampleMobile"
                            placeholder="Mobile Number" 
                            name="mobile_number" 
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label> Email</label>
                        <input 
                            type="email" 
                            class="form-control form-control-user @error('email') is-invalid @enderror" 
                            id="exampleEmail"
                            placeholder="Email" 
                            name="email" 
                            value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('cafes.viewcafe') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection