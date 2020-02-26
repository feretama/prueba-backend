<?php

namespace App\Repositories;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ApiResponses;

class TicketRepository{

    use ApiResponses;

    public function createTicket($request){
        try {
            $ticket= Ticket::create([
                'ticket_pedido'=>$request['ticket_pedido'],
            ]);
            return $this->succesResponse($ticket,201);
        }catch(Exception $e){
            Log::info(["error al crear ticket"=>$e]);
            return $this->errorResponse("error al crear ticket",500);
        }
    }

    public function getAllTickets($request){
        try {
            $tickets=Ticket::all();
            if (isset($tickets)){
                return $tickets;
            }
            return $this->errorResponse("no existen tickets",404);
        }catch(Exception $e){
            Log::info(["error al obtener tickets"=>$e]);
            return $this->errorResponse("error al obtener todos los tickets",500);
        }
    }

    public function updateTicket($request){
        try {
            $ticket=Ticket::find($request["id_ticket"])->first();
            if (isset($ticket)){
                $ticket->ticket_pedido=$request["ticket_pedido"];
                $ticket->save();
                return $this->succesResponse($ticket,201);
            }return $this->errorResponse("Ticket no encontrado",404);
        }catch(Exception $e){
            Log::info(["error al actualizar ticket"=>$e]);
            return $this->errorResponse("error al actualizar ticket",500);
        }
    }

    public function deleteTicket($request){
        try{
            $ticket=Ticket::find($request["id_ticket"])->first();
            if (isset($ticket)){
                $ticket->delete();
                return $this->succesResponse("ticket borrado",200);
            }
            return $this->errorResponse("Ticket no encontrado",404);

        }catch(Exception $e){
            Log::info(["error al eliminar ticket"=>$e]);
            return $this->errorResponse("error al eliminar ticket",500);
        }
    }

    

    public function asignarTicket($request){
        try {
            $ticket=Ticket::find($request[id_ticket]);
            if (isset($ticket)){
                $ticket->id_user=$request[id_user];
                $ticket->save();
                return $this->successResponse($ticket,201);
            }
            return $this->errorResponse("Ticket no encontrado",404);
           
        }catch(Exception $e){
            Log::info(["error al asignar ticket"=>$e]);
            return $this->errorResponse("error al asignar ticket",500);
        }
    }    
}