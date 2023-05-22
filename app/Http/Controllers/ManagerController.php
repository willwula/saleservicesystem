<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @GROUP manager
 *
 * manger_CRUD
 *
 * @subgroup 帳號管理
 * @description manager_CRUD
*/
class ManagerController extends Controller
{
    public function create()
    {
        return '123';
    }

    public function store(Request $request)
    {
//        $this->authorize('create', [Book::class]); //這邊的 Book::class 會 call BookPolicy 的 create method
        $manager = Auth::user();
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12'

        ]);

        return $manager->managers()->create($validated);
    }
}
