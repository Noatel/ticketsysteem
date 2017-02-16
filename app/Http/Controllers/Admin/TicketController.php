<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TicketController extends Controller
{
    public function index()
    {

        $tickets = Ticket::all();


        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {

        $now = Carbon::now();
        $dateArr = explode(' ', $now);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $now = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];

        $customers = Customer::all();


        return view('admin.tickets.create', compact('now', 'customers'));
    }

    public function edit($id)
    {

        $ticket = Ticket::where('id','=',$id)->with('acties','customers','hardware')->first();
        $dateArr = explode(' ', $ticket->date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];
        $ticket->date = $newDate;

        $now = Carbon::now();
        $dateArr = explode(' ', $now);
        $date = $dateArr[0];
        $time =  substr($dateArr[1], 0, -3);
        $dateArr = explode('-', $date);
        $now = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];

        $customers = Customer::all();


        return view('admin.tickets.edit', compact('now', 'customers','ticket','time'));
    }

    public function store(Request $request)
    {

        $dateArr = explode(' ', $request->date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];

        $ticket = new Ticket();
        $ticket->status_id = $request->status;
        $ticket->name = $request->name;
        $ticket->date = $newDate;
        $ticket->description = $request->description;
        $ticket->save();

        $ticket->customers()->attach($request->customer);

        return redirect('tickets')->with('status', 'Ticket toegevoegd');
    }
    public function update(Request $request,$id)
    {
        $dateArr = explode(' ', $request->date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];

        $ticket = Ticket::where('id','=',$id)->first();
        $ticket->status_id = $request->status;
        $ticket->name = $request->name;
        $ticket->date = $newDate;
        $ticket->description = $request->description;
        $ticket->save();
        $ticket->customers()->detach();
        $ticket->customers()->attach($request->customer);

        return Redirect::back()->with('status', 'Ticket bewerkt!');
    }
    public function destroy($id){
        $ticket = Ticket::where('id','=',$id)->first();
        $ticket->delete();

        return redirect('tickets')->with('status', 'Succesvol verwijderd!');
    }
}
