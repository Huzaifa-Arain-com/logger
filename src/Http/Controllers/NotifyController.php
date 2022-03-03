<?php

namespace Notify\LaravelCustomLog\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Notify\LaravelCustomLog\Http\Controllers\Controller;
use Notify\LaravelCustomLog\Models\Log;

class NotifyController extends Controller
{

    public function index(Request $request)
    {

        try {

            if ($request->has('pass')) {
                $decrypt = Crypt::decryptString($request->pass);
                if ($decrypt == 'info@hellokongo.com') {
                    $exceptions = Log::orderByDesc('id')->paginate(10);
                    return view('CustomLog::exceptions.list', compact('exceptions'));
                }
                abort(403);
            }
            abort(403);
        } catch (Exception $e) {
            abort(403);
        }
    }

    public function show($id)
    {

        $exception = Log::findOrFail($id);
        return view('CustomLog::exceptions.show', compact('exception'));
    }
}
