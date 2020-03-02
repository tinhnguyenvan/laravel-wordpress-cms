<div class="form-group">
    <label class="col-form-label" for="{{ $name }}">{{ $text ?? trans('common.image_url') }}</label>
    <div class="controls">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>

            <div class="custom-file">
                <input type="file" onchange="previewImage(event, 'pathPreviewSingle{{ $name }}')" name="file"
                       class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>

        <div class="preview-img">
            @if(!empty($image_url))
                <img src="{{ asset('storage'.$image_url) }}" class="img-table img-thumbnail"/>
            @endif
        </div>
        <div class="text-sm-left text-warning">File max size upload {{ @config('constant.MAX_FILE_SIZE_UPLOAD') }}
            pixel
        </div>
    </div>
</div>

