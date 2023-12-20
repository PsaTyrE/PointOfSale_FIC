@if ($massage = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>x</span>
            </button>
            <p>{{ $massage }}</p>
        </div>
    </div>
@endif
