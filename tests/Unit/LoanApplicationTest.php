<?php

namespace Tests\Unit;

use App\BankAccount;
use App\Borrower;
use App\Job;
use App\LoanApplication;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoanApplicationTest extends TestCase
{
    use DatabaseTransactions;

    /** @var LoanApplication */
    private $loanApplication;

    /** @var Borrower */
    private $borrower1;

    /** @var Borrower */
    private $borrower2;

    public function setUp()
    {
        parent::setUp();

        $this->loanApplication = factory(LoanApplication::class)->create();

        $this->borrower1 = factory(Borrower::class)->create([
            'loan_application_id' => $this->loanApplication->id,
        ]);

        $this->borrower2 = factory(Borrower::class)->create([
            'loan_application_id' => $this->loanApplication->id,
        ]);
    }

    /**
     * The loan application should be able to calculate the annual salary sum of the borrowers.
     *
     * @return void
     * @test
     */
    public function it_calculates_sum_of_borrowers_annual_salaries()
    {
        $job1 = factory(Job::class)->create([
            'borrower_id' => $this->borrower1->id,
        ]);
        $job2 = factory(Job::class)->create([
            'borrower_id' => $this->borrower2->id,
        ]);

        $this->assertEquals($job1->salary + $job2->salary, $this->loanApplication->totalAnnualIncome());
    }

    /**
     * The loan application should be able to calculate the bank account balance sum of the borrowers.
     *
     * @return void
     * @test
     */
    public function it_calculates_sum_of_borrowers_bank_balances()
    {
        $bankAccount1 = factory(BankAccount::class)->create([
            'borrower_id' => $this->borrower1->id,
        ]);
        $bankAccount2 = factory(BankAccount::class)->create([
            'borrower_id' => $this->borrower2->id,
        ]);

        $this->assertEquals($bankAccount1->balance + $bankAccount2->balance, $this->loanApplication->totalBankBalance());
    }
}
