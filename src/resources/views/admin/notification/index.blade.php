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
        </div>
        <div class="card-body">
            @include('admin.element.filter')

            <table class="table table-responsive-sm table-bordered table-hover font12">
                <thead>
                <tr class="bg-light">
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if ($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
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

