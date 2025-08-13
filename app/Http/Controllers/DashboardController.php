<?php

namespace App\Http\Controllers;

use App\Models\TRequestApproveTabs;
use App\Models\TRequestTabs;
use App\Models\TResponseDocumentTabs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        if(!isset($_SESSION['user_id']))
            return redirect('/');

        $query = TRequestTabs::query();
        if ($search = $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $data = $query->where('users_tabs_id', $_SESSION['user_id'])->with('status')->orderBy('id', 'desc')->paginate(10);

        return view('pages.pengajuan_index', compact('data'));
    }

    public function verify(Request $request)
    {
        session_start();
        if (!isset($_SESSION['sso_user_id']))
            return redirect('/dashboard/verify');

        $query = TRequestTabs::query();
        if ($search = $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $data = $query->where('m_status_tabs_id', '!=', 1)->with('status')->orderBy('id', 'asc')->paginate(10);

        return view('pages.verifikasi_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');
        $msg = null;
        return view('pages.pengajuan_form', compact('msg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'phone' => 'required:max:15',
            'school' => 'required',
            'levels' => 'required',
            'spesialitation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'jurusan' => 'required',
            'path_cv' => 'required',
            'path_submission_letter' => 'required',
            'path_photo' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = implode(',', $validator->errors()->all());
            return view('pages.pengajuan_form', compact('msg'));
        }

        try {
            DB::beginTransaction();
            $request['users_tabs_id'] = $_SESSION['user_id'];
            $pengajuan = TRequestTabs::create($request->all());
            if ($request->hasFile('path_cv')) {
                $file = $request->file('path_cv');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_cv' => $filename]);
            }
            if ($request->hasFile('path_submission_letter')) {
                $file = $request->file('path_submission_letter');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_submission_letter' => $filename]);
            }
            if ($request->hasFile('path_photo')) {
                $file = $request->file('path_photo');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_photo' => $filename]);
            }

            DB::commit();
            return redirect('/dashboard/riwayat');
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg = 'Data anda gagal disimpan. Tunggu 10 menit sebelum Anda dapat mengulangi pengajuan';
            return view('pages.pengajuan_form', compact('msg'));
        }
    }

    public function storeUpdate($id, Request $request)
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');
        $data = TRequestTabs::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'phone' => 'required:max:15',
            'school' => 'required',
            'levels' => 'required',
            'spesialitation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'jurusan' => 'required',
            'path_cv' => 'required',
            'path_submission_letter' => 'required',
            'path_photo' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = implode(',', $validator->errors()->all());
            return view('pages.pengajuan_edit', compact('msg', 'data'));
        }

        try {
            DB::beginTransaction();
            $request['users_tabs_id'] = $_SESSION['user_id'];
            $pengajuan = TRequestTabs::where('id', $id)->first();
            $pengajuan->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'phone' => $request->phone,
                'school' => $request->school,
                'jurusan' => $request->jurusan,
                'levels' => $request->levels,
                'spesialitation' => $request->spesialitation,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            if ($request->hasFile('path_cv')) {
                $file = $request->file('path_cv');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_cv' => $filename]);
            }
            if ($request->hasFile('path_submission_letter')) {
                $file = $request->file('path_submission_letter');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_submission_letter' => $filename]);
            }
            if ($request->hasFile('path_photo')) {
                $file = $request->file('path_photo');
                $filename = $request->name . '_' . $request->users_tabs_id . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                $pengajuan->update(['path_photo' => $filename]);
            }

            DB::commit();
            return redirect('/dashboard/riwayat');
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg = $th->getMessage(); #'Data anda gagal disimpan. Tunggu 10 menit sebelum Anda dapat mengulangi pengajuan';
            return view('pages.pengajuan_edit', compact('msg', 'data'));
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
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');

        $data = TRequestTabs::where('users_tabs_id', $_SESSION['user_id'])->where('id', $id)->first();
        if (!isset($data)) {
            return redirect('dashboard/riwayat');
        }

        return view('pages.pengajuan_detail', compact('data'));
    }

    public function verifyshow($id)
    {
        session_start();
        if (!isset($_SESSION['sso_user_id']))
            return redirect('/admin/login');

        $data = TRequestTabs::where('id', $id)->with(['requested' => function ($a) {
            $a->with('doc');
        }, 'status', 'lasted'])->first();
        if (!isset($data)) {
            return redirect('dashboard/verify');
        }
        $msg = null;
        return view('pages.verifikasi_detail', compact('data', 'msg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');

        try {
            DB::beginTransaction();
            TRequestTabs::where('id', $id)->update([
                'm_status_tabs_id' => 2
            ]);
            TRequestApproveTabs::create([
                't_request_tabs_id' => $id,
                'm_status_tabs_id' => 2,
            ]);
            DB::commit();
            return redirect('dashboard/riwayat');
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, $th->getMessage());
        }
    }

    public function editpage($id)
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');

        $data = TRequestTabs::where('id', $id)->with('status')->first();
        if (!isset($data)) {
            return redirect('dashboard/riwayat');
        }
        $msg = null;
        return view('pages.pengajuan_edit', compact('data', 'msg'));
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
        session_start();
        if (!isset($_SESSION['sso_user_id']))
            return redirect('/admin/login');
        $validator = Validator::make($request->all(), [
            'm_status_tabs_id' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = implode(',', $validator->errors()->all());
            return view('pages.verifikasi_detail', compact('msg'));
        }

        try {
            DB::beginTransaction();
            $find = TRequestApproveTabs::where('t_request_tabs_id', $id)->orderBy('status_ref', 'desc')->first();
            $data = TRequestTabs::where('id', $id)->with('requested', 'status')->first();
            $data->update([
                'm_status_tabs_id' => $request->m_status_tabs_id,
            ]);
            $requested = TRequestApproveTabs::create([
                't_request_tabs_id' => $id,
                'm_status_tabs_id' => $request->m_status_tabs_id,
                'status_ref' => ((int)$find->status_ref + 1),
                'sso_access_id' => $_SESSION['sso_user_id'],
                'notes' => $request->notes,
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $data->name . '_' . $_SESSION['sso_user_id'] . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/file'), $filename);
                TResponseDocumentTabs::create([
                    't_request_approve_tabs' => $requested->id,
                    'path_document' => $filename
                ]);
            }
            DB::commit();
            return redirect('/dashboard/verify/show/' . $id);
        } catch (\Throwable $th) {
            DB::rollBack();
            abort(400, $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session_start();
        if (!isset($_SESSION['user_id']))
            return redirect('/');
        $find = TRequestTabs::where('id', $id)->delete();
        return redirect('dashboard/riwayat');
    }
}
