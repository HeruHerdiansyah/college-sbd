<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Http\Requests\Pasien\CreatePasienRequest;
use App\Http\Requests\Pasien\UpdatePasienRequest;
use App\Exports\PasiensExport;
use Maatwebsite\Excel\Facades\Excel;

class PasienController extends Controller
{
    public function __construct(){
        $this->pasien = new Pasien;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePasienRequest $request)
    {
        try {
            DB::beginTransaction();

            $a = $this->pasien->create([
                'no_pasien' => 'P-'.time(),
                'name' => $request->name,
                'no_ktp' => $request->no_ktp,
                'address' => $request->address,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'email' => $request->email,
            ]);

            toastr()->success('Data berhasil dibuat');
            DB::commit();
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat pembuatan data');
            DB::rollback();
        }
        return redirect()->route('pasien');
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
        return view('pasien.create', ['data' => $this->pasien->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasienRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            if($check = $this->pasien->find($id)){
                $check->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'email' => $request->email,
                ]);

                toastr()->success('Data berhasil diubah');
                DB::commit();
            }else{
                toastr()->error('Data tidak ditemukan');
                DB::rollback();
            }
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat ubah data');
            DB::rollback();
        }
        return redirect()->route('pasien');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            if($check = $this->pasien->find($id)){
                $check->delete();

                toastr()->success('Data berhasil dihapus');
                DB::commit();
            }else{
                toastr()->error('Data tidak ditemukan');
                DB::rollback();
            }
        } catch (Exception $e) {
            toastr()->error('Terjadi kesalahan saat hapus data');
            DB::rollback();
        }
        return back();
    }

    public function table(Request $req)
    {
        $data = $this->pasien->datatables($req);

        return \DataTables::of($data)
            ->addIndexColumn()
            ->removeColumn('id')
            ->editColumn('no_pasien', function($data) {
                return $data->no_pasien;
            })
            ->editColumn('name', function($data) {
                return $data->name;
            })
            ->editColumn('no_ktp', function($data) {
                return $data->no_ktp;
            })
            ->editColumn('age', function($data) {
                $tgl_lahir = $data->date_of_birth;
                $tgl_now = date_format(now(), "Y-m-d");
                $d1 = new \DateTime($tgl_now); 
                $d2 = new \DateTime($tgl_lahir);                                  
                $Months = $d2->diff($d1);

                return ($Months->y) . ' Tahun ' . ($Months->m) . ' Bulan';
            })
            ->addColumn('action', function($data) {
                return $this->datatableAction($data);
    		})
            ->rawColumns(['action'])
            ->make(true);
    }

    private function datatableAction($data)
    {
        $edit = '
        <a href="'.route('pasien.edit', $data->id).'" class="btn btn-primary btn-xs align-items-center" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
        <form method="post" action="'.route('pasien.destroy', $data->id).'" style="display: inline">
        <input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" name="_method" value="delete">
        <button class="btn btn-danger btn-xs align-items-center" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm(\''.__('Anda yakin ingin menghapus data ini?').'\')"><i class="fa fa-trash"></i></button>&nbsp;
        </form>';

        return '<div class="d-flex align-items-center justify-content-center">'.$edit.'</div>';
    }

    public function export() 
    {
        return Excel::download(new PasiensExport, 'pasiens.xlsx');
    }
}
