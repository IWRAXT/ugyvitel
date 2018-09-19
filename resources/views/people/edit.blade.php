@extends ('layouts.master')

@section ('content')
    <div class="col-lg-8">
        <h1>Alkalmazott adatok szerkesztése</h1>

        <form method="POST" action="/people/{{ $person->id }}/update" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label for="name">Név</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$person->name}}">

            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$person->email}}">
            </div>
            <div class="form-group">
                <label for="born">Született</label>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>



        </form>
    </div>
@endsection