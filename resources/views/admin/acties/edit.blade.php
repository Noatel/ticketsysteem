@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{url('/actions/edit/'.$actie->id)}}" method="POST">
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Datum:</label>
                    <input type="text" id="actie_date" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
                           name="actie_date" value="{!! $actie->date !!}">
                </div>
                <div class="form-group">
                    <label for="usr"> omschrijving:</label>
                            <textarea name="description" class="form-control"
                                      rows="5">{{$actie->description}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>van:</label>
                    <input type="text" id="actie_start" data-format="HH:mm" data-template="HH : mm"
                           name="actie_start" value="{!! $actie->start !!}">
                </div>
                <div class="form-group">
                    <label>tot:</label>
                    <input type="text" id="actie_until" data-format="HH:mm" data-template="HH : mm"
                           name="actie_until" value="{!! $actie->until !!}">
                </div>
            </div>
        </div>
            <input type="hidden" value="{{$actie->ticket[0]->id}}" name="ticket_id" >
        <input type="submit" class="btn btn-default pull-right" value="Bewerken">
        </form>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/combodate.js')}}"></script>

    <script>
        $('#actie_date').combodate({
            minYear: 2000,
            maxYear: 2025,
        });
        $('#actie_start').combodate({
            minYear: 2000,
            maxYear: 2025,
            steps: 15,
        });
        $('#actie_until').combodate({
            minYear: 2000,
            maxYear: 2025,
            steps: 15,
        });
    </script>

@endsection