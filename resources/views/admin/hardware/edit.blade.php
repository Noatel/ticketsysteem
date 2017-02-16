@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{url('/hardware/edit/'.$hardware->id)}}" method="POST">
            {{csrf_field()}}
            <div class="col-md-6">
                <h4>Hardware toevoegen</h4>
                <form action="{{url("hardware/store")}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="usr"> Naam:</label>
                        <input type="text" value="{{$hardware->name}}" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="usr"> omschrijving:</label>
                            <textarea name="description" class="form-control"
                                      rows="5">{{$hardware->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr"> Hoeveelheid:</label>
                        <input type="text" class="form-control" name="amount" id="exampleInputAmount" placeholder="5" value="{{$hardware->amount}}">
                    </div>
                    <div class="form-group">
                        <label for="usr"> Inkoopprijs:</label>
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="text" class="form-control" name="purchase_price" id="exampleInputAmount" placeholder="0,00" value="{{$hardware->purchase_price}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr"> Verkoopprijs:</label>
                        <div class="input-group">
                            <div class="input-group-addon">€</div>
                            <input type="text" class="form-control" name="selling_price"  id="exampleInputAmount" placeholder="0,00" value="{{$hardware->selling_price}}">
                        </div>
                    </div>
                    <input type="hidden" name="ticket_id" value="{{$hardware->tickets[0]->id}}">
                    <button type="submit" class="btn btn-default pull-right ">Hardware bewerken</button>
                </form>
            </div>
        </form>

    </div>
@endsection