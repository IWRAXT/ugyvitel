@extends ('layouts.master2')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header"><b>{{ Auth::user()->name }} </b>({{ Auth::user()->permission->name }}) <br> Home page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <img src="/images/{{ Auth::user()->employee->image }}" style="" alt="User Image">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

