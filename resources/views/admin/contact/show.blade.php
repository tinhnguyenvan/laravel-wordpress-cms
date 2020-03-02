@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home-1"
                                   role="tab" aria-controls="home"
                                   aria-selected="true">
                                    ID #{{ $contact->id }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel">
                                <table class="table table-responsive-sm table-bordered">
                                    <tbody>
                                    <tr>
                                        <td style="width: 200px">{{ trans('contact.fullname') }}</td>
                                        <td>{{ $contact->fullname  }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('contact.phone') }}</td>
                                        <td>{{ $contact->phone  }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('contact.email') }}</td>
                                        <td>{{ $contact->email  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="th-created_at">{{ trans('contact.created_at') }}</td>
                                        <td>{{ $contact->created_at->format('d/m/Y H:s')  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="th-created_at">{{ trans('contact.request_content_form') }}</td>
                                        <td>{{ $contact->request_content_form  }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <a href="{{ admin_url('contacts') }}" class="btn btn-primary">
                                                <i class="fa fa-arrow-left"></i>
                                                {{trans('common.btn_back')}}
                                            </a>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
