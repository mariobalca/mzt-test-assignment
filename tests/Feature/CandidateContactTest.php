<?php

namespace Tests\Feature;

use App\Mail\CandidateContacted;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CandidateContactTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * Test contact method from candidateService is able to subtract coins and send email if wallet has enough coins
     *
     * @return void
     */
    public function test_candidate_contact_succeeds_to_subtract_5_coins_if_wallet_has_enough_coins(): void
    {
        Candidate::factory(1)->create();
        Company::factory(1)->create();
        Wallet::factory(1)->create();

        Mail::fake();

        $wallet = Wallet::first();
        $wallet->coins = 5;
        $wallet->save();

        $candidate = Candidate::first();
        $this->assertEquals(5, $wallet->coins);

        $this->post("/api/candidate/" . $candidate->id . "/contact");

        $wallet = Wallet::first();

        $this->assertEquals(0, $wallet->coins);
        Mail::assertSent(CandidateContacted::class);
    }
}
