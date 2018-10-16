@extends ('layouts.master2')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <b>{{Auth::user()->employee->site->name}}</b>
                        <br> Own Site

                    </div>

                    <div class="card-body">
                        <h5>Site adatlap: </h5>
                        <img src="/storage/images/{{Auth::user()->employee->site->image}}" style="min-width: 120px " alt="User Image">
                        <table class=" table table-striped">
                            <tbody>

                            <tr>
                                <td><span><i class="fa fa-home"></i> Address:</span></td>
                                <td>{{Auth::user()->employee->site->address}}</td>
                            </tr>

                            <tr>
                                <td><span><i class="fa fa-phone"></i> Phone</span></td>
                                <td>{{ Auth::user()->employee->site->phone_number}}</td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-child"></i> Leader</span></td>
                                <td>{{ Auth::user()->employee->site->leader}}</td>
                            </tr>
                            </tbody>
                        </table>
                            <p>Lista az itt dolgozókról..</p>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection