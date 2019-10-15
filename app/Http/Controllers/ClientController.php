<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientUpdateRequest;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
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
                $clients = Client::where('client', 'like', '%' . $query . '%')
                    ->orWhere('telephone', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('supporttype', 'like', '%' . $query . '%');
            } else {
                $clients = Client::all();
            }

            $clients = $clients
                ->orderBy('client')
                ->paginate($page);

            $pagination_html = $clients->render();
            $total = $clients->total();

            $clients = $clients->map(function ($row) {
                return [
                    'id'          => $row->id,
                    'client'      => $row->client,
                    'telephone'   => $row->telephone,
                    'email'       => $row->email,
                    'supporttype' => $row->supporttype,
                    'created_at'  => $row->created_at->format('d-m-Y'),
                ];
            });

            return [
                'clients'    => $clients->toArray(),
                'total'      => $total,
                'pagination' => $pagination_html->toHtml()
            ];
        }

        $clients = Client::orderBy('client')->paginate($page);

        return view('clients.index', compact('clients'))
            ->with('i', ($request->get('page', 1) - 1) * $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('clients.create-client');

    }

    public function delete(Client $client)
    {
        return view('clients.delete-client', compact('client'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientUpdateRequest $request
     * @return Response
     */
    public function store(ClientUpdateRequest $request)
    {
        Client::create([
            'client'       => request('client'),
            'supporttype'  => request('supporttype'),
            'email'        => request('email'),
            'telephone'    => request('telephone'),
            'address'      => request('address'),
            'city'         => request('city'),
            'postcode'     => request('postcode'),
            'servers'      => request('servers'),
            'workstations' => request('workstations'),
            'printers'     => request('printers'),
            'notes'        => request('notes'),
            'user_id'      => auth()->id()

        ]);

        return redirect()->route('clients.index');


    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return Response
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateRequest $request
     * @param Client $client
     * @return Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->client = request('client');
        $client->supporttype = request('supporttype');
        $client->email = request('email');
        $client->telephone = request('telephone');
        $client->address = request('address');
        $client->city = request('city');
        $client->postcode = request('postcode');
        $client->servers = request('servers');
        $client->workstations = request('workstations');
        $client->printers = request('printers');
        $client->notes = request('notes');
        $client->save();

        return redirect()->route('clients.index')->withSuccess('Client has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     * @throws Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->withSuccess('Client has been deleted successfully!');
    }
}
