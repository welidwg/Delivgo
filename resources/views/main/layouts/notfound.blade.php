@if (isset($cart))
    <div class="offcanvas-header">
        <button type="button" class="btn text-dark  bg-light rounded-circle border-1 "
            style="position: absolute;top: 20px;left: -15px;z-index: 2;" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fad fa-angle-right" style="font-size: 25px"></i></button>
    </div>
@endif

<div class="p-3 d-flex flex-column align-items-center">
    @if (isset($message))
        <h3 class="fw-bold ">{{ $message }}</h3>
    @endif
    <img src="{{ asset('images/notfound.png') }}" class="img-fluid" width="300px" alt="">

</div>
