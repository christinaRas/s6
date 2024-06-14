<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetTablesController extends Controller
{
    public function reset(Request $request)
    {
        $tables = ['etapes','courses','assignements','runners','users','points','runner_cats','categories'];

        DB::beginTransaction();

        try {
            foreach ($tables as $table) {
                if ($table === 'users') {
                    $affectedRows = DB::table($table)->where('role', '!=', 'admin')->delete();
                } else {
                    DB::table($table)->truncate();
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'All tables have been reset.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to reset tables: ' . $e->getMessage());
        }
        return redirect()->route('dashboard');
    }
}
