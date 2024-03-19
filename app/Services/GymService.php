<?php

namespace App\Services;

use App\Repositories\GymRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return $this->gymRepository->save($request);
    }

    public function update($request, $gym)
    {
        return $this->gymRepository->update($request, $gym);
    }

    public function massStore($file)
    {
        $fileData = $this->parseCSV($file);
        return $this->gymRepository->massSave($fileData);
    }

    public function parseCSV($file)
    {
        $filePath = $file->storeAs('csv', Str::random(10) . '_' . time() . '.csv');
        $handle = fopen(storage_path('app/' . $filePath), 'r');
        $csvData = [];
        $headers = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = array_combine($headers, $row);
        }
        fclose($handle);
        Storage::delete($filePath);
        return $csvData;
    }
}