@extends ('layouts.master2')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div id="app">
                    <my_user></my_user>
                </div>
            </div>
        </div>
    </div>
    @include ('layouts.errors')
@endsection

