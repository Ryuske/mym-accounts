<?php

namespace App\Api\Transformers;

use App\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract
{
    public function transform(Account $account)
    {
        $account->addHidden('privileges');
        $account->addHidden('active');

        return $account->toArray();
    }
}