<?php

namespace Tests\Unit;

use App\Exceptions\NotEnoughCoins;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use App\Services\CandidateService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CandidateServiceContactTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test contact method (from candidateService) fails and throws NotEnoughCoins exception if wallet has no coins
     *
     * @return void
     */
    public function test_candidate_contact_fails_if_wallet_has_no_coins(): void
    {
        $this->expectException(NotEnoughCoins::class);

        Candidate::factory(1)->create();
        Company::factory(1)->create();
        Wallet::factory(1)->create();

        $wallet = Wallet::first();
        $wallet->coins = 0;
        $wallet->save();

        $candidate = Candidate::first();
        $candidateService = new CandidateService();

        $candidateService->contact($candidate);
    }
}
