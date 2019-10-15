<?php

namespace App\Http\Controllers;

/**
 * Use the following Models to link to database
 */
use App\Client;
use App\Task;
use App\Ticket;

class DashboardController extends Controller
{

    public function index()
    {
        /**
         * Counting the total users on the system
         *
         * Paginate...
         *
         * Using ticket model find tickets which have status equal to open and count
         *
         * Using ticket model find tickets which have status equal to In Progress and count
         *
         * Using ticket model find tickets which have status equal to Complete and count
         */

        $tasks = Task::paginate(10);
        
        $clients = Client::all()->count();
        /// $tasks = Task::where('user_id', auth()->id())->paginate(7);
        $tickets_open = Ticket::where('status', 'Unresolved')->count();
        $tickets_progress = Ticket::where('status', 'In Progress')->count();
        $tickets_completed = Ticket::where('status', 'Complete')->count();

        /**
         * compact all these results/tasks together and send them to the front view
         */
        return view('dashboard.index', compact('clients', 'tasks', 'tickets_open', 'tickets_progress', 'tickets_completed'));
    }
}
