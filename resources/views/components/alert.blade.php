@if(Session::has('alert'))
    <div id="alert" class="alert alert-{{ Session::get('alert')['type'] }} alert-dismissible fade show" role="alert">
        {{ Session::get('alert')['message'] }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
