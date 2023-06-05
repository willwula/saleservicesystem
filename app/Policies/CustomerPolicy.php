<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param Manager $manager
     * @return Response|bool
     */
    public function viewAny(Manager $manager)
    {
        return $manager->hasPermissionToViewAnyCustomers()
              ? Response::allow()
              : Response::deny('無此操作權限');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Customer $customer
     * @return Response|bool
     */
    public function view(User $user, Customer $customer)
    {
        if ($user instanceof Manager && $user->isAdmin()) {
            // 如果目前登入者是 Manager 的 admin，允許查看客戶資料
            return Response::allow();
        }

        if ($user instanceof Customer && $user->getKey() === $customer->getKey()) {
            // 如果目前登入者就是該客戶，則允許查看自己的資料
            return Response::allow();
        }

        return Response::deny('無此操作權限'); // 其他情況則拒絕存取
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param Manager $manager
     * @return Response|bool
     */
    public function update(Customer $customer, Customer $customerModel)
    {
        return $customer->hasPermissionToEditCustomer($customerModel)
            ? Response::allow()
            : Response::deny('無此操作權限');
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param Manager $manager
     * @return Response|bool
     */
    public function delete(Manager $manager)
    {
        return $manager->hasPermissionToDeleteCustomer()
            ? Response::allow()
            : Response::deny('無此操作權限');
    }
}
