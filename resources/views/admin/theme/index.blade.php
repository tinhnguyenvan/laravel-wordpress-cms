@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ admin_url('configs/save')}}">
                @csrf
                <div class="row">
                    @foreach($directories as $dir)
                        @if('.' == $dir || '..' == $dir)
                            @continue
                        @endif
                        <div class="col-sm-6">
                            <div class="thumbnail">
                                <img src="{{ asset("layout/".$dir."/screen_shot.png") }}" alt="default"
                                     class="img-thumbnail">
                                <div class="caption text-center" style="margin: 10px auto">
                                    <h3>{{ ucfirst($dir) }}</h3>
                                    <p class="text-primary">
                                    <div class="form-check form-check-inline">
                                        <input onchange="this.form.submit()" class="form-check-input" type="radio"
                                               name="theme_active"
                                               id="theme_active{{ $dir }}"
                                               value="{{$dir}}" {{ $theme_active == $dir ? 'checked': '' }} />
                                        <label class="form-check-label"
                                               for="theme_active{{ $dir}}">{{trans('theme.active')}}</label>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
