<style>
    .alert-footer {
        position: fixed;
        right: 10px;
        bottom: 10px;
        max-width: 400px;
        z-index: 10000;
    }
</style>

@if(!empty($error))
    <div class="alert alert-footer alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @if(is_array($error))
            <ul class="">
                @foreach($error as $er)
                    <li>{{ e($er) }}</li>
                @endforeach
            </ul>
        @else
            {{ e($error) }}
        @endif
    </div>
@endif

@if(!empty($success))
    <div class="alert alert-footer alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @if(is_array($success))
            <ul class="">
                @foreach($success as $su)
                    <li>{{ e($su) }}</li>
                @endforeach
            </ul>
        @else
            {{ e($success) }}
        @endif
    </div>
@endif