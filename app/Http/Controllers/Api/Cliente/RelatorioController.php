<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function status(Request $request)
    {
        $conversations = DB::table('conversations')->select('status')->groupBy('status')->get();

        foreach ($conversations as $index => $conversation) {
            $conversation['status_name'] = Conversation::$status[$conversation['status']];
        }

        $agente = User::whereIs('agente')->count();

        return [
            'conversations' => $conversations,
            'agentes'       => $agente,
        ];
    }
}
