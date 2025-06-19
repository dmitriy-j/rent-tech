<?php

namespace App\Policies;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentPolicy
{
    public function view(User $user, Equipment $equipment)
    {
        return $user->id === $equipment->owner_id;
    }

    public function update(User $user, Equipment $equipment)
    {
        return $user->id === $equipment->owner_id;
    }

    public function delete(User $user, Equipment $equipment)
    {
        return $user->id === $equipment->owner_id &&
               !$equipment->activeRentals()->exists();
    }
}
