@extends('layouts.admin')

@section('content')

    <div class="section">
        <div class="container">
            <a href="{{url('/customers')}}"> Keer terug</a>

            <form action="{{url('/customers/store')}}" method="POST">
                {{csrf_field()}}
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">



                        <div class="form-group">
                            <label for="usr">Name:</label>
                            <input type="text"  name='name' class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Toevoegen</button>

            </form>
        </div>
    </div>
@endsection
@section('scripts')

@endsection