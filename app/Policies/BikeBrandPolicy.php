<?php

namespace App\Policies;

use App\Models\BikeBrandModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BikeBrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BikeBrandModel $bikeBrandModel
     * @return Response|bool
     */
    public function view(User $user, BikeBrandModel $bikeBrandModel)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BikeBrandModel $bikeBrandModel
     * @return Response|bool
     */
    public function update(User $user, BikeBrandModel $bikeBrandModel)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BikeBrandModel $bikeBrandModel
     * @return Response|bool
     */
    public function delete(User $user, BikeBrandModel $bikeBrandModel)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BikeBrandModel $bikeBrandModel
     * @return Response|bool
     */
    public function restore(User $user, BikeBrandModel $bikeBrandModel)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BikeBrandModel $bikeBrandModel
     * @return Response|bool
     */
    public function forceDelete(User $user, BikeBrandModel $bikeBrandModel)
    {
        return $user->id === isAdmin()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }
}
