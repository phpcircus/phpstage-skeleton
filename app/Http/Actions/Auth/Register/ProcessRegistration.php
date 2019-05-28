<?php

namespace App\Http\Actions\Auth\Register;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use PerfectOblivion\Actions\Action;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Validation\Factory as Validator;

class ProcessRegistration extends Action
{
    use RedirectsUsers;

    /** @var string */
    protected $redirectTo = '/';

    /** @var \Illuminate\Validation\Factory */
    private $validator;

    /** @var \Illuminate\Contracts\Hashing\Hasher */
    private $hasher;

    /** @var \Illuminate\Auth\AuthManager */
    private $auth;

    /**
     * Construct a new ProcessRegistration action.
     *
     * @param  \Illuminate\Validation\Factory  $validator
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  \Illuminate\Auth\AuthManager  $auth
     */
    public function __construct(Validator $validator, Hasher $hasher, AuthManager $auth)
    {
        $this->validator = $validator;
        $this->hasher = $hasher;
        $this->auth = $auth;
    }

    /**
     * Execute the action to register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect()->route('home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return $this->validator->make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->hasher->make($data['password']),
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return $this->auth->guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     *
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('home')->with(['success' => 'User registered. Check your email to verify your account.']);
    }
}
