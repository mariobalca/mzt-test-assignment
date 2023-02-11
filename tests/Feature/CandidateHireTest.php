<?php

namespace Tests\Feature;

use App\Mail\CandidateHired;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CandidateHireTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * Test contact method from candidateService is able to subtract coins and send email if wallet has enough coins
     *
     * @return void
     */
    public function test_candidate_hire_succeeds(): void
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
        $this->assertEquals(false, $candidate->hired);

        $this->put("/api/candidate/" . $candidate->id . "/hire");

        $candidate->refresh();
        $wallet->refresh();

        $this->assertEquals(10, $wallet->coins);
        $this->assertEquals(true, $candidate->hired);
        Mail::assertSent(CandidateHired::class);
    }
}
