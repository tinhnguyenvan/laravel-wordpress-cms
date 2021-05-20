@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ admin_url('roles/permission') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('common.list') }} ({{ $itemRoles->count() }})
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                                <th></th>
                                @if ($itemRoles->count() > 0)
                                    @foreach ($itemRoles as $role)
                                        <th class="text-primary text-center">
                                            {{ $role->description }}
                                        </th>
                                    @endforeach
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @if ($itemPermissions->count() > 0)
                                @foreach ($itemPermissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        @if ($itemRoles->count() > 0)
                                            @foreach ($itemRoles as $role)
                                                @php
                                                    $permissionIds = collect($role->role_permissions->toArray())
                                                @endphp
                                                <td class="text-center">
                                                    <label for="id"></label>
                                                    @if($role->id == 1)
                                                        <input type="hidden"
                                                               name="role[{{$role->id}}][{{$permission->id}}]"
                                                               value="{{ $permission->id }}"/>
                                                        <input type="checkbox" checked id="id" disabled readonly/>
                                                    @else
                                                        <input type="checkbox"
                                                               name="role[{{$role->id}}][{{$permission->id}}]"
                                                               @if($permissionIds->contains('permission_id', $permission->id))
                                                               checked
                                                               @endif
                                                               id="id"
                                                               value="{{ $permission->id }}"/>
                                                    @endif
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="{{ $itemRoles->count() + 1 }}">
                                    <div class="form-actions">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-save"></i>
                                            {{ trans('common.save') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
