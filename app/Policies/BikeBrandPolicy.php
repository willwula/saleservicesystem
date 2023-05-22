<?php

namespace App\Policies;

use App\Models\Manager;
use App\Models\BikeBrand;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BikeBrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the manager can view any models.
     *
     * @param \App\Models\Manager
     * @return Response|bool
     */
    public function viewAny(Manager $manager)
    {
        return Response::allow();
    }

    /**
     * Determine whether the manager can view the model.
     *
     * @param \App\Models\Manager $manager
     * @param \App\Models\BikeBrand $bikeBrand
     * @return Response|bool
     */
    public function view(Manager $manager, BikeBrand $bikeBrand)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the manager can create models.
     *
     * @param \App\Models\Manager $manager
     * @return Response|bool
     */
    public function create(Manager $manager)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');

    }

    /**
     * Determine whether the manager can update the model.
     *
     * @param \App\Models\Manager $manager
     * @param \App\Models\BikeBrand $bikeBrand
     * @return Response|bool
     */
    public function update(Manager $manager, BikeBrand $bikeBrand)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the manager can delete the model.
     *
     * @param \App\Models\Managerer
     * @param \App\Models\BikeBrand $bikeBrand
     * @return Response|bool
     */
    public function delete(Manager $manager)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

}
