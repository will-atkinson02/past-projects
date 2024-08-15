<?php

namespace App\Http\Controllers;

use App\Models\Jobdata;
use Illuminate\Http\Request;

class JobdataController extends Controller
{
    public function addJobdata(Request $request)
    {
        $addJobdata = new Jobdata();

        $addJobdata->jobTitle = $request->jobTitle;
        $addJobdata->companyName = $request->companyName;
        $addJobdata->salary = $request->salary;
        $addJobdata->PHP = $request->PHP;
        $addJobdata->Laravel = $request->Laravel;
        $addJobdata->JavaScript = $request->JavaScript;
        $addJobdata->Ruby = $request->Ruby;
        $addJobdata->Python = $request->Python;
        $addJobdata->React = $request->React;
        $addJobdata->HTMLCSS = $request->HTMLCSS;
        $addJobdata->APIs = $request->APIs;
    }
}
