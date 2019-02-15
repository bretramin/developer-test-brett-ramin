<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrower extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
     * The loan application the borrower belongs to.
     */
    public function loanApplication() {
        return $this->belongsTo(LoanApplication::class);
    }

    /**
     * The job the that belongs to the borrower.
     */
    public function job() {
        return $this->hasOne(LoanApplication::class);
    }

    /**
     * The bank account that belongs to the borrower.
     */
    public function bankAccount() {
        return $this->hasOne(LoanApplication::class);
    }
}
