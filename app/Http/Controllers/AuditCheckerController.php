<?php

namespace App\Http\Controllers;

use App\Models\AuditChecker;
use Illuminate\Http\Request;

class AuditCheckerController extends Controller
{
    //API
public function apiIndex()
{
    $AuditChecker = AuditChecker::all();

    return response()->json([
        'success' => true,
        'message' => 'Data Audit Checker',
        'data' => $AuditChecker
    ]);
}

}
