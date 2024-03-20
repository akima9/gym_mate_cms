<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Models\Gym;
use App\Services\GymService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Redirect;

class GymController extends Controller implements HasMiddleware
{
    private $gymService;

    public function __construct(GymService $gymService)
    {
        $this->gymService = $gymService;
    }
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gyms = $this->gymService->findGyms();
        return view('gym.index', compact('gyms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gym.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymRequest $request)
    {
        $request->validated();
        $this->gymService->save($request);
        return redirect()->route('gyms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gym $gym)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gym $gym)
    {
        return view('gym.edit', compact('gym'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymRequest $request, Gym $gym)
    {
        $this->gymService->update($request, $gym);
        return redirect()->route('gyms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gym $gym)
    {
        //
    }

    public function massStore(Request $request)
    {
        $rules = [
            'csvUpload' => 'required|file|mimes:csv|max:2048'
        ];
        $request->validate($rules);
        
        $file = $request->file('csvUpload');
        if (!$file->isValid()) return redirect()->route('gyms.create')->with('status', 'massStore-failed');

        $response = $this->gymService->massStore($file);
        if ($response) {
            return redirect()->route('gyms.index')->with('status', 'massStore-success');
        }
        return redirect()->route('gyms.create')->with('status', 'massStore-failed');
    }
}
