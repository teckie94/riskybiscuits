@foreach ($workslotbids as $workslotbid)
<div class="modal fade" id="deleteModal{{ $workslotbid->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle">Delete Workslot Bid</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete Workslot Bid for {{ $users->find($workslotbid->user_id)->first_name . ' '. $users->find($workslotbid->user_id)->last_name}}?
                <textarea class="form-control mt-2" form="workslotBidDelete-{{ $workslotbid->id }}" name="remarks" cols="40" rows="5" placeholder="reason for deletion"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="workslotBidDelete-{{ $workslotbid->id }}" method="POST" action="{{ route('workslotbids.destroy', ['workSlotBid' => $workslotbid->id]) }}">
                    @csrf
                    @method('DELETE')
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslotBidDelete-{{ $workslotbid->id }}').submit();">
                    Delete
                </a>
                <input type="hidden" name="status" value="1" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

