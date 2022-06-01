<?php


namespace Packages\pay\src\Models;



trait WithTransaction
{

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactiontable');
    }
}
