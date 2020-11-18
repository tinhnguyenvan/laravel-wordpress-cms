@extends('admin.layouts.app')
@section('content')

    <form method="post" action="{{ admin_url('orders') }}">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ trans('sale_order.product') }}</h4>
                        <hr/>
                        @csrf

                        <div class="input-group" style="margin: 10px auto">
                            <input class="form-control" id="product_id" name="search" style="width: 100%"
                                   placeholder="{{ trans('sale_order.search.add') }}"/>

                        </div>

                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>{{ trans('sale_order.product') }}</th>
                                <th style="width: 100px" class="text-center">{{ trans('sale_order.quantity') }}</th>
                                <th style="width: 200px" class="text-center">{{ trans('sale_order.price') }}</th>
                                <th style="width: 200px" class="text-center">{{ trans('sale_order.total') }}</th>
                            </tr>
                            </thead>
                            <tbody id="add-item-order">

                            </tbody>
                            <tfoot>
                            <td class="text-right" colspan="3">
                                <strong>{{ trans('sale_order.total_final') }}</strong>
                            </td>
                            <td class="text-center">
                                <span id="so_total_final">0</span>
                            </td>
                            </tfoot>
                        </table>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('sale_order.title_create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ trans('sale_order.billing_info') }}</h4>
                        <hr/>
                        <div class="form-group">
                            <label class="">{{ trans('common.fullname') }}</label>
                            <div class="controls">
                                <input class="form-control @error('billing_fullname') is-invalid @enderror"
                                       name="billing_fullname"
                                       id="billing_fullname"
                                       required
                                       value="{{ old('billing_fullname') }}"
                                       placeholder="{{ trans('common.fullname') }}/ Fullname"
                                       autocomplete="off">

                                @error('billing_fullname')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">Email</label>
                            <div class="controls">
                                <input class="form-control @error('billing_email') is-invalid @enderror"
                                       value="{{ old('billing_email') }}"
                                       required
                                       name="billing_email"
                                       type="email"
                                       autocomplete="off"
                                       placeholder="Email">

                                @error('billing_email')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">{{ trans('common.phone') }}</label>
                            <div class="controls">
                                <input class="form-control @error('billing_phone') is-invalid @enderror"
                                       name="billing_phone"
                                       required
                                       value="{{ old('billing_phone') }}"
                                       placeholder="{{ trans('common.phone') }}/ Phonenumber"
                                       autocomplete="off">
                                @error('billing_phone')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">{{ trans('common.address') }}</label>
                            <div class="controls">
                                <input class="form-control"
                                       name="billing_address"
                                       value="{{ old('billing_address') }}"
                                       placeholder="{{ trans('common.address') }}/ Address"
                                       autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="">{{ trans('common.note') }}</label>
                            <div class="controls">
                                <textarea rows="4" class="form-control" name="note" placeholder="{{ trans('common.note') }}/ Note" autocomplete="off">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
