<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionsRepository;

class QuestionsAnswersController extends Controller
{
    protected $QuestionsRepository;
    public function __construct(QuestionsRepository $QuestionsRepository)
    {
        $this->QuestionsRepository = $QuestionsRepository;
    }
    public function store_question(Request $request) {
        $this->QuestionsRepository->storeWithoutFile($request->all());
        return redirect()->back();
    }
    public function update_question(Request $request, string $id) {
        $this->QuestionsRepository->update($request->all(), $id);
        return redirect()->back();
    }
    public function destroy_question(string $id) {
        $this->QuestionsRepository->destroy($id);
        return redirect()->back();
    }
}
