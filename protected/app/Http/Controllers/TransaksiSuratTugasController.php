<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller,
    Illuminate\Support\Facades\DB as DB,
    App\Http\Controllers\MDIPA\MDIPAListController as MDipa,
    App\Http\Controllers\TSuratTugas\TSuratTugasDListController as TPSuratTugasD,
    App\Http\Controllers\TSuratTugas\TSuratTugasHListController as TPSuratTugasH,
    App\Http\Controllers\MKota\MKotaListController as MKota,
    App\Http\Controllers\MUnitKerja\MUnitKerjaListController as MUnitKerja,
    App\Http\Controllers\MEmployee\MEmployeeListController as MEmployee,
    App\Http\Controllers\MDepartment\MDepartmentListController as MDepartment,
    App\Http\Controllers\MSetNumber\MSetNumberListController as MSetNumber,
    App\Http\Controllers\MSupplier\MSupplierListController as MSupplier,
    Illuminate\Http\Request;
use Session;
use Auth;

class TransaksiSuratTugasController extends Controller
{
    public function index() {

        $data_kota = (new MKota)->get_list();
        $data_dipa = (new MDIPA)->get_list();
        $data_department = (new MDepartment)->get_list();
        $data_surat_tugas_h = (new TPSuratTugasH)->get_all_list();
        $data_employee = (new MEmployee)->get_list();
        $data_work_unit = (new MUnitKerja)->get_list();

//        foreach ($data_surat_tugas_h as $data) {
//            dd($data[3]);
//            foreach ($data['suratTugasD'] as $data2) {
//                dd($data2->employee_name);
//            }
//        }

//        for ($i = 0; $i<count($data_surat_tugas_h);$i++) {
//            dd($data_surat_tugas_h);
//            foreach ($data_surat_tugas_h[$i]['suratTugasD'] as $data2) {
//                dd($data2->employee_name);
//            }
//        }


       return view('modul_transaksi/surat_tugas/surat_tugas')
           ->with('data_kota',$data_kota)
           ->with('data_work_unit',$data_work_unit)
           ->with('data_dipa',$data_dipa)
           ->with('data_employee',$data_employee)
           ->with('data_department',$data_department)
           ->with('data_surat_tugas_h',$data_surat_tugas_h)
           ;
    }
    public function store(Request $request) {
//        dd($request);
        if (!is_null($request)) {
            $MSetNumber     = (new MSetNumber())->generateNumber("Surat Tugas");

            $new_surat_tugasH                           = new TPSuratTugasH();
            $new_surat_tugasH->assigment_letter_code    = $MSetNumber;
            $new_surat_tugasH->start_date               = $request->dari_tanggal;
            $new_surat_tugasH->end_date                 = $request->sampai_tanggal;
            $new_surat_tugasH->idKota                   = $request->kota;
            $new_surat_tugasH->idDIPA                   = $request->dipa;
            $new_surat_tugasH->description              = $request->keterangan;
            $new_surat_tugasH->idDepartment             = $request->department;
            $new_surat_tugasH->description_1            = $request->keterangan1;
            $new_surat_tugasH->created_by               = Auth::user()->id;
            $new_surat_tugasH->assignment_letter_status = 1;
            $new_surat_tugasH->hotel_status             = 1;
            $new_surat_tugasH->plane_status             = 1;
            $new_surat_tugasH->created_at               = $request->tanggal_surat;

            $new_surat_tugasH->create();

            $data_last_h = (new TPSuratTugasH())->get_last();

            if(!is_null($request->employee) && !is_null($request->lama_penugasan)) {
                for ($i = 0; $i< count($request->employee); $i++) {
                    if ($request->employee[$i] != 0 && $request->lama_penugasan[$i] !=0) {
                        $new_surat_tugasD                = new TPSuratTugasD();
                        $new_surat_tugasD->idSuratTugas_H = $data_last_h[0]->id;

                        $the_employee = new MEmployee($request->employee[$i]);
                        $new_surat_tugasD->idEmployee = $the_employee->id;
                        $new_surat_tugasD->idJabatan = $the_employee->idJabatan;
                        $new_surat_tugasD->idGolongan = $the_employee->idGolongan;
                        $new_surat_tugasD->plane_status = 1;
                        $new_surat_tugasD->hotel_status = 1;

                        $new_surat_tugasD->days = $request->lama_penugasan[$i];

                        $new_surat_tugasD->create();
                    }
                }
            }
        }

//        dd($request);

        Session::flash('sukses',"Data Surat Tugas berhasil diinput.");
        return redirect()->back();
    }

