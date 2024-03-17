<?php

namespace App\Repositories;

use App\Models\Gym;

class GymRepository
{
    public function getGyms()
    {
        return Gym::all();
    }

    public function save($request)
    {
        // Gym::
    }
}