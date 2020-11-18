@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i> {{ $title  }}
                </div>

                <div class="card-body collapse show" id="collapseExample">
                    <form method="post" action="{{ admin_url('members/tags/'.$member->id ) }}">
                        @csrf
                        @method('PUT')

                        @if($typeItems)
                            <div class="row">
                                @foreach($typeItems as $typeItem)
                                    @if($typeItem->parent_id == 0)
                                        <div class="col-lg-12">
                                            <h4>
                                                <i class="fa fa-tags"></i>
                                                {{ $typeItem->name }}</h4>
                                            <hr/>
                                        </div>
                                    @else
                                        <div class="col-lg-3">
                                            @include('admin.element.form.check', ['name' => 'tags['.$typeItem->id.']', 'text' => $typeItem->name, 'value' => in_array($typeItem->id, $tags) ? 1 : 0])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
