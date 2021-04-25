<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;

class TicketController extends Controller
{

    /**
     * destroy method
     *
     * Return tickets from user auth
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = auth()->user()->tickets;

        return response()->json([
            'success' => true,
            'data' => $tickets
        ], 200);
    }

    /**
     * destroy method
     *
     * Return ticekt data by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * store method
     *
     * Create a new ticket
     *
     * @return \Illuminate\Http\Response
     */
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
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ticket not added'
            ], 500);
    }

    /**
     * destroy method
     *
     * Update a existing ticket by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = auth()->user()->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        $updated = $ticket->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Ticket can not be updated'
            ], 500);
    }

    /**
     * destroy method
     *
     * Delete ticket by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = auth()->user()->tickets()->find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        if ($ticket->delete()) {
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ticket can not be deleted'
            ], 500);
        }
    }
}
