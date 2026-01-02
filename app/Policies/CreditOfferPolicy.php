<?php

namespace App\Policies;

use App\Models\CreditOffer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CreditOfferPolicy
{
public function viewAny(User $user)
{
    return $user->can('credit_offers.view');
}

public function create(User $user)
{
    return $user->can('credit_offers.manage');
}

public function update(User $user)
{
    return $user->can('credit_offers.manage');
}

public function delete(User $user)
{
    return $user->can('credit_offers.manage');
}
}
