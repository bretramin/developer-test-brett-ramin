<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $loanApplication = factory(\App\LoanApplication::class)->create();
        $borrowers       = factory(\App\Borrower::class, 2)->create([
            'loan_application_id' => $loanApplication,
        ]);
        factory(\App\Job::class)->create([
            'borrower_id' => $borrowers[0]->id,
        ]);
        factory(\App\Job::class)->create([
            'borrower_id' => $borrowers[1]->id,
        ]);
        factory(\App\BankAccount::class)->create([
            'borrower_id' => $borrowers[1]->id,
        ]);

        dump($loanApplication->toArray());
    }
}
