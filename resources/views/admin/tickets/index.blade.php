@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url('/tickets/create')}}"> Create ticket</a>
                @if (session('status'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>{{$ticket->name}}</td>
                            <td><a href="{{url('tickets/edit/'.$ticket->id)}}">edit</a></td>
                            <td><a onclick="openModel('{{$ticket->id}}','{{$ticket->name}}')">delete</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td> Geen ticket gevonden</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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
                        <h4 class="modal-title">Modal Header</h4>
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
    <script>
        function openModel(id, name) {
            $("#url").attr("action", '{{url('/')}}/tickets/destroy/' + id);
            $("#name").text(name);

            $("#openModal").modal();
        }
    </script>
@endsection