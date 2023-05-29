<?php

namespace App\Policies;

use App\Models\Manager;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Request;

class ManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Manager $manager)
    {
        return $manager->hasPermissionToViewAnyManagers() || $manager->hasPermissionToViewOwnDealer();
    }
    public function viewAnyCustomers(Customer $customer)
    {
        return $customer->hasPermissionToViewAnyCustomers();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Manager  $manager
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Manager $manager, $managerModel ) //$manager = login id  $managerModel = url id
    {
        return $manager->hasPermissionToViewManager($managerModel) || $manager->hasPermissionToViewDealer($managerModel)
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Manager $manager): \Illuminate\Auth\Access\Response|bool
    {
        return $manager->hasPermissionToCreateAllManagers() || $manager->hasPermissionToCreateDealer();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Manager  $manager
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Manager $manager, $managerModel)
    {
        return $manager->hasPermissionToEditManager($managerModel) || $manager->hasPermissionToEditDealer($managerModel);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Manager  $manager
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Manager $manager, $managerModel)
    {
        return $manager->hasPermissionToDeleteManager($managerModel);
    }


}
