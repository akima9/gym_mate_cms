<?php

namespace App\Services;

use App\Repositories\GymRepository;

class GymService
{
    private $gymRepository;

    public function __construct(GymRepository $gymRepository)
    {
        $this->gymRepository = $gymRepository;
    }

    public function findGyms()
    {
        return $this->gymRepository->getGyms();
    }

    public function save($request)
    {
        $this->gymRepository->save($request);
    }
}