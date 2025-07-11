<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RegisterPasien;
use App\Models\Pasien;
use App\Http\Requests\RegisterPasien\CreateRegisterPasienRequest;
use App\Http\Requests\RegisterPasien\UpdateRegisterPasienRequest;
use App\Exports\RegisterPasiensExport;
use Maatwebsite\Excel\Facades\Excel;

class RegisterPasienController extends Controller
{
    public function __construct(){
        $this->register = new RegisterPasien;
        $this->pasien = new Pasien;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register-pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = $this->pasien->orderBy('name', 'ASC')->get();

        return view('register-pasien.create', [
            'pasien' => $pasien
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRegisterPasienRequest $request)
    {
        try {
            DB::beginTransaction();

            $a = $this->register->create([
                'pasien_id' => $request->pasien_id,
                'no_register' => 'PR-'.time(),
                'poli_id' => $request->poli_id,
                'pay' => false,
            ]);

            toastr()->success('Data berhasil dibuat');
            DB::commit();
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat pembuatan data');
            DB::rollback();
        }
        return redirect()->route('register-pasien');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->register->find($id);
        $poli = @listPoli()[$data->poli_id] ?: null;

        $data->poli = $poli;
        $data->created = $data->created_at ? date_format($data->created_at, "Y-m-d H:i:s") : '-';

        return view('register-pasien.invoice', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            if($check = $this->register->find($id)){
                $check->update([
                    'pay' => true
                ]);

                toastr()->success('Layanan berhasil dibayar');
                DB::commit();
            }else{
                toastr()->error('Data tidak ditemukan');
                DB::rollback();
            }
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat pembayaran');
            DB::rollback();
        }
        return redirect()->route('register-pasien');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            if($check = $this->register->find($id)){
                $check->delete();

                toastr()->success('Pendaftaran berhasil dibatalkan');
                DB::commit();
            }else{
                toastr()->error('Data tidak ditemukan');
                DB::rollback();
            }
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat proses pembatalan');
            DB::rollback();
        }
        return back();
    }

    public function table(Request $req)
    {
        $data = $this->register->datatables($req);

        return \DataTables::of($data)
            ->addIndexColumn()
            ->removeColumn('id')
            ->editColumn('no_pasien', function($data) {
                return $data->pasien ? $data->pasien->no_pasien : '-';
            })
            ->editColumn('no_register', function($data) {
                return $data->no_register;
            })
            ->editColumn('poli', function($data) {
                $p = @listPoli()[$data->poli_id] ?: null;
                return @$p['name'] ?: '-';
            })
            ->editColumn('pay_status', function($data) {
                $s = $data->pay ? 'badge badge-success' : 'badge badge-danger';
                $w = $data->pay ? 'Pay' : 'Not Pay';

                return '<span class="'.$s.'">'.$w.'</span>';
            })
            ->editColumn('created_at', function($data) {
                return date_format($data->created_at, "Y-m-d H:i:s");
            })
            ->addColumn('action', function($data) {
                return $this->datatableAction($data);
    		})
            ->rawColumns(['pay_status','action'])
            ->make(true);
    }

    private function datatableAction($data)
    {
        if($data->deleted_at) {
            $edit = '<span class="badge badge-danger">Canceled</span>';
        } else if($data->pay){
            $edit = '<span class="badge badge-success">Done</span>';
        } else {
            $edit = '
            <a href="'.route('register-pasien.edit', $data->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Pay"><i class="fa fa-money-bill-wave"></i></a>&nbsp;
            <form method="post" action="'.route('register-pasien.destroy', $data->id).'" style="display: inline">
            <input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" name="_method" value="delete">
            <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Cancel" onclick="return confirm(\''.__('Batalkan registrasi?').'\')"><i class="fa fa-times"></i></button>&nbsp;
            </form>';
        }

        return '<div class="d-flex">'.$edit.'</div>';
    }

    public function export()
    {
        return Excel::download(new RegisterPasiensExport, 'register-pasiens.xlsx');
    }

    // public function search(Request $req)
    // {
    //     return $this->table($req);
    // }
}
