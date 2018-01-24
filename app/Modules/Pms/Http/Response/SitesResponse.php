<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/4/2017
 * Time: 4:49 PM
 */

namespace App\Modules\Pms\Http\Response;



use App\Models\Pms\Pms_Site;
use Illuminate\Support\Facades\Auth;

class SitesResponse
{
  public function upload($request)
  {
      if(!$request->contact_paper_url)
      {
       return null;
      }
      if($request->hasFile('contact_paper_url'))
      {
          $file = $request->file('contact_paper_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;

          $success = $file->move('uploads/pms/sites/', $new_file_name);

          if($success)
          {
             return 'uploads/pms/sites/'.$new_file_name;

          }
          return null;
      }

      return null;

  }
  public function uploadUpdate($site,$request)
  {
      if(!$request->contact_paper_url)
      {
       return null;
      }
      if($request->hasFile('contact_paper_url'))
      {
          $file = $request->file('contact_paper_url');
          $file_name = $file->getClientOriginalName();
          $without_extention = substr($file_name, 0, strrpos($file_name, "."));
          $file_extention = $file->getClientOriginalExtension();
          $num = rand(1, 500);
          $new_file_name = $without_extention.$num.'.'.$file_extention;

          $success = $file->move('uploads/pms/sites/', $new_file_name);

          if($success)
          {

              if($site["contact_paper_url"] && is_file($site["contact_paper_url"])){
               unlink($site["contact_paper_url"]);
              }
             return 'uploads/pms/sites/'.$new_file_name;

          }
          return null;
      }

      return null;

  }

  public function store($request,$uploadfile)
  {
    $billing_period_from = $request->billing_period_from;
    $billing_period_to = $request->billing_period_to;

    if($billing_period_from == ''){
        $billing_period_from = Null;
    }

    if($billing_period_to ==''){
        $billing_period_to = Null;
    }

    $authid = Auth::id();

    $site = new Pms_Site();
    $site->contact_paper_url =  $uploadfile;
    $site->company_name =  $request->company_name;
    $site->address =  $request->address;
    $site->contact_person =  $request->contact_person;
    $site->position =  $request->position;
    $site->contact_number =  $request->contact_number;
    $site->wages_rate =  $request->wages_rate;
    $site->billing_period_from =  $billing_period_from;
    $site->billing_period_to =  $billing_period_to;
    $site->bill_to =  $request->bill_to;
    $site->updated_by =  $authid;
    $site->created_by =  $authid;
    if($site->save())
    {
        return $site;
    }

    return null;


  }

  public function update($site,$request,$uploadfile)
  {
      $billing_period_from = $request->billing_period_from;
      $billing_period_to = $request->billing_period_to;

      if($billing_period_from == ''){
          $billing_period_from = Null;
      }

      if($billing_period_to ==''){
          $billing_period_to = Null;
      }

      $authid = Auth::id();


      if(!empty($uploadfile) && !is_null($uploadfile)){
       $site->contact_paper_url =  $uploadfile;
      }

      $site->company_name =  $request->company_name;
      $site->address =  $request->address;
      $site->contact_person =  $request->contact_person;
      $site->position =  $request->position;
      $site->contact_number =  $request->contact_number;
      $site->wages_rate =  $request->wages_rate;
      $site->billing_period_from =  $billing_period_from;
      $site->billing_period_to =  $billing_period_to;
      $site->bill_to =  $request->bill_to;
      $site->updated_by =  $authid;
      if($site->save())
      {
          return $site;
      }

      return null;
  }
}