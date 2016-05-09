<?php

namespace App\Api\Controllers;

use App\Account;
use App\Api\Controllers\Traits\dataFormatterTrait;
use App\Api\Requests\CreateAccountRequest;
use App\Api\Requests\UpdateAccountRequest;
use App\Api\Transformers\AccountTransformer;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    use dataFormatterTrait;

    protected $fields_to_return = [
        'id',
        'first_name',
        'last_name',
        'email',
        'avatar_image',
        'created_at',
        'updated_at'
    ];

    /**
     * This is used to get a specific Account from the database
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function get($id) {
        $account = Account::findOrFail($id, $this->fields_to_return);

        return $this->response->item($account, new AccountTransformer);
    }

    /**
     * This is used for retrieving a list of accounts
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function find(Request $request) {
        $fields_to_return = $this->fields_to_return;

        if (!$request->has('range')) {
            $request->range = [];
        }

        $take       = $request->range['take'] ?? 100;
        $skip       = $request->range['skip'] ?? 0;
        $orderBy    = $this->formatOrderBy($request->orderBy, $fields_to_return);

        // Eloquent defaults to desc if anything besides asc is supplied
        $sort       = $request->sort ?? 'asc';

        $accounts = Account::where(function($query) use($fields_to_return, $request) {
            if ($request->has('account')) {
                foreach ($request->account as $field=>$value) {
                    if (in_array($field, $fields_to_return)) {
                        $query->where($field, $value);
                    }
                }
            }
        })
        ->take($take)
        ->skip($skip)
        ->orderBy($orderBy, $sort)
        ->get($this->fields_to_return);

        return $this->response->collection($accounts, new AccountTransformer);
    }

    /**
     * This is used to create a new account
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CreateAccountRequest $request) {
        $account = Account::create($request->account);

        return $this->response
            ->item($account, new AccountTransformer)
            ->withHeader('Location', getRoute('v1', 'get', ['id' => $account->id]))
            ->setStatusCode(201);
    }

    /**
     * This is used to update the specified account
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(UpdateAccountRequest $request, $id) {
        $account = Account::findOrFail($id, $this->fields_to_return);

        $account->update($request->account);

        return $this->response->item($account, new AccountTransformer);
    }

    /**
     * This is used to delete the specified account
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id) {
        $account = Account::findOrFail($id, ['id']);
        $account->delete();

        return response('', 204);
    }
}
