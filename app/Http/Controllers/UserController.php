<?php

namespace App\Http\Controllers;

use App\Helpers\ControllerHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new ControllerHelper();
    }

    /**
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        if (request()->has("search")) {
            $users = DB::table('users')
                ->whereRaw('email LIKE "%'.request()->query("search").'%"')
                ->get();

//            $users = User::all()
//                ->where('email', 'LIKE', '%'.request()->query("search").'%');
        }

        return new JsonResponse($users);
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        if ($this->helper->inputs_not_valid($request)) {
            if ($request->return == true) {
                $request->session()
                    ->flash(
                        'message',
                        "Invalid values"
                    );
                redirect()->to('/');
            }
            return $this->helper->not_valid_return();
        }

        $user = new User;
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        if ($request->return == true) {
            if ($user->save()) {
                $request->session()
                    ->flash(
                        'message',
                        "User created"
                    );
                redirect()->to('/');
            } else {
                $request->session()
                    ->flash(
                        'message',
                        "Failed to create user"
                    );
                redirect()->to('/');
            }
        }
        return $this->helper->to_save($user, 'created');
    }

    /**
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $user = User::all()->find($id);
        if (is_null($user)) {
            return $this->helper->no_content_return();
        }
        return new JsonResponse($user);
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        if ($this->helper->inputs_not_valid($request)) {
            return $this->helper->not_valid_return();
        }

        $user = User::all()->find($id);
        $user->update(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ]
        );

        return $this->helper->to_save($user);

    }

    /**
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $user = User::all()->find($id);
        if (is_null($user)) {
            return $this->helper->no_content_return();
        }
        $user->delete();
        return $this->helper->no_content_return();

    }
}
