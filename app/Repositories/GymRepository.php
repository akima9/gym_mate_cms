<?php

namespace App\Repositories;

use App\Models\Gym;
use Carbon\Carbon;

class GymRepository
{
    public function getGyms()
    {
        return Gym::all();
    }

    public function save($request)
    {
        return Gym::create([
            'title' => $request->title,
            'address' => $request->address,
        ]);
    }

    public function update($request, $gym)
    {
        return Gym::where('id', $gym->id)
            ->update([
                'title' => $request->title,
                'address' => $request->address,
                'active' => $request->active,
            ]);
    }

    public function massSave($fileData)
    {
        $timestamp = Carbon::now();
        foreach ($fileData as &$data) {
            $data['created_at'] = $timestamp;
            $data['updated_at'] = $timestamp;
        }
        return Gym::insert($fileData);
    }
}