    public function delete(Request $request)
    {

        $TSuratH = new TPSuratTugasH($request->surat_id);
        $TSuratD = (new TPSuratTugasD)->get_surat_tugas_d_id_h($TSuratH->id);

        $count = 0;

        foreach ($TSuratD as $data) {
            (new TPSuratTugasD)->deleteByIdH($data->id, $data->idSuratTugas_H);
            $count++;
        }
        $TSuratH->delete();

        Session::flash('sukses-delete', 'Anda berhasil menghapus data Surat Tugas');
        return redirect()->back();

    }

    public function edit($id)
    {
        $data_kota              = (new MKota)->get_list();
        $data_dipa              = (new MDIPA)->get_list();
        $data_department        = (new MDepartment)->get_list();
        $data_surat_tugas_h     = (new TPSuratTugasH)->get_surat_tugas_h($id);
        $data_employee          = (new MEmployee)->get_list();
        // dd($data_surat_tugas_h);
        return view('modul_transaksi/surat_tugas/edit_surat_tugas')
            ->with('data_kota', $data_kota)
            ->with('data_dipa',$data_dipa)
            ->with('data_department', $data_department)
            ->with('data_employee',$data_employee)
            ->with('data_surat',$data_surat_tugas_h)
            ;

    }

    public function update(Request $request)
    {
     //   dd($request);
        $id_user = Auth::user()->id;

        if ($id_user) {

            $new_surat_tugasH                           = new TPSuratTugasH($request->id);
            $new_surat_tugasH->start_date               = $request->dari_tanggal;
            $new_surat_tugasH->end_date                 = $request->sampai_tanggal;
            $new_surat_tugasH->idKota                   = $request->kota;
            $new_surat_tugasH->idDIPA                   = $request->dipa;
            $new_surat_tugasH->description              = $request->keterangan;
            $new_surat_tugasH->idDepartment             = $request->department;
            $new_surat_tugasH->description_1            = $request->keterangan1;
            $new_surat_tugasH->created_by               = Auth::user()->id;
            $new_surat_tugasH->assignment_letter_status = 1;
            $new_surat_tugasH->hotel_status             = 1;
            $new_surat_tugasH->plane_status             = 1;
            $new_surat_tugasH->created_at               = $request->tanggal_surat;

            $new_surat_tugasH->update();

            $surat_tugas_d                  = (new TPSuratTugasD())->deleteAllByIdH($request->id);

            if(!is_null($request->employee) && !is_null($request->lama_penugasan)) {
                for ($i = 0; $i< count($request->employee); $i++) {
                    if ($request->employee[$i] != 0 && $request->lama_penugasan[$i] !=0) {
                        $new_surat_tugasD                   = new TPSuratTugasD();
                        $new_surat_tugasD->idSuratTugas_H   = $request->id;

                        $the_employee                   = new MEmployee($request->employee[$i]);
                        // dd($request->employee);
                        $new_surat_tugasD->idEmployee   = $the_employee->id;
                        $new_surat_tugasD->idJabatan    = $the_employee->idJabatan;
                        $new_surat_tugasD->idGolongan   = $the_employee->idGolongan;
                        $new_surat_tugasD->plane_status = 1;
                        $new_surat_tugasD->hotel_status = 1;

                        $new_surat_tugasD->days         = $request->lama_penugasan[$i];

                        $new_surat_tugasD->create();
                    }
                }
            }

            Session::flash('sukses', 'Data Surat Tugas sukses di-update');
            return redirect(url(action('TransaksiSuratTugasController@index')));
        }
    }

}
