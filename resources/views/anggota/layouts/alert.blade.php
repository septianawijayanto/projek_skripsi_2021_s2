@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-info-circle"></i> {{$message}}
</div>
@endif

@if($message=Session::get('sukses'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-check-circle"></i> {{$message}}
</div>
@endif

@if($message=Session::get('peringatan'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-warning"></i> {{$message}}
</div>
@endif

@if($message=Session::get('gagal'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-times-circle"></i> {{$message}}
</div>
@endif