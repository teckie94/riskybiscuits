@extends('layouts.app')

@section('title', 'Offer Workslots')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Workslots</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Offered Workslots</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th width="15%">Shift Name</th> --}}
                            <th width="15%">Date</th>
                            <th width="15%">Time</th>
                            <th width="10%">Role</th>
                            @if(auth()->user()->hasRole('Manager'))
                            <th width="15%">Staff Required</th>
                            <th width="20%">Staff</th>
                            @elseif(auth()->user()->hasRole('Staff'))
                            <th width="15%">Status</th>
                            @endif                            
                            <th width="10%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(auth()->user()->hasRole('Manager'))
                            @foreach ($workslots as $workslot)
                                <tr>
                                    {{-- <td>{{ $workslot->time_slot_name }}</td> --}}
                                    <td>{{ $workslot->start_date }}</td>
                                    <td>{{ $workslot->start_time.' - '.$workslot->end_time }}</td>
                                    <td>{{ $workslot->role->name }}</td>
                                    <td>{{ $workslot->quantity}}</td>
                                    <td >
                                        <select class="form-control form-control-user @error('user_id') is-invalid @enderror" 
                                        name="user_id" form="workslotOffer-{{ $workslot->id }}">
                                            <option selected disabled>Select User</option>
                                            @php
                                                $roleUsers = $users->where('staff_role_id',$workslot->staff_role_id);
                                            @endphp
                                            @foreach ($roleUsers as $user)
                                                @php
                                                    $existingBid = $workslotbids->where('work_slot_id', $workslot->id)->where('user_id', $user->id)->where('status','>=','0')->first();
                                                @endphp
                                                @if(!$existingBid)
                                                <option value="{{$user->id}}" name="user_id">{{$user->first_name.' '. $user->last_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="display: flex">
                                        <a id="btnOffer" class="btn btn-success m-2" href="#" 
                                            data-toggle="modal" data-target="#offerModal{{$workslot->id}}">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @elseif(auth()->user()->hasRole('Staff'))
                            @php
                                $workslotbids = $workslotbids->whereIn('status', [-1,2,3])->where('user_id',auth()->user()->id);
                            @endphp
                            @foreach($workslotbids as $workslotbid)
                            <tr>
                                <td>{{ $workslots->find($workslotbid->work_slot_id)->start_date }}</td>
                                <td>{{ $workslots->find($workslotbid->work_slot_id)->start_time
                                    . ' - ' . $workslots->find($workslotbid->work_slot_id)->end_time}}</td>
                                <td>{{ $staffroles->find($workslots->find($workslotbid->work_slot_id)->staff_role_id)->name }}</td>
                                <td>
                                    @if($workslotbid->status == 2)
                                        <span>Offered</span>
                                    @elseif($workslotbid->status == 3)
                                        <span>Accepted</span>
                                    @elseif($workslotbid->status == -1)
                                        <span>Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($workslotbid->status == 2)
                                        <a id="btnAccept" class="btn btn-success m-2" href="#" 
                                            data-toggle="modal" data-target="#acceptModal{{$workslotbid->id}}">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a id="btnReject" class="btn btn-danger m-2" href="#" 
                                            data-toggle="modal" data-target="#rejectOfferModal{{$workslotbid->id}}">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('workslotbids.offer-modal')
@include('workslotbids.accept-modal')
@include('workslotbids.rejectOffer-modal')
@endsection

@section('scripts')

<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->

@endsection
