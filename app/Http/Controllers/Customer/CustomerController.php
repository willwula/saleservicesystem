<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * 取得customer清單
     * @urlParam  paginate 如果是 true 提供每 20 筆分頁
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Customer::class]);

        $customers = Customer::orderBy('id', 'desc');

        if ($request->boolean('paginate')) {
            return CustomerCollection::make($customers->paginate(20));
        }

        return CustomerCollection::make($customers->get());
    }

    /**
     * 查看單一 customer 內容
     *
     * @urlParam id customer_id
     */
    public function show(Customer $customer)  //$id =  url id
    {
        $this->authorize('view', [Customer::class, $customer]);

        abort_if(!
        Customer::where('id', $customer->id)->first(),
            Response::HTTP_BAD_REQUEST,
            __('table.not found')
        );

        return CustomerResource::make($customer);
    }

    /**
     * 新增 customer
     *
     * @bodyparam name string:255
     * @bodyparam email string:255
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Customer::class]);
        $validated = $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed',
        ]);

        abort_if(
            Customer::where('email', $request->input('email'))->first(),
            Response::HTTP_BAD_REQUEST,
            __('auth.duplicate email')
        );

        $customer = Customer::create(
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            )
        );

        return CustomerResource::make($customer);

    }

    /**
     * 更新一筆 customer 內容
     *
     * @urlParam id
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('update', [Customer::class, $customer]);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'password' => 'nullable|alpha_num:ascii|min:6|max:12|confirmed'
        ]);

        if ($request->input('password')) {
                $validated['password'] = Hash::make($request->input('password'));
        }

        $customer->update($validated);

        return CustomerResource::make($customer);
    }

    /**
     * 刪除一個 customer
     *
     * @urlParam id
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', [Customer::class, $customer]);

        $customer->delete();

        return '刪除成功';
    }
}
