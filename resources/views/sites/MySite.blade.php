@extends ('layouts.master2')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        Saját telephely adatlapja:  <h5>{{Auth::user()->employee->site->name}}</h5>


                    </div>

                    <div class="card-body">

                        <img src="/storage/images/{{Auth::user()->employee->site->image}}" style="max-width: 220px; margin: auto; display: block; margin-bottom: 10px " alt="User Image">
                        <table class=" table table-striped">
                            <tbody>

                            <tr>
                                <td><span><i class="fa fa-home"></i> Address:</span></td>
                                <td>{{Auth::user()->employee->site->address}}</td>
                            </tr>

                            <tr>
                                <td><span><i class="fa fa-phone"></i> Phone: </span></td>
                                <td>{{ Auth::user()->employee->site->phone_number}}</td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-user-secret"></i> Leader: </span></td>
                                <td><h5>{{ Auth::user()->employee->site->leader->last_name}} {{ Auth::user()->employee->site->leader->first_name}}</h5>
                                    <span><i class="fa fa-phone"> {{ Auth::user()->employee->site->leader->phone_number}}</i></span>
                                    <br><span><i class="fa fa-address-book"> {{ Auth::user()->employee->site->leader->email}}</i></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h5>Dolgozók</h5>
                        <div id="app" >
                            <site_employees :siteid="null"></site_employees>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection