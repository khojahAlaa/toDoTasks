<div class="col-md-12">
    @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert">
                    <i class="fa fa-times"></i>
                </div>
                <div class="alert-message">
                    <span><strong>Success!</strong> {{ $message }}</span>
                </div>
            </div>
            @endif
            {!! Session::forget('success') !!}
            @if($message = Session::get('msg'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div class="alert-icon contrast-alert">
                    <i class="fa fa-times"></i>
                </div>
                <div class="alert-message">
                    <span><strong>opps!</strong> {{ $message }}</span>
                </div>
            </div>
            @endif
            {!! Session::forget('msg') !!}
            
</div>