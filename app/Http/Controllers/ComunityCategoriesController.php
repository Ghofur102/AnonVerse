<?php

namespace App\Http\Controllers;

use App\Models\comunity_categories;
use App\Models\Questions;
use App\Repositories\ComunityCategoriesRepository;
use Illuminate\Http\Request;

class ComunityCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $ComunityCategoriesRepository;
    public function __construct(ComunityCategoriesRepository $ComunityCategoriesRepository)
    {
        $this->ComunityCategoriesRepository = $ComunityCategoriesRepository;
    }
    public function index()
    {
        $categories = comunity_categories::all();
        return view('admin.kategori_komunitas', compact('categories'));
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
        $this->ComunityCategoriesRepository->storeWithoutFile($request->all());
        return redirect()->back();
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
    public function update(Request $request, string $model)
    {
        $this->ComunityCategoriesRepository->update($request->all(), $model);
        if ($request->hasFile('image_category')) {
            $image_category = comunity_categories::find($model)->image_category;
            $this->ComunityCategoriesRepository->delete_file($image_category);
            $this->ComunityCategoriesRepository->update_file($request->file('image_category'), 'image_comunity_category', $model);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $model)
    {
        if (Questions::where('comunity_category_id', $model)->count() >= 1) {
            return redirect()->back()->withErrors('Masih ada data pertanyaan terkait dengan kategori komunitas!');
        }
        $this->ComunityCategoriesRepository->destroy($model);
        return redirect()->back();
    }
}
