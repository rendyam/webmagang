<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            $_SESSION['user_id'] = $userId;
            return redirect('dashboard/riwayat');
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return view('auth.login', compact('msg'));
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
    public function destroy($id)
    {
        //
    }
}
