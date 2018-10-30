@extends ('layouts.master2')

@section ('content')
    <div id="app" >
        <index_suppliers></index_suppliers>
    </div>

    @include ('layouts.errors')

@endsection


{{--@extends ('layouts.master')--}}

{{--@section ('content')--}}

    {{--<div class="container">--}}
        {{--<h1>Dolgozók adatai</h1>--}}
    {{--</div>--}}

    {{--<div class="container">--}}

        {{--@foreach($people as $person)--}}
        {{--<ul class="list-group list-inline">--}}
            {{--<li class="list-group-item list-group-flush">--}}
                {{--<div >--}}
                    {{--<div class="card flex-md-row mb-20  h-md-250">--}}
                        {{--<img src="https://d30y9cdsu7xlg0.cloudfront.net/png/212110-200.png" alt="profile" style="width:100px;height:100px">--}}
                        {{--<ul>--}}
                            {{--<li> {{$person->name}}</li>--}}
                            {{--<li> {{$person->email}} </li>--}}
                            {{--<li> {{$person->born}} </li>--}}
                            {{--<li> {{$person->created_at}} </li>--}}
                            {{--<li> {{$person->updated_at}} </li>--}}
                        {{--</ul>--}}
                        {{--<div class="container">--}}
                            {{--<form method="POST" action="/people/{{$person->id}}">--}}
                                {{--{{csrf_field()}}--}}
                                {{--<button  class="btn btn-danger">Delete</button>--}}
                            {{--</form>--}}
                            {{--<a href="/people/{{$person->id}}/edit" class="button">Edit</a>--}}
                        {{--</div>--}}

                        {{--{{$person->printSubalterns($person->subalterns)}}--}}

                        {{--{{ Form::open(array('url' => 'people/index' . $person->id, 'class' => 'pull-right')) }}--}}
                        {{--{{ Form::hidden('_method', 'DELETE') }}--}}
                        {{--{{ Form::submit('Delete this Person', array('class' => 'btn btn-warning')) }}--}}
                        {{--{{ Form::close() }}--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
        {{--@endforeach--}}
    {{--</div>--}}

{{--@endsection--}}

