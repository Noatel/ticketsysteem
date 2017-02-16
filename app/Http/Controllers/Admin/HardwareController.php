<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Hardware;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HardwareController extends Controller
{
    public function store(Request $request){

        $hardware = new Hardware();
        $hardware->name = $request->name;
        $hardware->amount = $request->amount;
        $hardware->selling_price = $request->selling_price;
        $hardware->purchase_price = $request->purchase_price;
        $hardware->save();

        $hardware->tickets()->attach($request->ticket_id);
        $ticket = Ticket::where("id",'=',$request->ticket_id)->first();

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
    public function edit($id)
    {

        $hardware = Hardware::where('id', '=', $id)->with('tickets')->first();


        return view('admin.hardware.edit', compact('hardware'));
    }
    public function update(Request $request,$id)
    {
        $hardware = Hardware::where('id','=',$id)->first();
        $hardware->name = $request->name;
        $hardware->amount = $request->amount;
        $hardware->selling_price = $request->selling_price;
        $hardware->purchase_price = $request->purchase_price;
        $hardware->save();

        $ticket = Ticket::where("id",'=',$request->ticket_id)->first();

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

}
