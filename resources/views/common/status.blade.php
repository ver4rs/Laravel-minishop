@if(session('status'))
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Success</h4>
                <ul>
                    <li>{{ session('status') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

@if (isset($errors) && count($errors) > 0)
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                    Error
                </h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
