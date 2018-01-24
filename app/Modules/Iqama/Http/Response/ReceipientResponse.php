<?php
namespace App\Modules\Iqama\Http\Response;

use App\Lib\FacedeFactory\ArrayRequestFlat;
use App\Models\Iqama\Delivery\Receipient;
use App\Models\Iqama\Receive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Ontik
 * Date: 11/18/2017
 * Time: 2:42 PM
 */
class ReceipientResponse
{

     public function save(Request $request)
     {


       $bulk =  new ArrayRequestFlat();
       $name = $bulk->Flatten($request->recipient_name);
       $recruitingorder = $bulk->Flatten($request->recruitingorder_id);


       foreach($recruitingorder as $key=>$item)
       {

           $receive = Receipient::updateOrCreate(
                 ['recruitingorder_id' => $item],
                   ['recipient_name'=>$name[$key],'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
            );
               $receive->saveOrFail();
       }

       return true;
     }
     public function update(Request $request,$id)
     {
      $date = $request->receive_date;
      $this->file = $request->file("file_url");
      $receive = Receive::find($id);
      $oldfile = public_path($receive["file_url"]);
      if($this->file)
      {
         $file_name = $this->file->getClientOriginalName();
         $without_extention = substr($file_name, 0, strrpos($file_name, "."));
         $file_extention = $this->file->getClientOriginalExtension();
         $new_file_name = $without_extention.uniqid().'.'.$file_extention;
         $success = $this->file->move('uploads/iqama/file',$new_file_name);
          if(!$success)
          {
              throw new \Exception("upload to fail");
          }
         $receive->file_url = 'uploads/iqama/file/'.$new_file_name;
         if(is_file($oldfile)){
          unlink($oldfile);    
         }
      }
      $receive->receive_date = $date;
      $receive->updated_by = Auth::Id();
      if($receive->save())
      {
         return true;
      }
      return false;
     }
}