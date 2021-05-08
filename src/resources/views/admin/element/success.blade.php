@if(!empty($success))
    <div class="toast toast-success" aria-live="polite" role="alert" data-autohide="false" data-delay="5000"
         style="position: fixed; bottom: 10px; right: 10px;min-width: 400px;">
        <div class="toast-header">
            <strong class="mr-auto">Success message</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            @if(is_array($success))
                <ul class="">
                    @foreach($success as $su)
                        <li>{{ $su }}</li>
                    @endforeach
                </ul>
            @else
                {{ $success }}
            @endif
        </div>
    </div>
@endif
