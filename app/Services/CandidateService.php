<?php

namespace App\Services;
use App\Exceptions\AlreadyHired;
use App\Exceptions\NotEnoughCoins;
use App\Mail\CandidateContacted;
use App\Mail\CandidateHired;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class CandidateService {
    private CompanyService $companyService;

    public function __construct()
    {
        $this->companyService = new CompanyService();
    }

    /**
     * Get all candidates
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Candidate::all();
    }

    /**
     * Contacts the candidate (sends an email) if wallet has enough coins
     * Otherwise, throws exception
     *
     * @param Candidate $candidate
     * @throws NotEnoughCoins
     * @return void
     */
    public function contact(Candidate $candidate): void
    {
        $company = $this->companyService->get();
        if ($company->coins() < 5) {
            throw new NotEnoughCoins('Not enough coins');
        }

        $company->wallet->coins -= 5;
        $company->wallet->save();

        Mail::to($candidate->email)->send(new CandidateContacted($candidate));
    }

    /**
     * Hires the candidate (sends an email, and updates hired boolean)
     * @param Candidate $candidate
     * @throws AlreadyHired
     * @return void
     */
    public function hire(Candidate $candidate): void
    {
        if ($candidate->hired) {
            throw new AlreadyHired('Candidate already hired');
        }

        $company = $this->companyService->get();

        $company->wallet->coins += 5;
        $company->wallet->save();

        $candidate->update(['hired' => true]);

        Mail::to($candidate->email)->send(new CandidateHired($candidate));
    }
}