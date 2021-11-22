@extends('admin.layouts.master')
@section('konten')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $title }}</h3>

        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-warning btn-xs btn-refresh"><i class="fa fa-refresh"></i></button>
        </div>
        <div class="panel-body">
            <embed src="{{ $data->getFile() }}" type="application/pdf" width="100%" height="500px">
            <p class="gde-text"><a href="{{ $data->getFile() }}" class="gde-link">Download (PDF,
                    {{ $data->judul_buku }})</a></p>


        </div>
    </div>

@endsection
@section('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            // btn refresh
            $('.btn-refresh').click(function(e) {
                e.preventDefault();
                $('.preloader').fadeIn();
                location.reload();
            })

        });
    </script>


@endsection
