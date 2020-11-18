@if (!empty($errors) && $errors->any())
    <div class="toast toast-error" aria-live="polite" role="alert" data-autohide="false" data-delay="5000"
         style="position: fixed; bottom: 10px; right: 10px;min-width: 400px;">
        <div class="toast-header">
            <strong class="mr-auto">Error message</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <ul class="">
                @foreach ($errors->all() as $message)
                    <li>{{ e($message) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
      $(document).ready(function () {
        $('.toast').toast('show')
      });
    </script>
@endif

@if(!empty($error))
    <div class="toast toast-error" aria-live="polite" role="alert" data-autohide="false" data-delay="5000"
         style="position: fixed; bottom: 10px; right: 10px;min-width: 400px;">
        <div class="toast-header">
            <strong class="mr-auto">Error message</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
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
    </div>

    <script>
      $(document).ready(function () {
        $('.toast').toast('show')
      });
    </script>

@endif
