@extends('layouts.app')
@section('title', 'Available Workslots')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Available Workslots</h1>
    </div>
    {{-- Alert Messages --}}
    @include('common.alert')
     <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Workslots</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th width="15%">Shift Name</th> --}}
                            <th width="10%">Date</th>
                            <th width="15%">Time</th>
                            <th width="10%">Role</th>
                            <th width="10%">Staff Required</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workslots as $workslot)
                            @php
                                $existingBid = $workslotbids->where('work_slot_id', $workslot->id)->where('user_id', auth()->user()->id)->first();
                            @endphp
                        @if (!$existingBid)
                        <tr>
                            {{-- <td>{{ $workslot->time_slot_name }}</td> --}}
                            <td>{{ $workslot->start_date }}</td>                            
                            <td>{{ $workslot->start_time . ' - ' .  $workslot->end_time }}</td>
                            <td>{{$workslot->role->name}}</td>
                            <td>{{ $workslot->quantity }}</td>
                            <td style="display: flex">
                                <form method="POST" action="{{ route('workslotbids.store') }}">
                                    @csrf
                                    <input type="hidden" name="work_slot_id" value="{{ $workslot->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" class="btn btn-primary">Bid</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @include('users.deleterecord-modal') --}}
@endsection
@section('scripts')
<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->
@endsection