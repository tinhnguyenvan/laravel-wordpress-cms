@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ admin_url('themes/active')}}">
                @csrf
                <div class="row">
                    @foreach($directories as $key => $dir)
                        @if(!\Illuminate\Support\Facades\File::exists(base_path("themes/".$dir."/public/screen_shot.png")))
                            @continue

                        @endif
                        @php
                            $manifest = json_decode(file_get_contents(base_path("themes/".$dir."/public/manifest.json")), true);
                        @endphp
                        <div class="col-sm-4">
                            <div class="thumbnail" style="margin-bottom: 50px">
                                <img
                                    src="{{ 'data:image/png;base64,'.base64_encode(file_get_contents(base_path("themes/".$dir."/public/screen_shot.png"))) }}"
                                    alt="default"
                                    class="img-thumbnail">
                                <div class="caption text-center" style="margin: 10px auto">
                                    <div class="text-primary">
                                        <div class="form-check form-check-inline">
                                            <label for="theme_active{{ $key }}"></label>
                                            <button type="submit"
                                                    name="theme_active"
                                                    value="{{$dir}}"
                                                    class="btn btn-sm {{ $theme_active == $dir ? 'btn-primary': 'btn-default' }}">
                                                @if($theme_active != $dir )
                                                    <i class="fa fa-check"></i>
                                                    {{trans('common.active')}} theme {{ ucfirst($dir) }}
                                                @else
                                                    <i class="fa fa-flag-checkered"></i>
                                                    {{trans('common.active')}} theme {{ ucfirst($dir) }}
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
