<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;

class TicketController extends Controller
{

    // Return tickets from user auth
    public function index()
    {
        $tickets = auth()->user()->tickets;

        return response()->json([
            'success' => true,
            'data' => $tickets
        ], 200);
    }

    // Return data from specify id ticket
    public function show($id)
    {
        $ticket = auth()->user()->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found '
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ticket->toArray()
        ], 200);
    }

    // Create a new ticket
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $ticket = new Ticket();
        $ticket->title = $request->title;

        if (auth()->user()->tickets()->save($ticket))
            return response()->json([
                'success' => true,
                'data' => $ticket->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ticket not added'
            ], 500);
    }

    // Update a existing ticket
    public function update(Request $request, $id)
    {
        $ticket = auth()->user()->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 400);
        }

        $updated = $ticket->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ticket can not be updated'
            ], 500);
    }

    // Delete a ticket
    public function destroy($id)
    {
        $ticket = auth()->user()->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 400);
        }

        if ($ticket->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ticket can not be deleted'
            ], 500);
        }
    }
}
