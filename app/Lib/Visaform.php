<?php namespace App\Lib;

use App\Models\Visa\Visaformagreement;
use App\Models\Visa\Visaformbulk;
use League\Flysystem\Exception;

Class Visaform {


        public function updateformdata($data=null,$id)
        {
            Visaformbulk::where('visaform_id',$id)->delete();
          foreach ($data as $value)
          {
            $v= new Visaformbulk();
            $v->visaform_id = $id;
            $v->name = $value['name'];
            $v->gender = $value['gender'];
            $v->dateofBirth = $value['birth'];
            $v->relationship = $value['relation'];
            $v->save();
          }
        }

        public function updateAgreementdata($agreementdata,$id)
        {
            Visaformagreement::where('visaform_id',$id)->delete();
            foreach($agreementdata as $value)
            {
                $agre= new Visaformagreement();
                $agre->agreementEn = $value['en'];
                $agre->agreementAr = $value['ar'];
                $agre->visaform_id = $id;
                $agre->save();
            }
        }

       public function destroyRow($id=null)
       {
          try{
              \App\Models\Visa\Visaform::find($id)->delete();
              Visaformbulk::where('visaform_id',$id)->delete();
              Visaformagreement::where('visaform_id',$id)->delete();
              return 1;
          }catch (Exception $exception){

              return 0;
          }


       }





}