@extends('layout.default.layouts.app')
@section('content')
    <div class="container" style="margin: 20px auto">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1 class="display-4">Not found !</h1>
                    <p class="lead">Không tìm thấy nội dung nào phù hợp !</p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href="<?= base_url()?>" role="button">
                        <i class="fa fa-home"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
