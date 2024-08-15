<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController
{
    public function all()
    {
        // When using relationships we can use a mixture of with an makeHidden to exclude fields from the results
        $contracts = Contract::with('employees:id,first_name,last_name,contract_id')->get()->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'message' => 'Contracts received',
            'success' => true,
            'data' => $contracts
        ]);
    }
}
