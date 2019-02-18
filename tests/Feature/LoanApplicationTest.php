<?php

namespace Tests\Feature;

use App\Borrower;
use App\Job;
use App\LoanApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoanApplicationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Make sure the /LoanApplications endpoint returns 200/ok and includes proper fields
     *
     * @return void
     * @test
     */
    public function it_can_get_loan_application_data()
    {
        $loanApplication = factory(LoanApplication::class)->create();

        $borrower1 = factory(Borrower::class)->create([
            'loan_application_id' => $loanApplication->id,
        ]);
        $borrower2 = factory(Borrower::class)->create([
            'loan_application_id' => $loanApplication->id,
        ]);

        factory(Job::class, 2)->create([
            'borrower_id' => $borrower1->id,
        ]);
        factory(Job::class)->create([
            'borrower_id' => $borrower2->id,
        ]);

        $response = $this->get('/LoanApplications/' . $loanApplication->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'total_annual_income',
            'total_bank_balance',
            'borrowers',
        ]);
    }
}
