<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function ifChildOfParent($prent_id, $child_id)
    {
        return User::where('agent_id', $prent_id)->where('id', $child_id)->exists();
    }
}
