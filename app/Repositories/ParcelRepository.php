<?php

namespace App\Repositories;

use App\Models\Parcel;
use App\Models\User;

class ParcelRepository
{
    public function createParcel(User $user, array $data)
    {
        return $user->parcels()->create($data);
    }

    public function updateParcel(Parcel $parcel, array $data)
    {
        $parcel->update($data);
        return $parcel;
    }

    public function getUserParcels(User $user)
    {
        return $user->parcels;
    }
}
