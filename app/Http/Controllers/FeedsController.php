<?php

namespace App\Http\Controllers;

use App\Models\feeds;
use App\Repositories\FeedsRepository;
use Illuminate\Http\Request;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $FeedsRepository;
    public function __construct(FeedsRepository $FeedsRepository)
    {
        $this->FeedsRepository = $FeedsRepository;
    }
    public function index()
    {
        $feed = feeds::inRandomOrder()->first();
        $count_feed = feeds::count();
        return view('users.feed', compact("feed", "count_feed"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->FeedsRepository->store($request->all());
        } else {
            $this->FeedsRepository->storeWithoutFile($request->all());
        }
        return response()->json([
            'message' => 'Sukses menambahkan postingan',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, feeds $feed)
    {
        $this->FeedsRepository->update($request->all(), $feed);
        if ($request->hasFile('file')) {
            $this->FeedsRepository->delete_file($feed->file);
            $this->FeedsRepository->update_file($request->file('file'), 'foto-feeds', $feed);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feeds $feed)
    {
        $this->FeedsRepository->destroy($feed);
        return response()->json([
            'success' => true,
        ]);
    }
}
