<?php

namespace App\Http\Controllers;

use App\Models\Fungus;
use Illuminate\Http\Request;

class FungusController extends Controller
{
    public function getAllFungi()
    {
        $fungi = Fungus::all()->makeHidden(['created_at', 'updated_at']);

        return view('fungi', ['title' => 'Hello World', 'fungi' => $fungi]);
    }

    public function getSingleFungi($id)
    {
        $fungus = Fungus::find($id);

        return $fungus;
    }

    public function addFungus(Request $request)
    {
        $request->validate([
            'species' => 'required|string|min:3|max:255',
            'averageHeight' => 'required|numeric|min:0|max:10',
            'colour' => 'required|string|min:3|max:255'
        ]);

        $fungus = new Fungus();

        $fungus->species = $request->species;
        $fungus->averageHeight = $request->averageHeight;
        $fungus->colour = $request->colour;

        if ($fungus->save()) {
            return response('New fungus created');
        }

        return response('Oh no');
    }

    public function deleteFungus(int $id)
    {
        $fungus = Fungus::find($id);

        if (!$fungus) {
            return response('Invalid fungus id');
        }

        if ($fungus->delete()) {
            return response('Fungus deleted');
        }

        return response('Oh no');
    }

    public function updateFungus(int $id, Request $request)
    {
        $request->validate([
            'species' => 'string|min:3|max:255',
            'averageHeight' => 'numeric|min:0|max:10',
            'colour' => 'string|min:3|max:255'
        ]);

        $fungus = Fungus::find($id);

        $fungus->species = $request->species ?? $fungus->species;
        $fungus->averageHeight = $request->averageHeight ?? $fungus->averageHeight;
        $fungus->colour = $request->colour ?? $fungus->colour;

        if ($fungus->save()) {
            return response('Fungus updated');
        }

        return response('Oh no');
    }
}
