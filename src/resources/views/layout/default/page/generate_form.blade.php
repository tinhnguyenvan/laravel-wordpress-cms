<form action="{{ base_url('contact') }}" method="post">
    @csrf
    @if(!empty($form->form_fullname_status))
        <div class="form-group">
            <label for="form_fullname">{{ trans('contact.form_fullname') }}</label>
            @if('input' ==  $form->form_fullname_type)
                <input type="text" class="form-control" id="form_fullname" name="form_fullname"
                       value="{{ old('form_fullname') }}">
            @else
                <textarea class="form-control" rows="5" id="form_fullname"
                          name="form_fullname">{{ old('form_fullname') }}</textarea>
            @endif
        </div>
    @endif

    @if(!empty($form->form_email_status))
        <div class="form-group">
            <label for="form_email">{{ trans('contact.form_email') }}</label>
            @if('input' ==  $form->form_email_type)
                <input type="text" class="form-control" id="form_email" name="form_email"
                       value="{{ old('form_email') }}">
            @else
                <textarea class="form-control" rows="5" id="form_email"
                          name="form_email">{{ old('form_email') }}</textarea>
            @endif
        </div>
    @endif

    @if(!empty($form->form_phone_status))
        <div class="form-group">
            <label for="form_phone">{{ trans('contact.form_phone') }}</label>
            @if('input' ==  $form->form_phone_type)
                <input type="text" class="form-control" id="form_phone" name="form_phone"
                       value="{{ old('form_phone') }}">
            @else
                <textarea class="form-control" rows="5" id="form_phone"
                          name="form_phone">{{ old('form_phone') }}</textarea>
            @endif
        </div>
    @endif

    @if(!empty($form->form_title_status))
        <div class="form-group">
            <label for="form_title">{{ trans('contact.form_title') }}</label>
            @if('input' ==  $form->form_title_type)
                <input type="text" class="form-control" id="form_title" name="form_title"
                       value="{{ old('form_title') }}">
            @else
                <textarea class="form-control" rows="5" id="form_title"
                          name="form_title">{{ old('form_title') }}</textarea>
            @endif
        </div>
    @endif

    @if(!empty($form->form_content_status))
        <div class="form-group">
            <label for="form_content">{{ trans('contact.form_content') }}</label>
            @if('input' ==  $form->form_content_type)
                <input type="text" class="form-control" id="form_content" name="form_content"
                       value="{{ old('form_content') }}">
            @else
                <textarea class="form-control" rows="5" id="form_content"
                          name="form_content">{{ old('form_content') }}</textarea>
            @endif
        </div>
    @endif

    <button type="submit" class="btn btn-default">Submit</button>
</form>