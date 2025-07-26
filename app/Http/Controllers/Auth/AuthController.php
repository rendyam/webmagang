<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SsoAccess;
use App\Models\SsoUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $controller;
    public function __construct(
        Controller $controller
    ) {
        $this->controller = $controller;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = $this->controller->validing($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validate) {
            $msg = $validate;
            return view('auth.login', compact('msg'));
        }

        try {
            session_start();
            $credential = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (!$userId = Auth::attempt($credential)) {
                $msg = "Email atau Password anda salah !";
                return view('auth.login', compact('msg'));
            }
            $_SESSION['user_id'] = auth()->user()->id;
            return redirect('dashboard/riwayat');
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return view('auth.login', compact('msg'));
        }
    }

    public function admin(Request $request)
    {
        $validate = $this->controller->validing($request->all(), [
            'nik' => 'required',
            'password' => 'required',
        ]);
        if ($validate) {
            $msg = $validate;
            return view('auth.login_admin', compact('msg'));
        }

        try {
            session_start();
            $credential = [
                'nik' => $request->nik,
                'password' => $request->password
            ];
            if (!$userToken = auth()->guard('admin')->attempt($credential)) {
                return abort(400, "Informasi akun tidak valid");
            }
            $user = Auth::guard('admin')->user($userToken);
            $findAccess = SsoAccess::where('users_id', $user->id)->first();
            if (!isset($findAccess)) {
                $msg = 'Anda tidak memiliki akses terhadap Aplikasi ini. Hubungi Manager SDM untuk meminta akses aplikasi';
                return view('auth.login_admin', compact('msg'));
            } else {
                $_SESSION['sso_user_id'] = $user->id;
                return redirect('dashboard/verify');
            }
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return view('auth.login_admin', compact('msg'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->controller->validing($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if($validate){
            $msg = $validate;
            return view('auth.register', compact('msg'));
        }

        try {
            session_start();
            DB::beginTransaction();
            $request['password'] = Hash::make($request->password);
            $user = User::create($request->all());
            DB::commit();
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg = $th->getMessage();
            return view('auth.register', compact('msg'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $_SESSION['user_id'] = null;
            return redirect('/');
        }
        if (isset($_SESSION['sso_user_id'])) {
            $_SESSION['sso_user_id'] = null;
            return redirect('/admin/login');
        }
    }
}
