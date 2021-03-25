@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form method="POST"
                  action="{{ admin_url('contact_forms') }}{{ ($contact_form->id ?? 0) > 0 ?'/'.$contact_form->id: '' }}">
                @csrf
                @if (!empty($contact_form->id))
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
                        <table class="table table-responsive-sm table-bordered table-hover font12">
                    <thead>
                    <tr class="bg-light">
                                <th></th>
                                <th>{{ trans('contact.form_type') }}</th>
                                <th>{{ trans('common.status') }}</th>
                                <th>{{ trans('common.required') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label class="text-success">{{ trans('contact.form_title') }}</label>
                                </td>
                                <td>
                                    @include('admin.contact_form.form_type', ['name' => 'form_title_type', 'value' => $contact_form->form_title_type ?? 'input'])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_title_status', 'value' => $contact_form->form_title_status ?? ''])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_title_required',  'value' => $contact_form->form_title_required ?? ''])
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="text-success">{{ trans('contact.form_content') }}</label>
                                </td>
                                <td>
                                    @include('admin.contact_form.form_type', ['name' => 'form_content_type', 'value' => $contact_form->form_content_type ?? 'input'])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_content_status', 'value' => $contact_form->form_content_status ?? ''])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_content_required',  'value' => $contact_form->form_content_required ?? ''])
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="text-success">{{ trans('contact.form_fullname') }}</label>
                                </td>
                                <td>
                                    @include('admin.contact_form.form_type', ['name' => 'form_fullname_type', 'value' => $contact_form->form_fullname_type ?? 'input'])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_fullname_status', 'value' => $contact_form->form_fullname_status ?? ''])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_fullname_required',  'value' => $contact_form->form_fullname_required ?? ''])
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="text-success">{{ trans('contact.form_phone') }}</label>
                                </td>
                                <td>
                                    @include('admin.contact_form.form_type', ['name' => 'form_phone_type', 'value' => $contact_form->form_phone_type ?? 'input'])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_phone_status', 'value' => $contact_form->form_phone_status ?? ''])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_phone_required',  'value' => $contact_form->form_phone_required ?? ''])
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="text-success">{{ trans('contact.form_email') }}</label>
                                </td>
                                <td>
                                    @include('admin.contact_form.form_type', ['name' => 'form_email_type', 'value' => $contact_form->form_email_type ?? 'input'])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_email_status', 'value' => $contact_form->form_email_status ?? ''])
                                </td>
                                <td>
                                    @include('admin.element.form.check', ['name' => 'form_email_required',  'value' => $contact_form->form_email_required ?? ''])
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save"></i>
                                {{ trans('common.save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
