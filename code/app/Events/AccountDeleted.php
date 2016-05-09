<?php

namespace App\Events;

use App\Account;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AccountDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->data = [
            $account
        ];
    }

    public function broadcastOn() {
        return ['mym'];
    }
}
