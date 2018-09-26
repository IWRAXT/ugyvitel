@extends ('layouts.master2')

@section ('content')
    <div class="col-lg-8">
        <h1>Alkalmazott adatok szerkesztése</h1>

        <form method="POST" action="/people/{{ $person->id }}/update" enctype="multipart/form-data">
            {{csrf_field()}}

           <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{$person->last_name}}">
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{$person->first_name}}">
            </div>
            <div class="form-group">
                <label for="born">Born</label>
                <input type="date" class="form-control" id="born" name="born" value="{{$person->born}}">
            </div>
            <div class="form-group">
                <label for="file">Mostani profilképe: </label>
                <img src="/images/{{$person->image}}" style="width: 100px;height: auto ">
                <input type="file" class="form-control-file" id="file" name="file">
                <div class="checkbox">
                    <label><input type="checkbox" id="checkbox" name="delete" value="true">Profilkép törlése</label>
                </div>

            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$person->email}}" >
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$person->address}}">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$person->phone_number}}">
            </div>
            <div class="form-group">
                <label for="month_salary">Salary</label>
                <input type="number" class="form-control" id="month_salary" name="month_salary" value="{{$person->month_salary}}">
            </div>
            <div class="form-group">
                <label for="definite_employment">Definite employment</label>
                <input type="checkbox" class="form-control"  id="definite_employment" name="definite_employment" value="{{$person->definite_employment}}">
            </div>
            <div class="form-group">
                <label for="recruitment_date">Recruitment date</label>
                <input type="date" class="form-control" id="recruitment_date" name="recruitment_date" value="{{$person->recruitment_date}}">
            </div>
            <div class="form-group">
                <label for="job">Job</label>
                <input type="text" class="form-control" id="job" name="job" value="{{$person->job}}">
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <input type="text" class="form-control" id="comment" name="comment" value="{{$person->comment}}">
            </div>
            <div class="form-group">
                <label for="principal_id">Principal</label>
                <input type="number" class="form-control" id="principal_id" name="principal_id" value="{{$person->principal_id}}">
            </div>
            <div class="form-group">
                <label for="user_id">UserID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value="{{$person->user_id}}">
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>



        </form>
    </div>
@endsection