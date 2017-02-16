<?php

namespace App\Http\Controllers\Admin;

use App\Actie;
use App\Customer;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ActionController extends Controller
{
    public function store(Request $request)
    {

        $dateArr = explode(' ', $request->actie_date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];


        $actie = new Actie();
        $actie->description = $request->description;
        $actie->date = $newDate;
        $actie->start = $request->actie_start;
        $actie->until = $request->actie_until;
        $actie->save();

        $ticket = Ticket::where('id', '=', $request->ticket_id)->first();
        $ticket->acties()->attach($actie->id);

        return Redirect::back()->with('status', 'Ticket toegevoegd');

    }

    public function edit($id)
    {

        $actie = Actie::where('id', '=', $id)->with('ticket')->first();

        $dateArr = explode(' ', $actie->date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];
        $actie->date = $newDate;

        return view('admin.acties.edit', compact('actie'));
    }

    public function update(Request $request, $id)
    {

        $dateArr = explode(' ', $request->actie_date);
        $date = $dateArr[0];
        $dateArr = explode('-', $date);
        $newDate = $dateArr[2] . '-' . $dateArr[1] . '-' . $dateArr[0];

        $actie = Actie::where('id', '=', $id)->first();
        $actie->description = $request->description;
        $actie->date = $newDate;
        $actie->start = $request->actie_start;
        $actie->until = $request->actie_until;
        $actie->save();

        $ticket = Ticket::where('id','=',$request->ticket_id)->first();
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

    public function destroy($id)
    {
        $actie = Actie::where('id', '=', $id)->first();
        $actie->delete();

        return Redirect::back()->with('status', 'Actie verwijderd');

    }
}
