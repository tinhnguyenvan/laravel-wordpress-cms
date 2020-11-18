@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" enctype="multipart/form-data"
                  action="{{ admin_url('products') }}{{ ($product->id ?? 0) > 0 ?'/'.$product->id: '' }}">
                @csrf
                @if (!empty($product->id))
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
                    </div>
                    <div class="card-body collapse show" id="collapseExample">
                        @include('admin.element.form.input', ['name' => 'sku', 'text' => trans('product.sku'), 'value' => $product->sku ?? ''])
                        @include('admin.element.form.input', ['name' => 'title', 'text' => trans('product.title'), 'value' => $product->title ?? ''])

                        <div class="form-group">
                            <label class="col-form-label" for="title">{{ trans('product.category_id') }}</label>
                            <div class="controls">
                                @include('admin.element.form.select', ['name' => 'category_id', 'data' => $dropdownCategory, 'selected' => old('category_id', $product->category_id ?? 0)])
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="price">{{ trans('product.price') }}</label>
                            <div class="controls">
                                <input type="number" name="price" id="price"
                                       value="{{ old('price', $product->price ?? 0) }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label"
                                   for="price_promotion">{{ trans('product.price_promotion') }}</label>
                            <div class="controls">
                                <input type="number" name="price_promotion" id="price_promotion"
                                       value="{{ old('price_promotion', $product->price_promotion ?? 0) }}"
                                       class="form-control">
                            </div>
                        </div>

                        @include('admin.element.form.input', ['name' => 'quantity', 'text' => trans('product.quantity'), 'value' => $product->quantity ?? 0, 'type' => 'number'])

                        @include('admin.element.form.textarea', ['name' => 'summary', 'text' => trans('product.summary'), 'value' => $product->summary ?? ''])

                        <div class="form-group">
                            <label class="col-form-label" for="editor1">{{ trans('product.detail') }}</label>
                            <div class="controls">
                                <textarea class="form-control" id="editor1"
                                          name="detail">{{ old('detail', $product->detail ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="nav-tabs-boxed">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#multi1" role="tab" aria-controls="multi1">
                                       <i class="fa fa-image"></i> Image
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#multi2" role="tab" aria-controls="multi2">
                                        <i class="icon-picture"></i> Gallery
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="multi1" role="tabpanel">
                                    @include('admin.element.form.image', ['name' => 'image_id', 'image_id' => $product->image_id ?? '', 'image_url' => $product->image_url ?? ''])
                                </div>
                                <div class="tab-pane" id="multi2" role="tabpanel">
                                    @include('admin.element.form.image_multi', ['value' => $product->images ?? []])
                                </div>
                            </div>
                        </div>

                        @include('admin.element.form.check', ['name' => 'is_home', 'text' => trans('product.is_home'), 'value' => $product->is_home ?? 0])
                        @include('admin.element.form.tags', ['name' => 'tags', 'text' => trans('common.tags'), 'value' => $product->tags ?? ''])

                        <div class="form-group">
                            <label class="col-form-label" for="status">{{ trans('product.status') }}</label>
                            <div class="controls">
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('product.status.active'), 'valueDefault' => \App\Models\Product::STATUS_ACTIVE, 'value' => $product->status ?? 1])
                                @include('admin.element.form.radio', ['name' => 'status', 'text' => trans('product.status.disable'), 'valueDefault' => \App\Models\Product::STATUS_DISABLE, 'value' => $product->status ?? 0])
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- seo form -->
                @include('admin.element.form_seo', ['info' => $product ?? ''])

            </form>

            @if (!empty($product->id))
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <div class="form-actions text-lg-right">
                            <form method="post" action="{{ admin_url('products/'.$product->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-trash"></i>
                                    {{ trans('common.trash') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
