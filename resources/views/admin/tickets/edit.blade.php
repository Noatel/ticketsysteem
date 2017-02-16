@extends('layouts.admin')

@section('content')
    <div class="section">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{url('/tickets/update/'.$ticket->id)}}" method="POST">
                {{csrf_field()}}
                <h4>Overzicht</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usr">Name:</label>
                            <input type="text" name='name' value="{{$ticket->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sel1">Gebruikers:</label>
                            <select class="form-control" name="customer">
                                @forelse($customers as $customer)
                                    <option @if($ticket->customers[0]->name == $customer->name) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                                @empty
                                    <option value="">Geen gebruikers beschikbaar</option>
                                @endforelse

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Status:</label>
                            <select class="form-control" name="status">
                                <option @if($ticket->status_id == '1') selected @endif value="1">In behandeling</option>
                                <option @if($ticket->status_id == '2') selected @endif value="2">Wachten op medewerker
                                </option>
                                <option @if($ticket->status_id == '3') selected @endif value="3">Wachten op klant
                                </option>
                                <option @if($ticket->status_id == '4') selected @endif value="4">Voltooid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Datum:</label>
                            <input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
                                   name="date" value="{!! $ticket->date !!}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usr">Probleem omschrijving:</label>
                            <textarea name="description" class="form-control"
                                      rows="5">{{$ticket->description}}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-default pull-right">Ticket bewerken</button>

            </form>
            <hr>


            <div class="row">
                <div class="col-md-6">
                    <h4>Actie toevoegen</h4>
                    <form action="{{url("actions/store")}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Datum:</label>
                            <input type="text" id="actie_date" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
                                   name="actie_date" value="{!! $ticket->date !!}">
                        </div>
                        <div class="form-group">
                            <label for="usr"> omschrijving:</label>
                            <textarea name="description" class="form-control"
                                      rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>van:</label>
                            <input type="text" id="actie_start" data-format="HH:mm" data-template="HH : mm"
                                   name="actie_start" value="{!! $time !!}">
                        </div>
                        <div class="form-group">
                            <label>tot:</label>
                            <input type="text" id="actie_until" data-format="HH:mm" data-template="HH : mm"
                                   name="actie_until" value="{!! $time !!}">
                        </div>
                        <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                        <button type="submit" class="btn btn-default ">Actie toevoegen</button>
                    </form>
                </div>
                    <div class="col-md-6">
                        <h4>Hardware toevoegen</h4>
                        <form action="{{url("hardware/store")}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="usr"> Naam:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="usr"> omschrijving:</label>
                            <textarea name="description" class="form-control"
                                      rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="usr"> Hoeveelheid:</label>
                                    <input type="text" class="form-control" name="amount" id="exampleInputAmount" placeholder="5">
                            </div>
                            <div class="form-group">
                                <label for="usr"> Inkoopprijs:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" class="form-control" name="purchase_price" id="exampleInputAmount" placeholder="0,00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usr"> Verkoopprijs:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">€</div>
                                    <input type="text" class="form-control" name="selling_price"  id="exampleInputAmount" placeholder="0,00">
                                </div>
                            </div>
                            <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                            <button type="submit" class="btn btn-default pull-right ">Hardware toevoegen</button>
                        </form>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h4>Acties overzicht</h4>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($ticket->acties as $actie)
                            <tr>
                                <td>{{$actie->description}}</td>
                                <td><a href="{{url('actions/edit/'.$actie->id)}}">edit</a></td>
                                <td><a onclick="openModel('{{$actie->id}}','{{$actie->description}}')">delete</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td> Geen acties gevonden</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Hardware overzicht</h4>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($ticket->hardware as $hardware)
                            <tr>
                                <td>{{$hardware->name}}</td>
                                <td><a href="{{url('hardware/edit/'.$hardware->id)}}">edit</a></td>
                                <td><a onclick="openModel('{{$hardware->id}}','{{$hardware->description}}')">delete</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td> Geen acties gevonden</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="openModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->

            <div class="modal-content">
                <form action="" id="url" method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Actie verwijderen</h4>
                    </div>
                    <div class="modal-body">
                        <p>Weet je het zeker dat je <b><span id="name"></span></b> wilt verwijderen</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" value="Verwijder">
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/admin/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/combodate.js')}}"></script>

    <script>
        function openModel(id, name) {
            $("#url").attr("action", '{{url('/')}}/actions/destroy/' + id);
            $("#name").text(name);

            $("#openModal").modal();
        }

        $('#date').combodate({
            minYear: 2000,
            maxYear: 2025,
        });
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