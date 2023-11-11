@foreach ($workslotbids as $workslotbid)
<div class="modal fade" id="rejectOfferModal{{ $workslotbid->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectOfferModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectOfferModalTitle">Reject Workslot Offer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to reject this workslot offer?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="workslotOfferReject-{{ $workslotbid->id }}" method="POST" action="{{ route('workslotbids.update', ['workSlotBid' => $workslotbid->id]) }}">
                    @csrf
                    @method('PUT')
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslotOfferReject-{{ $workslotbid->id }}').submit();">
                    Reject
                </a>
                <input type="hidden" name="status" value="-1" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

