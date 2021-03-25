@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post"
                  action="{{ admin_url('navs') }}{{ ($nav->id ?? 0) > 0 ?'/'.$nav->id: '' }}">
                @csrf
                @if (!empty($nav->id))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit"></i> {{ trans('common.form') }}
                        <div class="card-header-actions">
                            <a class="btn btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample"
                               aria-expanded="true">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </div>

                        <div class="text-danger">
                            <small>{{ trans('nav.text-info-number-level') }}</small>
                        </div>
                    </div>

                    <div class="card-body collapse show" id="collapseExample">
                        <input type="hidden" name="parent_id"
                               value="{{ old('parent_id', ($nav->parent_id ?? @request('parent_id', 0))) }}">

                        <input type="hidden" name="position"
                               value="{{ old('position', ($nav->position ?? @request('position', 0))) }}">


                        <div class="form-group">
                            <label class="col-form-label" for="type">{{ trans('nav.type') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'type', 'data' => \App\Models\Nav::dropDownType(), 'selected' => old('type', ($nav->type ?? 0)), 'attr' => 'onChange=chooseNavType(this);'])
                            </div>
                        </div>

                        <div style="{{$nav->type == \App\Models\Nav::TYPE_LINK ? '' : 'display: none'}}"
                             class="form-group form-group-general form-group-{{ \App\Models\Nav::TYPE_LINK }}">
                            <label class="col-form-label" for="type_link">{{ trans('nav.type.link') }}</label>
                            <div class="controls">
                                <input type="text"
                                       name="type_link"
                                       id="type_link"
                                       value="{{ old('type_link', $nav->value ?? '#') }}"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div style="{{$nav->type == \App\Models\Nav::TYPE_PAGE ? '' : 'display: none'}}"
                             class="form-group form-group-general form-group-{{ \App\Models\Nav::TYPE_PAGE }}">
                            <label class="col-form-label" for="type_page">{{ trans('nav.type.page') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'type_page', 'data' => $dropdownPage, 'selected' => old('type_page', ( $nav->value ?? '')), 'attr' => 'onChange=chooseNavSetTextForTitle(this);'])
                            </div>
                        </div>

                        <div style="{{$nav->type == \App\Models\Nav::TYPE_CATEGORY_POST ? '' : 'display: none'}}"
                             class="form-group form-group-general form-group-{{ \App\Models\Nav::TYPE_CATEGORY_POST }}">
                            <label class="col-form-label" for="type_category_post">
                                {{ trans('nav.type.category_post') }}
                            </label>

                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'type_category_post', 'data' => $dropdownPostCategory, 'selected' => old('type_category_post', ( $nav->value ?? '')), 'attr' => 'onChange=chooseNavSetTextForTitle(this);'])
                            </div>
                        </div>

                        @include('admin.element.form.input', ['name' => 'title', 'text' => trans('nav.title'), 'value' => $nav->title ?? ''])
                        @include('admin.element.form.input', ['name' => 'order_by', 'text' => trans('nav.order_by'), 'value' => $nav->order_by ?? ''])

                        <div class="form-actions">
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

<script type="text/javascript">

</script>
