<?php namespace App\Lib;

use App\Models\Company\Company;
use App\Models\Flight\Flight;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use App\Models\Visa\Visa;
use App\Models\Visa\Visaform;
use App\Models\Visa\Visaformagreement;
use App\Models\Visa\Visaformbulk;
use League\Flysystem\Exception;

Class Visaformpdf
{


 protected $id = null;
 protected $visaform = null;
 protected $recruit_order = null;

    public function __construct($id)
    {
        $this->id = $id;
        $this->visaform = Visaform::find($this->id);
    }

    public function contactinfo()
    {


      $recruitingid = Recruitorder::find($this->visaform->pax_id);
      $this->recruit_order = $recruitingid;
      $helpers= new Helpers();
      return $helpers->getCustomerName($recruitingid->customer_id);

    }

    public function Recruit_customer()
    {
        return Recruit_customer::where('pax_id',$this->visaform->pax_id)->latest()->first();
    }

    public function Visaentry()
    {
        dd($this->visaform);
    }

    public function RecruitOrder()
    {
      return $this->recruit_order;
    }

    public function Flight()
    {

        $carrier= Flight::where('paxid',$this->visaform->pax_id)->latest()->first();

        return $carrier;
    }

    public function IqamaSector()
    {

      return Visa::find($this->recruit_order->registerSerial_id);

    }

    public function ComapanyName()
    {

       return Company::find($this->IqamaSector()->company_id);

    }

    public function NameAr()
    {
        $this->contactinfo();

        return Company::find($this->IqamaSector()->company_id);
    }

    public function Agreement(){

        return $this->visaform;
    }

    public function getCustomer()
    {
        return Recruit_customer::where('pax_id',$this->visaform->pax_id)->first() ;
    }

  }