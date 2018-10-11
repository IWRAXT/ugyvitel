@extends ('layouts.master2')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <b>{{ Auth::user()->name }} </b>{{ Auth::user()->employee->job }} ({{ Auth::user()->permission->name }})
                    <br> Home page </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>User adatlap: </p>
                        <img src="storage/images/{{ Auth::user()->employee->image }}" style="max-width: 120px " alt="User Image">
                        <p>{{ Auth::user()->employee->email }}</p>
                        <p>{{ Auth::user()->employee->address }}</p>
                        <p>{{ Auth::user()->employee->born }}</p>
                        <p>{{ Auth::user()->employee->phone_number }}</p>
                        <p>{{ Auth::user()->employee->salary }}</p>

                        <button>Személyes adatok módosítása</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

