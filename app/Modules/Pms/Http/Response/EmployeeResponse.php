<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/4/2017
 * Time: 4:49 PM
 */

namespace App\Modules\Pms\Http\Response;



use App\Models\Pms\Pms_Employee;
use App\Models\Pms\Pms_Site;
use Illuminate\Support\Facades\Auth;

class EmployeeResponse
{
  public function iqamaUpload($request)
  {
      if(!$request->iqama_url)
      {
       return null;
      }
      if($request->hasFile('iqama_url'))
      {
          $file = $request->file('iqama_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;
          $success = $file->move('uploads/pms/employees/', $new_file_name);
          if($success)
          {
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function iqamaUploadUpdate($emp,$request)
  {
      if(!$request->iqama_url)
      {
       return null;
      }
      if($request->hasFile('iqama_url'))
      {
          $file = $request->file('iqama_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;

          $success = $file->move('uploads/pms/employees/', $new_file_name);

          if($success)
          {

              if($emp["iqama_url"] && is_file($emp["iqama_url"]))
              {
               unlink($emp["iqama_url"]);
              }
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function passportUpload($request)
  {
      if(!$request->passport_url)
      {
       return null;
      }
      if($request->hasFile('passport_url'))
      {
          $file = $request->file('passport_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;
          $success = $file->move('uploads/pms/employees/', $new_file_name);
          if($success)
          {
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function passportUploadUpdate($emp,$request)
  {
      if(!$request->passport_url)
      {
       return null;
      }
      if($request->hasFile('passport_url'))
      {
          $file = $request->file('passport_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;

          $success = $file->move('uploads/pms/employees/', $new_file_name);

          if($success)
          {

              if($emp["passport_url"] && is_file($emp["passport_url"])){
               unlink($emp["passport_url"]);
              }
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function photoUpload($request)
  {
      if(!$request->photo_url)
      {
       return null;
      }
      if($request->hasFile('photo_url'))
      {
          $file = $request->file('photo_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;
          $success = $file->move('uploads/pms/employees/', $new_file_name);
          if($success)
          {
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function photoUploadUpdate($emp,$request)
  {
      if(!$request->photo_url)
      {
       return null;
      }
      if($request->hasFile('photo_url'))
      {
          $file = $request->file('photo_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;

          $success = $file->move('uploads/pms/employees/', $new_file_name);

          if($success)
          {

              if($emp["photo_url"] && is_file($emp["photo_url"])){
               unlink($emp["photo_url"]);
              }
             return 'uploads/pms/employees/'.$new_file_name;

          }
          return null;
      }

      return null;

  }

  public function store($request,$iqamafile=null,$passportfile=null,$photofile=null)
  {
    $authid = Auth::id();

    $emp = new Pms_Employee();
    $emp->photo_url =  $photofile;
    $emp->passport_url =  $passportfile;
    $emp->iqama_url =  $iqamafile;


    $emp->code_name =  $request->code_name;
    $emp->father_name =  $request->father_name;
    $emp->name =  $request->name;
    $emp->date_of_birth =  empty($request->date_of_birth)?null:$request->date_of_birth;
    $emp->nationality =  $request->nationality;
    $emp->arrival_date =  empty($request->arrival_date)?null:$request->arrival_date;
    $emp->passport_number =  $request->passport_number;
    $emp->passport_expiry =  empty($request->passport_expiry)?null:$request->passport_expiry;
    $emp->iqama_number =  $request->iqama_number;
    $emp->iqama_expiry =  empty($request->iqama_expiry)?null:$request->iqama_expiry;
    $emp->site_name =  $request->site_name?$request->site_name:null;
    $emp->basic_salary =  $request->basic_salary;
    $emp->food_allowance =  $request->food_allowance;
    $emp->mobile_number =  $request->mobile_number;
    $emp->daily_work_hour =  $request->daily_work_hour;
    $emp->overtime_amount_per_hour =  $request->overtime_amount_per_hour;
    $emp->remarks =  $request->remarks;
    $emp->updated_by =  $authid;
    $emp->created_by =  $authid;
    if($emp->save())
    {
        return $emp;
    }

    return null;


  }

  public function update($emp,$request,$iqamafile=null,$passportfile=null,$photofile=null)
  {

      $authid = Auth::id();
      if(!empty($iqamafile) && !is_null($iqamafile))
      {
          $emp->iqama_url =  $iqamafile;
      }

      if(!empty($passportfile) && !is_null($passportfile))
      {
          $emp->passport_url =  $passportfile;
      }

      if(!empty($photofile) && !is_null($photofile))
      {
          $emp->photo_url =  $photofile;
      }

      $emp->father_name =  $request->father_name;
      $emp->name =  $request->name;
      $emp->date_of_birth =  empty($request->date_of_birth)?null:$request->date_of_birth;
      $emp->nationality =  $request->nationality;
      $emp->arrival_date =  empty($request->arrival_date)?null:$request->arrival_date;
      $emp->passport_number =  $request->passport_number;
      $emp->passport_expiry =  empty($request->passport_expiry)?null:$request->passport_expiry;
      $emp->iqama_number =  $request->iqama_number;
      $emp->iqama_expiry =  empty($request->iqama_expiry)?null:$request->iqama_expiry;
      $emp->site_name =  $request->site_name?$request->site_name:null;
      $emp->basic_salary =  $request->basic_salary;
      $emp->food_allowance =  $request->food_allowance;
      $emp->mobile_number =  $request->mobile_number;
      $emp->remarks =  $request->remarks;
      $emp->daily_work_hour =  $request->daily_work_hour;
      $emp->overtime_amount_per_hour =  $request->overtime_amount_per_hour;
      $emp->updated_by =  $authid;
      if($emp->save())
      {
          return $emp;
      }

      return null;
  }
}