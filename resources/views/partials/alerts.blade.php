@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    <button
        type="button"
        class="close"
        data-dismiss="alert">

        <span>&times;</span>

    </button>

    <i class="icon fas fa-check"></i>

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    <button
        type="button"
        class="close"
        data-dismiss="alert">

        <span>&times;</span>

    </button>

    <i class="icon fas fa-ban"></i>

    {{ session('error') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-warning alert-dismissible fade show">

    <button
        type="button"
        class="close"
        data-dismiss="alert">

        <span>&times;</span>

    </button>

    <i class="icon fas fa-exclamation-triangle"></i>

    <ul class="mb-0">

        @foreach($errors->all() as $error)

        <li>

            {{ $error }}

        </li>

        @endforeach

    </ul>

</div>

@endif