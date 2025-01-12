<?php

namespace Modules\Message\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Message\App\Models\Message;
use DB,DataTables;

class MessageController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Message::orderBy('id', 'desc')
            )
            ->addIndexColumn()
            ->toJson();
        }

        return view('message::messages.index', [
            'title' => 'Messages',
            'headerColumns' => headerColumns('messages')
        ]);
    }
}
