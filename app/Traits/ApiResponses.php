<?php

namespace App\Traits;

trait ApiResponses
{
    public function errorResponse($data, $code)
    {
        return response()->json(['error' =>
                                [
                                    'descripcionRespuesta' => 'Error',
                                    'detalleRespuesta' => [$data]
                                ],
                                
                            ],$code)->header('Content-Type', 'application/json');
    }

    public function successResponse($data,$code){
        return response()->json(['sucess' =>
                                        [
                                            'descripcionRespuesta'=>'Success',
                                            'data'=>[$data]
                                        ],
                                    ],$code)->header('Content-Type', 'application/json');
    }
}