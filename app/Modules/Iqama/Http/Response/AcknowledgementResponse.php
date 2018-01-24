<?php
namespace App\Modules\Iqama\Http\Response;

use App\Lib\FacedeFactory\ArrayRequestFlat;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
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
class AcknowledgementResponse
{

     public function save(Request $request,$id)
     {

       $oldfile= null;
       $new_file = null;
       $name = $request->receive_date;
       $this->file = $request->file("file_url");
       $oldfile = public_path($request["old_file"]);


       if($this->file)
       {
             $file_name = $this->file->getClientOriginalName();
             $without_extention = substr($file_name, 0, strrpos($file_name, "."));
             $file_extention = $this->file->getClientOriginalExtension();
             $new_file_name = $without_extention.uniqid().'.'.$file_extention;

             $success = $this->file->move('uploads/iqama/acknowledgement',$new_file_name);
             if(!$success)
             {
                 throw new \Exception("upload to fail");
             }

             $new_file = 'uploads/iqama/acknowledgement/'.$new_file_name;


       }

       $newdata = ['receive_date'=>$name,'created_by'=>Auth::id(),'updated_by'=>Auth::id()];
       if(!is_null($new_file))
       {
        $newdata["file_url"] = $new_file;
       }


       $receive = Iqamaacknowledgement::updateOrCreate(
                 ['recruitingorder_id' => $id],
                 $newdata
                );

       if($receive->save())
       {

           if(is_file($oldfile) && $this->file){
               unlink($oldfile);
           }
       }


       return true;
     }

}