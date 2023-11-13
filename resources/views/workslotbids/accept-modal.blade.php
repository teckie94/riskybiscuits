@foreach ($workslotbids as $workslotbid)
<div class="modal fade" id="acceptModal{{ $workslotbid->id }}" tabindex="-1" role="dialog" aria-labelledby="acceptModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptModalTitle">Accept Workslot Offer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to accept this workslot offer?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="workslotOfferAccept-{{ $workslotbid->id }}" method="POST" action="{{ route('workslotbids.updateOffer', ['workSlotBid' => $workslotbid->id]) }}">
                    @csrf
                    @method('PUT')
                <a class="btn btn-success" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslotOfferAccept-{{ $workslotbid->id }}').submit();">
                    Accept
                </a>
                <input type="hidden" name="status" value="3" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

