<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getAllClients()
    {
        $clients = Client::all()->makeHidden(['password', 'updated_at', 'created_at']);

        return $clients;
    }

    public function getSingleClient($id)
    {
        $client = Client::find($id);

        return $client;
    }
}
