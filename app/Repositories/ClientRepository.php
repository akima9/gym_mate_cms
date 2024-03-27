<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository
{
    public function getClientPerPage(Request $request): LengthAwarePaginator
    {
        return Client::orderBy('id', 'desc')
                        ->paginate(10);
    }
}
