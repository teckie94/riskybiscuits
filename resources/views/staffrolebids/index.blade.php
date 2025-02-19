+@extends('layouts.app')

@section('title', 'Staff Role Bids')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Role Bids</h1>
        <a href="{{route('staffrolebids.create')}}" class="btn btn-sm btn-primary" >
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Staff Role Bids</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="30%">Staff Role</th>
                            <th width="30%">User Name</th>
                            <th width="20%">Applied On</th>
                            <th width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffrolebids as $staffrolebid)
                        <form method="POST" action="{{route('staffrolebids.update', ['staffrolebid' => $staffrolebid->id])}}">   
                            <tr>
                                <td>{{$staffroles->find($staffrolebid->staff_role_id)->name}}</td>
                                <td>{{$users->find($staffrolebid->user_id)->first_name . ' '. $users->find($staffrolebid->user_id)->last_name}}</td>
                                <td>{{$staffrolebid->updated_at->format('d/m/Y h:i A')}}</td>
                                {{-- Status --}}
                                <td class="form-control-user" style="display: flex">
                                @if($staffrolebid->status == 1)
                                    Approved
                                @elseif($staffrolebid->status == -1)
                                    Rejected
                                @elseif(($staffrolebid->status == 0) && (auth()->user()->role_id==4))
                                    Pending Approval
                                @else
                                    <button id="btnApprove" type="submit" name="status" value="1" class="btn btn-success m-2" 
                                    data-toggle="modal" data-target="#confirmModal">
                                        <i class="fa fa-check"></i> Approve
                                    </a>
                                    <button id="btnReject" type="submit" name="status" value="-1" class="btn btn-danger m-2" data-toggle="modal" data-target="#confirmModal" >
                                        <i class="fa fa-times"></i> Reject
                                    </button>
                                @endif
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
                {{$staffrolebids->links()}}
            </div>
        </div>
    </div>


</div>
@endsection