<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Exibir uma lista com todos os tickets
    */
    public function index()
    {
        $tickets = Ticket::all();
        // return response()->json($tickets);
        return view('tickets.index', compact("tickets"));
    }

    /**
     * Exibir o formulário para criar um novo ticket.
    */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Armazena um novo ticket no banco de dados
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string', 'max:255'],
            'description' => ['required','string'],
            'status' => ['required','in:open,in_progress,closed'],
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'title'=> $request->title,
            'description'=> $request->description,
            'status'=> $request->status
        ]);

        // return response()->json($ticket,201);
        return redirect()->route('tickets.index')->with('success','Ticket criado com sucesso');
    }

    /**
     * Exibir um ticket específico.
    */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json($ticket);
    }

    /**
     * Exibir formulário para editar um ticket
    */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Atualizar um ticket no banco de dados
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:open, in_progress, closed'],
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'user_id'=> auth()->id(),
            'title'=> $request->title,
            'description'=> $request->description,
            'status' => $request->status,
        ]);

        // return response()->json($ticket);
        return redirect()->route('ticket.index')->with('success','Ticket atualizado com sucesso.');
    }

    /**
     * Excluir um ticket do banco de dados
    */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        // return response()->json(['message' => 'Ticket deleted successfully']);
        return redirect()->route('tickets.index')->with('success', 'Ticket excluído com sucesso.');
    }
}
