{{-- <x-modal title="Title" ok="Ok" cancel="Закрыть"></x-modal> --}}

@props([
    'title' => "",
    'ok' => "Ok",
    'cancel' => "Закрыть",
    ])
   
<div class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" ref="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ $slot }}</p>
            </div>
            <div class="modal-footer">
                @if ($cancel != "")
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $cancel }}</button>
                @endif
                @if ($ok != "")
                    <button type="button" class="btn btn-primary">{{ $ok }}</button>
                @endif
            </div>
        </div>
    </div>
  </div>
