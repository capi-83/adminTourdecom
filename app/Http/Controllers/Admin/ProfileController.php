<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\StoreRequest;
use App\Http\Requests\Admin\Profile\UpdateRequest;
use App\Http\ResponseObject;
use App\Models\User;
use App\Notifications\UsersNotification;
use App\Repositories\UserRepository;
use App\Rights\ProfileRights;
use App\Role\RoleChecker;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class ProfileController extends Controller
{
    private $spec;
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->spec = new ProfileRights();
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $users = $this->userRepository->getAll();
        $admins = [];
        $webUsers = [];

        foreach($users as $u) {
            if(RoleChecker::haveAdminAccess($u)) {
                array_push($admins,$u);
            }
            else array_push($webUsers,$u);
        }

        return view('admin.profile.list',['users'=>$webUsers,'admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if(!$this->spec->hasAccess('create')) return abort('403');

        return view('admin.profile.add',
            [
                'user' => [],
                'disabled' => false,
                'specificRights' => []
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $currentUser = Auth::user();
        return view('admin.profile.edit',
            [
                'user' => $user,
                'disabled' => true,
                'specificRights' => $this->spec->getSpecificRights($currentUser)
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $currentUser = Auth::user();
        if($this->spec->islockedProfile($user,$currentUser))
            return redirect()->route('profile.show', $user);

        $view = view('admin.profile.edit',
            [
                'user' => $user,
                'disabled' => false,
                'specificRights' => $this->spec->getSpecificRights($currentUser)
            ]);

        if($this->spec->hasAccess('edit') || $this->spec->isMyProfile($user,$currentUser))
            return $view;

        else if($this->spec->hasAccess('show'))
            return redirect()->route('profile.show', $user);

        else return abort('403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->setRoles($request->roles);

        if ($user->save()) {
            $users = User::notified()->get();
            $currentUser = Auth::user();

            Notification::send($users,new UsersNotification(UsersNotification::USER_CREATED,$user));
            $currentUser->notify(new UsersNotification(UsersNotification::USER_CREATED,$user,true));

            return back()->with('msg-valid', __('form.save'));
        } else {
            return back()->with('msg-valid', __('form.error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return void
     */
    public function update(UpdateRequest $request, User $user)
    {
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

        if($request->roles){
            $user->setRoles($request->roles);
        }

        if ($user->save()) {
            $users = User::notified()->get();
            $currentUser = Auth::user();

            Notification::send($users,new UsersNotification(UsersNotification::USER_UPDATED,$user));
            $currentUser->notify(new UsersNotification(UsersNotification::USER_UPDATED,$user,true));

            return back()->with('msg-valid', __('form.save'));
        } else {
            return back()->with('msg-valid', __('form.error'));
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
        if($this->spec->hasAccess('disabled')) {
            $user->toggleDisabled();
            if ($user->save()) {
                $method = ($user->disabled)?UsersNotification::USER_DISABLED:UsersNotification::USER_ENABLED;

                $users = User::notified()->get();
                $currentUser = Auth::user();
                Notification::send($users,new UsersNotification($method,$user));
                $currentUser->notify(new UsersNotification($method,$user,true));

                return back()->with('msg-valid', __('form.save'));
            } else {
                return back()->with('msg-valid', __('form.error'));
            }
        }

        return abort('403');
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
        if($this->spec->hasAccess('delete')){
            if ($user->delete()) {
                $users = User::notified()->get();
                $currentUser = Auth::user();
                Notification::send($users,new UsersNotification(UsersNotification::USER_DELETED,$user));
                $currentUser->notify(new UsersNotification(UsersNotification::USER_DELETED,$user,true));

                return redirect()->route('profile.index')->with('msg-valid', __('form.delete'));
            } else {
                return back()->with('msg-valid', __('form.error'));
            }
        }

        return abort('403');
    }
}
