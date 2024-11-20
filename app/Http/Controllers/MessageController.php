<?php

namespace App\Http\Controllers;
use DB, DataTables;
use Illuminate\Http\Request;
use App\Models\Message;

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

        return view('messages.index', [
            'title' => 'Messages',
            'headerColumns' => headerColumns('messages')
        ]);
    }
}
