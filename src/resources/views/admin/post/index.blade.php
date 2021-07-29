@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('posts/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('admin.element.filter')
            <form method="post" action="{{ admin_url('posts/destroy-multi') }}">
                @csrf
                @method('DELETE')
                <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-center w50">
                            <input type="checkbox" name="check_all" id="check_all" value="1">
                        </th>
                        <th>@lang('post.title', [], config('app.locale'))</th>
                        <th class="th-category_id">@lang('post.category_id', [], config('app.locale'))</th>
                        <th class="th-creator_id">@lang('post.creator_id', [], config('app.locale'))</th>
                        <th class="th-created_at">@lang('post.created_at', [], config('app.locale'))</th>
                        <th class="text-center">@lang('post.count_view', [], config('app.locale'))</th>
                        <th class="th-image text-center">@lang('post.image', [], config('app.locale'))</th>
                        <th class="th-status text-center">@lang('post.status', [], config('app.locale'))</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if ($items->count() > 0)
                        @foreach ($items as $item)
                            <tr>
                                <td class="text-center">
                                    <label>
                                        <input class="check_id" type="checkbox" name="ids[]" value="{{ $item->id }}"/>
                                    </label>
                                </td>
                                <td>
                                    @foreach(\App\Models\Language::loadLanguage() as $code => $language)
                                        @if(!empty($item->translate($code)->title))
                                            <a href="{{ admin_url('posts/'.$item->id.'/edit') }}">
                                                {{ $item->translate($code)->title }} [{{ $code }}]
                                            </a>
                                            <br/>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{!empty($item->category->title ) ? $item->category->title : '' }}
                                </td>
                                <td>
                                    {{ $item->creator_id > 0 && !empty($item->user->name) ?  $item->user->name : '--' }}
                                </td>
                                <td>
                                    {{ $item->created_at->format(config('app.date_format')) }}
                                </td>
                                <td class="text-center">
                                    {{ $item->views }}
                                </td>
                                <td class="text-center">
                                    <img src="{{ $item->full_image_url }}" alt="img" class="img-table img-thumbnail"/>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $item->link }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-globe"></i>
                                    </a>

                                    <a class="btn btn-{{ $item->status_color }} btn-sm text-white">
                                        <i class="fa fa-check-circle-o"></i>
                                        {{ $item->status_text }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                {{ trans('common.data_empty') }}
                            </td>
                        </tr>
                    @endif
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="8">
                            @include('admin.element.button.delete_multi')
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </form>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection
