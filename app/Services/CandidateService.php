<?php

namespace App\Services;
use App\Mail\CandidateContacted;
use App\Mail\CandidateHired;
use App\Models\Candidate;
use Illuminate\Support\Facades\Mail;

class CandidateService {

    private $model;
    private $companyService;

    public function __construct(Candidate $model, CompanyService $companyService)
    {
        $this->model = $model;
        $this->companyService = $companyService;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function contact(Candidate $candidate)
    {
        $company = $this->companyService->get();
        if ($company->coins() < 5) {
            throw new \Exception('Not enough coins');
        }

        $company->wallet->coins -= 5;
        $company->wallet->save();

        Mail::to($candidate->email)->send(new CandidateContacted($candidate));
    }

    public function hire(Candidate $candidate)
    {
        $company = $this->companyService->get();

        $company->wallet->coins += 5;
        $company->wallet->save();

        $candidate->update(['hired' => true]);

        Mail::to($candidate->email)->send(new CandidateHired($candidate));
    }
}