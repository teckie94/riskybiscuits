@foreach ($workslots as $workslot)
<div class="modal fade" id="offerModal{{ $workslot->id }}" tabindex="-1" role="dialog" aria-labelledby="offerModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="offerModalTitle">Offer Workslot</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @php

                @endphp
                Are you sure you want to offer this workslot?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="workslotOffer-{{ $workslot->id }}" method="POST" action="{{ route('workslotbids.offerstore', ['workslot' => $workslot->id]) }}">
                    @csrf   
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslotOffer-{{ $workslot->id }}').submit();">
                    Offer
                </a>
                <input type="hidden" name="work_slot_id" value="{{$workslot->id}}" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach






