@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <ol class="breadcrumb">
            <li><a href="{{ base_url() }}"><i class="fa fa-home"></i> {{ trans('common.home') }}</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
        <form class="form-horizontal" enctype="multipart/form-data" method="post"
              action="{{ base_url('member/update-profile') }}">
            @csrf
            <fieldset class="fieldset">
                <h3 class="fieldset-title">Personal Info</h3>
                <div class="form-group avatar">
                    <figure class="figure col-md-2 col-sm-3 col-xs-12">
                        @if(!empty($member->image_id > 0))
                            <img class="img-circle img-responsive" id="pathPreviewSingle_image_url" style="width: 64px; height: 64px"
                                 src="{{ asset('storage'.$member->image_url) }}" alt="avatar">
                        @else
                            <img class="img-circle img-responsive" id="pathPreviewSingle_image_url" style="width: 64px; height: 64px"
                                 src="{{ $member->image_url }}" alt="avatar">
                        @endif

                        @if(!empty($member->image_url))
                            <br/>
                            <label class="text-danger pull-right">
                                <input type="checkbox" value="{{ $member->image_id }}" name="file_remove">
                                <i class="fa fa-trash"></i>
                            </label>
                        @endif
                    </figure>
                    <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                        <label class="col-form-label" for="image_url">
                            {{ trans('common.image_url') }}

                            <span class="text-sm-left text-warning">(File max size upload {{ @config('constant.MAX_FILE_SIZE_UPLOAD') }}pixel)</span>
                        </label>

                        <input type="file" onchange="previewImage(event, 'pathPreviewSingle_image_url')"
                               name="file" class="file-uploader pull-left form-control" style="width: 100%">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="last_name"
                               value="{{ old('last_name', $member->last_name) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name (*)</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" required name="first_name"
                               value="{{ old('first_name', $member->first_name) }}">
                    </div>
                </div>

            </fieldset>
            <fieldset class="fieldset">
                <h3 class="fieldset-title">Contact Info</h3>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" readonly value="{{ old('email', $member->email) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Phone</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $member->phone) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2  col-sm-3 col-xs-12 control-label">Address</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="address"
                               value="{{ old('address', $member->address) }}">
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="form-group">
                <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                    <input class="btn btn-primary" type="submit" value="Update Profile">
                </div>

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