<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Repositories\ApprovalAdminRepository;
use Illuminate\Http\Request;

class ApprovalAdminController extends Controller
{
    protected $approval;
    public function __construct(ApprovalAdminRepository $approval)
    {
        $this->approval = $approval;
    }
    public function index_approval_questions() {
        $questions = Questions::where('status', 'belum aktif')->get();
        return view('admin.approval_questions', compact("questions"));
    }
    public function accept_approval_question(Questions $model) {
        $this->approval->update(['status' => 'aktif'], $model);
        return redirect()->back();
    }
}
