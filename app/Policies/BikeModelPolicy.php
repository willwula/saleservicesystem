<?php

namespace App\Policies;

use App\Models\BikeModel;
use App\Models\Manager;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BikeModelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the manager can view any models.
     *
     * @param Manager $manager
     * @return Response|bool
     */
    public function viewAny(Manager $manager)
    {
        return Response::allow();
    }

    /**
     * Determine whether the manager can view the model.
     *
     * @param Manager $manager
     * @param BikeModel $bikeModel
     * @return Response|bool
     */
    public function view(Manager $manager, BikeModel $bikeModel)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the manager can create models.
     *
     * @param Manager $manager
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
     * @param Manager $manager
     * @param BikeModel $bikeModel
     * @return Response|bool
     */
    public function update(Manager $manager, BikeModel $bikeModel)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the manager can delete the model.
     *
     * @param Manager $manager
     * @param BikeModel $bikeModel
     * @return Response|bool
     */
    public function delete(Manager $manager, BikeModel $bikeModel)
    {
        return $manager->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

}
