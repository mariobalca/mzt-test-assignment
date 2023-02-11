<?php

namespace Tests\Unit;

use App\Exceptions\AlreadyHired;
use App\Exceptions\NotEnoughCoins;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use App\Services\CandidateService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CandidateServiceHireTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test hire method (from candidateService) fails and throws AlreadyHired exception if candidate has already been marked as hired
     *
     * @return void
     */
    public function test_candidate_contact_fails_if_wallet_has_no_coins(): void
    {
        $this->expectException(AlreadyHired::class);

        Candidate::factory(1)->create();
        Company::factory(1)->create();
        Wallet::factory(1)->create();

        $candidate = Candidate::first();
        $candidate->update(['hired' => true]);
        $candidateService = new CandidateService();

        $candidateService->hire($candidate);
    }
}
