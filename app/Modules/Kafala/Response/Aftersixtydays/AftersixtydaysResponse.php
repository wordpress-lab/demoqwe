<?php
namespace App\Modules\Kafala\Response\Aftersixtydays;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Ontik
 * Date: 11/22/2017
 * Time: 11:19 AM
 */
class AftersixtydaysResponse
{
    public $file = null;

    public function singleRecruite($id)
    {
        $kafala = Iqamaacknowledgement::leftjoin("recruitingorder","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                                        ->leftjoin("aftersixydays","recruitingorder.id","aftersixydays.recruitingorder_id")
                                        ->whereNotNull("iqamaacknowledgements.file_url")
                                        ->where("iqamaacknowledgements.file_url","!="," ")
                                        ->where("recruitingorder.status",1)
                                        ->where("recruitingorder.id",$id)
                                        ->select("recruitingorder.*","aftersixydays.file_url as file_url","aftersixydays.date_of_payment as date_of_payment","aftersixydays.grama_rate as grama_rate","aftersixydays.receive_date as receive_date")
                                        ->first();
        return $kafala;
    }
    public function upload(Request $request)
    {
        if(!is_object($request)){
            return null;
        }

       if(!$request->hasFile("file_url"))
       {
          return null;
       }

        $this->file = $request->file("file_url");
        $newfile = null;
        $oldfile = public_path($request["old_file"]);
        if($this->file)
        {
            $file_name = $this->file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $this->file->getClientOriginalExtension();
            $new_file_name = $without_extention.uniqid().'.'.$file_extention;
            $success = $this->file->move('uploads/kafala/file',$new_file_name);
            if(!$success)
            {
                return null;
            }
            $newfile = 'uploads/kafala/file/'.$new_file_name;
            if(is_file($oldfile))
            {
                unlink($oldfile);
            }

        }

        return $newfile;


    }
}