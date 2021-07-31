@extends('site.layout.member')
@section('content')
    <div class="content-panel">

        @if($member->notifications->count() > 0)
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
                </tbody>
            </table>
        @else
            @include('site.element.empty')
        @endif
    </div>
@endsection