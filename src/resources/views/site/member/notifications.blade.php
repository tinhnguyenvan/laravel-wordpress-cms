@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td style="width: 50px"></td>
                <td>Title</td>
                <td style="width: 170px">Created at</td>
                <td style="width: 170px">Read at</td>
                <td class="text-center" style="width: 150px">Status</td>
                <td style="width: 200px"></td>
            </tr>
            </thead>
            <tbody>
            @if($member->notifications->count() > 0)
                @foreach($member->notifications as $key => $notification)

                    <tr>
                        <td class="text-center">{{ ($key + 1 ) }}</td>
                        <td>
                            {{ $notification->data['title'] ?? '' }}
                        </td>
                        <td>{{ !empty($notification->created_at) ? $notification->created_at->format('d/m/Y H:i A') : '' }}</td>
                        <td>{{ !empty($notification->read_at) ? $notification->read_at->format('d/m/Y H:i A') : '' }}</td>
                        <td class="text-center">
                            @if(empty($notification->read_at))
                                <label class="label label-warning">Unread</label>
                            @else
                                <label class="label label-primary">Read</label>
                            @endif

                        </td>
                        <td class="text-center">
                            @if(empty($notification->read_at))
                                <form method="post"
                                      action="{{ base_url('member/notification/'.$notification->id.'/make-read' ) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="fa fa-check-square-o"></i> Make read
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        {{ trans('common.data_empty') }}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection