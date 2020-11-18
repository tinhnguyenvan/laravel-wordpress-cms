@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ admin_url('tools/qr_code')}}">
                @csrf
                <input type="hidden" name="type" value="{{ $tabActive }}">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit"></i> {{ trans('common.form') }}
                        <div class="card-header-actions">
                            <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample"
                               aria-expanded="true">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body collapse show" id="collapseExample">
                        <div class="nav-tabs-boxed">
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($tabs as $tabKey => $tabName)
                                    <li class="nav-item">
                                        <a href="{{ admin_url('tools/qr_code?tab='.$tabKey) }}"
                                           class="nav-link @if($tabKey == $tabActive) active @endif">{{ $tabName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @include('admin.tool.qr_code.tab.'.$tabActive)
                            </div>

                            <div class="tab-content-file clear" style="margin: 10px 0">
                                @if(!empty($file->id))
                                    <img src="{{ asset('storage'.$file->file_name) }}"
                                         class=" img-thumbnail" alt="{{ $file->name }}"
                                         title="{{ $file->name }}"/>
                                @endif
                            </div>
                        </div>

                        <div class="form-actions mt-5">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
