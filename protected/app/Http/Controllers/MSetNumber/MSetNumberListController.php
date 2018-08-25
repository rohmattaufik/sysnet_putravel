<?php

namespace App\Http\Controllers\MSetNumber;

use App\Http\Controllers\Controller,
  Illuminate\Support\Facades\DB as DB,
  Illuminate\Http\Request;

class MSetNumberListController extends Controller{

    public $id;
    public $transaction_type;
    public $set_number_code;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $updated_by;
 //   public $flag_active;
    public $exist;

    public function __construct($id = false){
        if($id){
            $set_number = DB::table("MSetNumber")
                ->where('id',$id)
                ->first();
                if($set_number){
                    $this->id               = $set_number->id;
                    $this->transaction_type = $set_number->transaction_type;
                    $this->set_number_code  = $set_number->set_number_code;
                    $this->created_at       = $set_number->created_at;
                    $this->updated_at       = $set_number->updated_at;
                    $this->created_by       = $set_number->created_by;
                    $this->updated_by       = $set_number->updated_by;
          //          $this->flag_active      = $set_number->flag_active;
                    $this->exist            = true;
                }else{
                    $this->exist            = false;
                }
        }else{

        }
    }

    public function get_list(){
        return DB::select(DB::raw("CALL MSetNumber_View()"));
    }

    // public function get_set_number($id){
    //     return DB::select(DB::raw("CALL MSetNumber_()"));
    // }

    public function create(){
        return DB::unprepared(DB::raw("CALL MSetNumber_Create('$this->transaction_type', '$this->set_number_code', '$this->created_by')"));
    }

    public function update(){
        return DB::unprepared(DB::raw("CALL MSetNumber_Update($this->id, '$this->transaction_type', '$this->set_number_code', '$this->created_by')"));
    }

    // public function delete(){
    //     return DB::unprepared(DB::raw("CALL MSetNumber_Delete()"));
    // }

}