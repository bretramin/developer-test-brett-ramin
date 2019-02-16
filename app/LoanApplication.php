<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total_annual_income',
        'total_bank_balance',
    ];

    /**
     * The borrowers that belong to the loan application.
     */
    public function borrowers() {
        return $this->hasMany(Borrower::class);
    }

    public function getTotalAnnualIncomeAttribute() {
        $borrowers = $this->borrowers->load('job');

        return $borrowers->sum('job.salary');
    }

    public function getTotalBankBalanceAttribute() {
        $borrowers = $this->borrowers->load('bankAccount');

        return $borrowers->sum('bankAccount.balance');
    }
}
