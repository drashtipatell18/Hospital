<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
   public function doctor(){
        return view('doctor.view_doctor');
   }

   public function doctorCreate(Request $request){

   }

   public function doctorEdit($id){

   }

   public function doctorUpdate(Request $request, $id){

   } 

   public function doctorDelete($id){

   }
}
