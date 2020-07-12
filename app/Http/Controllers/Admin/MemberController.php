










	* Register Coon
                    : redirect($this->redirectPath());
                    ? new Response('', 201)
            'email'      => $data['email'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name'  => $data['first_name'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender'      => $data['gender'],
            'gender' => ['required', 'string'],
            'last_name'  => $data['last_name'],
            'last_name' => ['required', 'string', 'max:255'],
            'password'   => Hash::make($data['password']),
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
            return $response;
        $this->guard()->login($user);
        $this->guard()->user
        $this->guard()->user()->assignRole($request->role);
        $this->validator($request->all())->validate();
        ]);
        ]);
        event(new Registered($user = $this->create($request->all())));
        if ($response = $this->registered($request, $user)) {
        return $request->wantsJson()
        return User::create([
        return Validator::make($data, [
        }
     *
     *
     * @param  array  $data
     * @param  array  $data
     * @return \App\User
     * @return \Illuminate\Contracts\Validation\Validator
     * Create a new user instance after a valid registration.
     * Get a validator for an incoming registration request.
     */
     */
    */
    /*
    /**
    /**
    protected function create(array $data)
    protected function validator(array $data)
    public function register(Request $request)
    use RegistersUsers;
    {
    {
    {
    }
    }
    }
<?php
class MemberController extends Controller
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role;
{
}