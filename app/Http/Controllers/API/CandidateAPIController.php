<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Services\CandidateService;

class CandidateAPIController extends Controller
{
    private CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function list()
    {
        return response($this->candidateService->getAll(), 200);
    }
    public function contact(Candidate $candidate)
    {
        try {
            $this->candidateService->contact($candidate);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 403);
        }
    }

    public function hire(Candidate $candidate)
    {
        try {
            $this->candidateService->hire($candidate);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 403);
        }
    }
}
