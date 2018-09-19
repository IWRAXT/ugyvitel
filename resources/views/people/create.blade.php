@extends ('layouts.master')

@section ('content')
    <div class="col-lg-8">
        <h1>Új alkalmazott rögzítése</h1>

        <form method="POST" action="/people" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            <div class="form-group">
                <label for="born">Born</label>
                <input type="date" class="form-control" id="born" name="born">
            </div>
            <div class="form-group">
                <label for="file">Picture</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="month_salary">Salary</label>
                <input type="number" class="form-control" id="month_salary" name="month_salary">
            </div>
            <div class="form-group">
                <label for="definite_employment">Definite employment</label>
                <input type="checkbox" class="form-control" value="1"  id="definite_employment" name="definite_employment">
            </div>
            <div class="form-group">
                <label for="recruitment_date">Recruitment date</label>
                <input type="date" class="form-control" id="recruitment_date" name="recruitment_date">
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <input type="text" class="form-control" id="comment" name="comment">
            </div>
            <div class="form-group">
                <label for="principal_id">Principal</label>
                <input type="number" class="form-control" id="principal_id" name="principal_id">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Rögzít</button>
            </div>

            @include ('layouts.errors')
        </form>
    </div>
@endsection