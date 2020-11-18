<div class="form-group">
    <label class="col-form-label" for="gallery">
        {{ trans('common.gallery') }}

        <span class="text-sm-left text-warning">
            (File max size upload {{ @config('constant.MAX_FILE_SIZE_UPLOAD') }}pixel)
        </span>
    </label>
    <div class="controls">
        <div class="input-group mb-3">
            <input type="file" multiple="multiple" name="file_multi[]" class="form-control">
        </div>

        <div class="preview-img">
            @if(!empty($value))
                <ul class="list-unstyled">
                    @foreach($value as $image)
                        <li class="pull-left  text-center" style="margin-right: 10px">
                            <img src="{{ asset('storage'.$image->image_url) }}" class="img-table img-thumbnail" alt="img"/>
                            <br/>
                            <label class="text-danger">
                                <input type="checkbox" value="{{ $image->id }}" name="file_multi_remove[]">
                                <i class="fa fa-trash"></i>
                            </label>
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            @endif
        </div>
    </div>
</div>

