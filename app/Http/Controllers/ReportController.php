<?php

namespace App\Http\Controllers;

use App\Client;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     *
     *
     * @return View
     */
    public function index()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $tickets = Ticket::select([
            DB::raw('COUNT(id) AS tickets'),
            DB::raw('DATE(created_at) AS date'),
        ])

            ->whereBetween('tickets.updated_at', [
                $start->format('Y-m-d'),
                $end->format('Y-m-d'),
            ])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'DESC')
            ->get()
            ->toArray();

        $week_array = [];
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $week_array[$date->format('m/Y')][$date->weekOfMonth][$date->format('d/m/Y')] = 0;
        }

        foreach ($tickets as $ticket) {
            $date = Carbon::createFromFormat('Y-m-d', $ticket['date']);
            if (isset($week_array[$date->format('m/Y')]) && isset($week_array[$date->format('m/Y')][$date->weekOfMonth]) && isset($week_array[$date->format('m/Y')][$date->weekOfMonth][$date->format('d/m/Y')])) {
                $week_array[$date->format('m/Y')][$date->weekOfMonth][$date->format('d/m/Y')] += $ticket['tickets'];
            }
        }

        $week_first_days = [];
        foreach ($week_array as $monthDays) {
            foreach ($monthDays as $item) {
                $date = array_keys($item)[0];

                foreach ($item as $key => $value) {
                    if (isset($week_first_days[$date])) {
                        $week_first_days[$date] += $value;
                    } else {
                        $week_first_days[$date] = $value;
                    }
                }
            }
        }

        $lastTickets = [];
        $lastTickets['tickets'] = array_values($week_first_days);
        $lastTickets['date'] = array_keys($week_first_days);

//////////////////////////////////////////////////////////////////////

        $start = Carbon::today()->subMonth();
        $end = Carbon::today()->addDay();

        $ticketsComplete = Ticket::select([
            DB::raw('COUNT(tickets.id) AS tickets'),
            'clients.client AS date',
        ])
            ->join('clients', 'clients.id', '=', 'tickets.client_id')
            ->where('tickets.status', 'Complete')

            ->whereBetween('tickets.updated_at', [
                $start->format('Y-m-d'),
                $end->format('Y-m-d'),
            ])
            ->groupBy(DB::raw('tickets.client_id'))
            ->get()
            ->toArray();

        $lastTicketsCompleted = [
            'tickets' => [],
            'date' => [],
        ];
        foreach ($ticketsComplete as $ticketComplete) {
            $lastTicketsCompleted['tickets'][] = $ticketComplete['tickets'];
            $lastTicketsCompleted['date'][] = $ticketComplete['date'];
        }

//////////////////////////////////////////////////////////////////////

        $start = Carbon::today()->subWeek();
        $end = Carbon::today()->addDay();

        $ticketsCompletePerUser = Ticket::select([
            DB::raw('COUNT(tickets.id) AS tickets'),
            'users.name AS date',
        ])
            ->join('clients', 'clients.id', '=', 'tickets.client_id')
            ->join('users', 'users.id', '=', 'clients.user_id')
            ->where('tickets.status', 'Complete')
//            ->whereHas('client', function ($query)
        //            {
        //                $query->where('user_id', auth()->id());
        //            })
            ->whereBetween('tickets.updated_at', [
                $start->format('Y-m-d'),
                $end->format('Y-m-d'),
            ])
            ->groupBy(DB::raw('clients.user_id'))
            ->get()
            ->toArray();

        $lastTicketsCompletePerUser = [
            'tickets' => [],
            'date' => [],
        ];
        foreach ($ticketsCompletePerUser as $ticketComplete) {
            $lastTicketsCompletePerUser['tickets'][] = $ticketComplete['tickets'];
            $lastTicketsCompletePerUser['date'][] = $ticketComplete['date'];
        }

        return view('report.index', compact('lastTickets', 'lastTicketsCompleted', 'lastTicketsCompletePerUser'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function exportClients()
    {
        $filename = time();
        $headers = array(
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=clients_' . $filename . '.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        );

        $clients = Client::all();

        $columns = array(
            'client',
            'supporttype',
            'email',
            'telephone',
            'address',
            'city',
            'postcode',
            'servers',
            'workstations',
            'printers',
            'notes',
            'created_at',
        );

        $callback = function () use ($clients, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($clients as $client) {
                fputcsv($file, array(
                    $client->client,
                    $client->supporttype,
                    $client->email,
                    $client->telephone,
                    $client->address,
                    $client->city,
                    $client->postcode,
                    $client->servers,
                    $client->workstations,
                    $client->printers,
                    $client->notes,
                    $client->created_at->format('d/m/Y'),
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response
     */
    public function exportTickets(Request $request)
    {
        $filename = time();
        $headers = array(
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=tickets_' . $filename . '.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        );

        switch ($request->get('period')) {
            case 'week':
                $tickets = Ticket::where(
                    'created_at', '>=', Carbon::now()->subWeek()->toDateTimeString()
                )->get();
                break;

            case 'month':
                $tickets = Ticket::where(
                    'created_at', '>=', Carbon::now()->subMonth()->toDateTimeString()
                )->get();
                break;

            case 'year':
                $tickets = Ticket::where(
                    'created_at', '>=', Carbon::now()->subYear()->toDateTimeString()
                )->get();
                break;

            default:
                $tickets = Ticket::where(
                    'created_at', '>=', Carbon::now()->subMonth()->toDateTimeString()
                )->get();
                break;
        }

        $columns = array(
            'client_id',
            'callername',
            'title',
            'description',
            'status',
            'timelength',
            'createdby',
            'chargeable',
            'created_at',
        );

        $callback = function () use ($tickets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tickets as $ticket) {
                fputcsv($file, array(
                    $ticket->client_id,
                    $ticket->callername,
                    $ticket->title,
                    $ticket->description,
                    $ticket->status,
                    $ticket->timelength,
                    $ticket->createdby,
                    $ticket->chargeable,
                    $ticket->created_at->format('d/m/Y'),
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
