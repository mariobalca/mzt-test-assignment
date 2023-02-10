<?php

namespace App\Http\Controllers;

use App\Services\CandidateService;

class CandidateController extends Controller
{
    private CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index(){
        $candidates = $this->candidateService->getAll();

        return view('candidates.index', compact('candidates'));
    }

    public function contact(){
        // @todo
        // Your code goes here...
    }

    public function hire(){
        // @todo
        // Your code goes here...
    }
}
