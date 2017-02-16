@extends('layouts.admin')

@section('content')
    <div class="section">
        <div class="container">

            <form action="{{url('/tickets/store')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usr">Name:</label>
                            <input type="text"  name='name' class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sel1">Select list:</label>
                            <select class="form-control" name="customer">
                                @forelse($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @empty
                                    <option value="">Geen customers beschikbaar</option>
                                @endforelse

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Status:</label>
                            <select class="form-control" name="status">
                                <option value="1">In behandeling</option>
                                <option value="2">Wachten op medewerker</option>
                                <option value="3">Wachten op klant</option>
                                <option value="4">Voltooid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Datum:</label>
                            <input type="text" id="start" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
                                   name="date" value="{!! $now !!}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usr">Probleem omschrijving:</label>
                            <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Toevoegen</button>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/combodate.js')}}"></script>

    <script>
        $('#start').combodate({
            minYear: 2000,
            maxYear: 2025,
        });
        $('#until').combodate({
            minYear: 2000,
            maxYear: 2025,
        });
    </script>
@endsection