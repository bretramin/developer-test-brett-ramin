<?php

namespace App\Http\Controllers;

use App\LoanApplication;
use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication)
    {
        return response($loanApplication->toJson());
    }
}
