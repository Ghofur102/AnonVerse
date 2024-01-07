<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\User;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $CommentsRepository;
    public function __construct(CommentsRepository $CommentsRepository)
    {
        $this->CommentsRepository = $CommentsRepository;
    }
    public function index()
    {
        //
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
        $new = $this->CommentsRepository->storeWithoutFile($request->all());
        if ($new->parent_main_id != null) {
            $p = $new->parent_main_id;
        } else {
            $p = $new->parent_id;
        }
        return response()->json([
            'success' => true,
            'name_sender' => Auth::user()->username,
            'name_recipient' => $new->Recipient->username,
            'auth_user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'id' => $new->id,
            'sender_id' => $new->Sender->id,
            'feed_id' => $new->feed_id,
            'parent_id' => $p
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
    public function update(Request $request, comments $model)
    {
        $this->CommentsRepository->update($request->all(), $model);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comments $model)
    {
        $this->CommentsRepository->destroy($model);
        return response()->json([
            'success' => true
        ]);
    }
}
