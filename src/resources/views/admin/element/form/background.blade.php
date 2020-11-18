<div class="form-group">
    <label class="col-form-label" for="{{ $name }}">
        {{ $text ?? trans('common.background_url') }}

        <span class="text-sm-left text-warning">
            (File max size upload {{ @config('constant.MAX_FILE_SIZE_UPLOAD') }}pixel)
        </span>
    </label>
    <div class="controls">
        <div class="input-group mb-3">
            <input type="file" onchange="previewImage(event, 'pathPreviewSingle{{ $name }}')" name="background"
                   class="form-control" id="inputGroupFile01">
        </div>

        <div class="preview-img">
            <ul class="list-unstyled">
                <li>
                    <img src="@if(!empty($background_url)){{ asset('storage'.$background_url) }}@endif"
                         class="img-table img-thumbnail"
                         id="pathPreviewSingle{{ $name }}"/>

                    @if(!empty($background_url))
                        <br/>
                        <label class="text-danger">
                            <input type="checkbox" value="{{ $background_id }}" name="background_remove">
                            <i class="fa fa-trash"></i>
                        </label>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

