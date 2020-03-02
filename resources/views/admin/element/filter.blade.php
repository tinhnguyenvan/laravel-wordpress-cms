<div class="row table-filter">
    @if (!empty($filter['form']))
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenu5"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="true">
                    {{ trans('common.action_filter') }}
                    <i class="fa fa-filter" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu px-4 py-3 dropdown-filter" aria-labelledby="dropdownMenu5">
                    <form method="get">
                        @foreach ($filter['form'] as $key => $form)
                            @if ($form['type'] == 'select')
                                <div class="form-group">
                                    <label class="col-form-label">{{ $form['text'] }}</label>
                                    <div class="controls">
                                        @include('admin.element.form.select', ['name' => $key, 'data' => $form['data'], 'selected' => $filter['active'][$key], 'empty' => 1])
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="ft{{ $key }}"> {{ $form['text'] }}</label>
                                    <input autocomplete="off" class="form-control" id="ft{{$key}}" name="{{ $key }}"
                                           type="text"
                                           value="{{ $filter['active'][$key] }}">
                                </div>
                            @endif
                        @endforeach
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-filter"></i>
                            {{ trans('common.text_filter') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-9">
        <form method="get">
            <div class="input-group">
                <input class="form-control" id="filter-key" name="search" value="{{ request('search') }}"
                       placeholder="{{ trans('common.search.keyword') }}"/>
                <span class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    {{ trans('common.search') }}
                </button>
            </span>
            </div>
        </form>
    </div>
</div>

<div class="clearfix"></div>
