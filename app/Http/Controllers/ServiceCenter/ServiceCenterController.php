<?php

namespace App\Http\Controllers\ServiceCenter;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerCollection;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\ServiceCenterCollection;
use App\Http\Resources\ServiceCenterResource;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ServiceCenterController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Manager::class]);
        $managers = Manager::where('serviceCenter_id', auth()->user()->id)->orderBy('created_at', 'desc');

        if ($request->boolean('paginate') === true) {
            return ServiceCenterCollection::make($managers->paginate('3'));
        }

        return ServiceCenterCollection::make($managers->get());
    }

    public function show($id)  //$id =  url id
    {
        $managerModel = Manager::findOrFail($id);
//        dd($managerModel);
        $this->authorize('view', [Manager::class, $managerModel]);

        return ServiceCenterResource::make($managerModel);
    }

    public function update(Request $request,Manager $manager)
    {
//        dd($manager->id);
        $this->authorize('update', $manager);
        $validated = $request->validate([
            'role' => 'readonly|tinyInteger',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('managers')->ignore($manager),
            ],
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed'
        ]);

        $manager->update(
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            )
        );

        return ServiceCenterResource::make($manager);
    }
}
