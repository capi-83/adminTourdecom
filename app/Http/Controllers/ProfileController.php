<?php

namespace App\Http\Controllers;

use App\Http\ResponseObject;
use App\Models\User;
use App\Notifications\UsersNotification;
use App\Role\RoleChecker;
use App\Role\UserRole;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ProfileController extends Controller
{
    /**
     * ACCESS Rights management
     */
    const ACCESS_RIGHTS = [
        'edit' => [
            UserRole::ROLE_SUPERADMIN => 'edit',
            UserRole::ROLE_COMMANDANT => 'edit',
            UserRole::ROLE_GARDIEN => 'show'
        ],
        'show' => [
            UserRole::ROLE_SUPERADMIN => 'edit',
            UserRole::ROLE_COMMANDANT => 'edit',
            UserRole::ROLE_GARDIEN => 'show'
        ],
        'create' => [
            UserRole::ROLE_SUPERADMIN => 'create',
            UserRole::ROLE_COMMANDANT => 'create'
        ],
        'update' => [
            UserRole::ROLE_SUPERADMIN => 'update',
            UserRole::ROLE_COMMANDANT => 'update'
        ],
        'disabled' => [
            UserRole::ROLE_SUPERADMIN => 'disabled',
            UserRole::ROLE_COMMANDANT => 'disabled',
            UserRole::ROLE_GARDIEN => 'disabled'
        ],
        'delete' => [
            UserRole::ROLE_SUPERADMIN => 'delete',
            UserRole::ROLE_COMMANDANT => 'delete'
        ],
    ];

    /**
     * Droits Specifique
     */
    const SPECIFIC_RIGHTS = [
        'roles' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT
        ],
        'delete' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT
        ],
        'disabled' => [
            UserRole::ROLE_SUPERADMIN,
            UserRole::ROLE_COMMANDANT,
            UserRole::ROLE_GARDIEN
        ]
    ];

    private const STORE_RULES = [
        'name'=> 'required',
        'email'=> 'required|email|unique:users',
        'password'=> 'min:8|required|confirmed',
        'password_confirmation'=> 'same:password',
        'roles'=> 'required',
    ];

    private const UPDATE_RULES = [
        'name'=> 'required',
        'email'=> 'required|email|unique:users',
        'password'=> 'nullable|min:8',
        'password_confirmation'=> 'same:password',
        'roles'=> 'required',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        $admins = [];
        $webUsers = [];

        foreach($users as $u) {
            if(RoleChecker::haveAdminAccess($u)) {
                array_push($admins,$u);
            }
            else array_push($webUsers,$u);
        }

        return view('profile.list',['users'=>$webUsers,'admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rights = self::ACCESS_RIGHTS['create'];
        $currentUser = Auth::user();

        $view = view('profile.add',
            [
                'user' => [],
                'disabled' => false,
                'specificRights' => []
            ]);

        //check specific access
        foreach ( $rights as $rk => $rv) {
            if(RoleChecker::check($currentUser,$rk)) {
                if($rv === 'create') {
                    return $view;
                }
            }
        }

        return back()->with('msg-error', __('Nop !'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('profile.edit',['user' => $user, 'disabled' => true,
            'specificRights' => RoleChecker::getSpecificRightsForAuth(self::SPECIFIC_RIGHTS)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {

        $rights = self::ACCESS_RIGHTS['edit'];
        $currentUser = Auth::user();
        $myaccount = $user->id === $currentUser->id;

        if(RoleChecker::isSuperAdminProfile($user) && !$myaccount)
            return redirect()->route('profile.show', $user);

        $view = view('profile.edit',
            [
                'user' => $user,
                'disabled' => false,
                'specificRights' => RoleChecker::getSpecificRightsForAuth(self::SPECIFIC_RIGHTS)
            ]);

        //check specific access
        foreach ( $rights as $rk => $rv) {
            if(RoleChecker::check($currentUser,$rk)) {
                if($rv === 'edit') {
                    return $view;
                }
                if($rv === 'show' && !$myaccount) {
                    return redirect()->route('profile.show', $user);
                }
            }
        }

        //no specific access
        if(!$myaccount)
            return redirect()->route('dashboard')->with('msg-error', __('Nop !'));

        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(self::STORE_RULES);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->setRoles($request->roles);

        if ($user->save()) {

            $users = User::notified()->get();
            Notification::send($users,new UsersNotification(UsersNotification::USER_CREATED,$user));

            return back()->with('msg-valid', __('Yes !'));
        } else {
            return back()->with('msg-valid', __('Nop !'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        $rules = self::UPDATE_RULES;
        $rules['email'] = $rules['email'] . ',id,' . $user->id;
        $request->validate($rules);

        $user->name = $request->name;
        if($request->email !== $user->email) {
            $user->email = $request->email;
        }
        $user->discordTag = $request->discordTag;
        $user->discordTag = $request->discordTag;
        $user->twitter = $request->twitter;
        $user->mtgaTag = $request->mtgaTag;


        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->setRoles($request->roles);

        if ($user->save()) {

            $users = User::notified()->get();
            Notification::send($users,new UsersNotification(UsersNotification::USER_UPDATED,$user));

            return back()->with('msg-valid', __('Yes !'));
        } else {
            return back()->with('msg-valid', __('Nop !'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function disabled(User $user)
    {
        $currentUser = Auth::user();
        $rights = self::ACCESS_RIGHTS['disabled'];
        foreach ( $rights as $rk => $rv) {
            if(RoleChecker::check($currentUser,$rk)) {
                if($rv === 'disabled') {
                    $user->toggleDisabled();
                    if ($user->save()) {
                        $method = ($user->disabled)?UsersNotification::USER_DISABLED:UsersNotification::USER_ENABLED;

                        $users = User::notified()->get();
                        Notification::send($users,new UsersNotification($method,$user));

                        return back()->with('msg-valid', __('Yes !'));
                    } else {
                        return back()->with('msg-valid', __('Nop !'));
                    }
                }
            }
        }

        return back()->with('msg-valid', __('Nop !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        $rights = self::ACCESS_RIGHTS['delete'];
        foreach ( $rights as $rk => $rv) {
            if(RoleChecker::check($currentUser,$rk)) {
                if($rv === 'delete') {
                    if ($user->delete()) {

                        $users = User::notified()->get();
                        Notification::send($users,new UsersNotification(UsersNotification::USER_DELETED,$user));

                        return redirect()->route('profile.index')->with('msg-valid', __('Yes !'));
                    } else {
                        return back()->with('msg-valid', __('Nop !'));
                    }
                }
            }
        }

        return back()->with('msg-valid', __('Nop !'));
    }
}
