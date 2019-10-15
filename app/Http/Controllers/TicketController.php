<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\TicketUpdateRequest;
use App\Ticket;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|array
     */
    public function index(Request $request)
    {
        $page = 10;

        if ($request->ajax()) {
            $query = $request->get('query');

            if ($query !== '') {
//                ->orWhereHas('client', function ($q) use ($query) {
//                    $q->orWhere('client', 'like', '%' . $query . '%');
//                });
                $tickets = Ticket::select('clients.client', 'tickets.id', 'tickets.title', 'tickets.callername', 'tickets.description', 'tickets.status', 'tickets.created_at')
                    ->join('clients', 'client_id', 'clients.id')
                    ->where('clients.client', 'like', '%' . $query . '%')
                    ->orWhere('tickets.title', 'like', '%' . $query . '%')
                    ->orWhere('tickets.callername', 'like', '%' . $query . '%')
                    ->orWhere('tickets.description', 'like', '%' . $query . '%')
                    ->orWhere('tickets.status', 'like', '%' . $query . '%')
                    ->orWhere('tickets.created_at', 'like', '%' . $query . '%');
            } else {
                $tickets = Ticket::all();
            }

            $tickets = $tickets
                ->with('client')
                ->orderBy('client')
                ->paginate($page);

            $pagination_html = $tickets->render();
            $total = $tickets->total();

            $tickets = $tickets->map(function ($row) {
                return [
                    'id'         => $row->id,
                    'client'     => $row->client,
                    'callername' => $row->callername,
                    'title'      => $row->title,
                    'status'     => $row->status,
                    'created_at' => $row->created_at->format('d-m-Y'),
                ];
            });

            return [
                'tickets'    => $tickets->toArray(),
                'total'      => $total,
                'pagination' => $pagination_html->toHtml()
            ];
        }

        $tickets = Ticket::with('client')
            ->latest()
            ->paginate($page);

        return view('tickets.index', compact('tickets'))
            ->with('i', ($request->get('page', 1) - 1) * $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public
    function create()
    {
        $clients = Client::get()->sortBy('client');

        return view('tickets.create', ['clients' => $clients]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketUpdateRequest $request
     * @return Response
     */
    public
    function store(TicketUpdateRequest $request)
    {
        Ticket::create([
            'client_id'   => request('client_id'),
            'callername'  => request('callername'),
            'createdby'   => request('createdby'),
            'status'      => request('status'),
            'title'       => request('title'),
            'type'        => request('type'),
            'description' => request('description'),
            'solution'    => request('solution'),
            'timelength'  => request('timelength'),
            'chargeable'  => request('chargeable'),
        ]);

        return redirect()->route('tickets.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public
    function show(Ticket $ticket)
    {
        $clients = Client::get()->sortBy('client');

        return view('tickets.show', compact('ticket', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public
    function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     */
    public
    function update(TicketUpdateRequest $request, Ticket $ticket)
    {

        //updates new info in edit form of tickets
        $ticket->client_id = request('client_id');
        $ticket->callername = request('callername');
        $ticket->createdby = request('createdby');
        $ticket->status = request('status');
        $ticket->title = request('title');
        $ticket->type = request('type');
        $ticket->description = request('description');
        $ticket->solution = request('solution');
        $ticket->timelength = request('timelength');
        $ticket->chargeable = request('chargeable');
        $ticket->save();

        return redirect()->route('tickets.index')->withSuccess('Ticket has been updated successfully!');

    }

    public
    function delete(Ticket $ticket)
    {
        return view('tickets.delete', compact('ticket'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public
    function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->withSuccess('Ticket has been deleted successfully!');
    }
}
