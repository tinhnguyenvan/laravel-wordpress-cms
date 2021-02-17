<div class="row table-filter">
    @if (!empty($filter['form']))
        <div class="col-md-6">
            <div class="dropdown" style="display: inline-block">
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenu5"
                        type="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="true">
                    Sort by
                    <i class="fa fa-sort" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu">
                    <form method="get">
                        <button class="dropdown-item" name="sort_by" value="id asc">
                            ID Oldest <i class="fa fa-sort-numeric-asc pull-right"></i>
                        </button>

                        <button class="dropdown-item" name="sort_by" value="id desc">
                            ID Newest <i class="fa fa-sort-numeric-desc pull-right"></i>
                        </button>

                        @if (!empty($filter['sort_by']))
                            @foreach($filter['sort_by'] as $sortKey => $sortItem)
                                <button class="dropdown-item" name="sort_by" value="{{ $sortItem['value'] }}">
                                    {!! $sortItem['name'] !!}
                                </button>
                            @endforeach
                        @endif
                    </form>
                </div>
            </div>
            <div class="dropdown" style="display: inline-block">
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
                        <input type="hidden" name="page" value="0">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-filter"></i>
                            {{ trans('common.text_filter') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-6">
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
    @if(!empty($filter['active']))
        @php
            $checkRemove = 0
        @endphp
        <div class="col-lg-12">
            <hr style="margin-top: 10px"/>
            @foreach($filter['active'] as $key => $item)
                @if(!empty($item))
                    <i class="fa fa-filter"></i> {{ $filter['form'][$key]['text'] }}:
                    <span class=" text-primary" style="margin-right: 5px">
                        {{ $filter['form'][$key]['data'][$item] ?? '' }}
                    </span>
                    @php
                        $checkRemove = 1
                    @endphp
                @endif
            @endforeach
            @if($checkRemove == 1)
                <a class="label label-danger" href="{{ url()->current() }}">
                    Remove all filter <i class="fa fa-times-circle-o"></i>
                </a>
            @endif
        </div>
    @endif
</div>

<div class="clearfix"></div>
