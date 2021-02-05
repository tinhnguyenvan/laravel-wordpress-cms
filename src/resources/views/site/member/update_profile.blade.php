@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <form class="form-horizontal" enctype="multipart/form-data" method="post"
              action="{{ base_url('member/update-profile') }}">
            @csrf


            <div class="mb-3">
                <label class="form-label">Last Name</label>

                <input type="text" class="form-control" name="last_name"
                       value="{{ old('last_name', $member->last_name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">First Name (*)</label>
                <input type="text" class="form-control" required name="first_name"
                       value="{{ old('first_name', $member->first_name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input type="text" class="form-control" readonly value="{{ old('email', $member->email) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>

                <input type="text" class="form-control" name="phone" value="{{ old('phone', $member->phone) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>

                <input type="text" class="form-control" name="address"
                       value="{{ old('address', $member->address) }}">
            </div>

            <div class="mb-3">
                <div class="mb-3">
                    <label class="col-form-label" for="image_url">
                        {{ trans('common.image_url') }}

                        <span class="text-sm-left text-warning">(File max size upload {{ @config('constant.MAX_FILE_SIZE_UPLOAD') }}pixel)</span>
                    </label>

                    <input type="file" onchange="previewImage(event, 'pathPreviewSingle_image_url')"
                           name="file" class="file-uploader pull-left form-control" style="width: 100%">
                </div>

                @if(!empty($member->image_url))
                    @if(!empty($member->image_id > 0))
                        <img class="img-circle img-responsive" id="pathPreviewSingle_image_url"
                             style="width: 64px; height: 64px"
                             src="{{ asset('storage'.$member->image_url) }}" alt="avatar">
                    @else
                        <img class="img-circle img-responsive" id="pathPreviewSingle_image_url"
                             style="width: 64px; height: 64px"
                             src="{{ $member->image_url }}" alt="avatar">
                    @endif

                    <div class="mb-3">
                        <label class="text-danger pull-right">
                            <input type="checkbox" value="{{ $member->image_id }}" name="file_remove">
                            <i class="fa fa-trash"></i>
                        </label>
                    </div>
                @endif

            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Update Profile">

                <div class="loginbox-textbox">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">- {{$error}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </form>
    </div>

@endsection