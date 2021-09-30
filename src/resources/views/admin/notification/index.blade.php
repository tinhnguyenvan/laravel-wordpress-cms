<?php
/**
 * Created by PhpStorm.
 * User: tinhnguyen
 * Date: 03/08/2021
 * Time: 21:30
 */
?>

@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $items->total() }})

            <div class="card-header-actions">
                <a class="btn btn-sm btn-primary" href="{{ admin_url('notifications/create') }}">
                    <small>
                        <i class="fa fa-plus"></i>
                        {{trans('common.button.add')}}
                    </small>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>Title</th>
                    <th class="text-center" style="width: 50px">Type</th>
                    <th class="text-center" style="width: 100px">Total</th>
                    <th class="text-center" style="width: 140px">Total processing</th>
                    <th class="text-center" style="width: 120px">Total success</th>
                    <th class="text-center" style="width: 100px">Total fail</th>
                    <th class="text-center" style="width: 130px">Status</th>
                    <th class="text-center" style="width: 140px">Created at</th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <a href="{{ admin_url('notifications/'.$item->id.'/edit') }}">
                                    {{ $item->title }}

                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">{{ $item->type_text ?? 'Normal' }}</td>
                            <td class="text-center">{{ $item->total }}</td>
                            <td class="text-center">{{ $item->total_processing }}</td>
                            <td class="text-center">{{ $item->total_success }}</td>
                            <td class="text-center">{{ $item->total_fail }}</td>
                            <td class="text-center">
                                <a class="label label-{{ $item->status_color }} text-white">
                                    <i class="fa fa-check-circle-o"></i>
                                    {{ $item->status_text }}
                                </a>
                            </td>
                            <td class="text-center">{{ $item->created_at->format(config('app.date_format')) }}</td>
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
            </table>

            @include('admin.element.pagination')
        </div>
    </div>

@endsection

