<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalAdminController extends Controller
{
    public function index_approval_questions() {
        return view('admin.approval_questions');
    }
}
