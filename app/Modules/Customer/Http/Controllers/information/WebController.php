<?php

namespace App\Modules\Customer\Http\Controllers\information;

use App\Models\Contact\Customer_file;
use App\Models\Contact\Subreference;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class WebController extends Controller
{

    public function autosuggest(Request $request)
    {
        $name = $request->name;

        //$recruit_customer = Recruit_customer::where('column', 'LIKE', '%value%')->get();
        $recruit_customer = Subreference::where('name', 'LIKE', "%$name%")->get()->unique('name');



        return response($recruit_customer);

    }
    public function edit($id)
    {


           $allcustomer = [];
           $subref=[];
           $Rorder=Recruitorder::where('paxid',$id)->first();
           if($Rorder->count())
           {
               $allcustomer = Recruit_customer::where('pax_id','!=',$Rorder->id)->get();
           }


           $customer_info=Recruit_customer::firstOrNew(array('pax_id' => $Rorder->id));

           $subref = $customer_info->RecruitCustomer->transform(function ($item, $key) {
               return $item['name'];
           })->toArray();


           $customer_info->recruit_id = $Rorder->id;
           $customer_info->pax_id = $Rorder->id;
           $customer_info->save();
           return view('customer::information.edit',compact('id','Rorder','customer_info','allcustomer','subref'));
    }

    public function subReference($customer=null,$reference=[])
    {
       $data= [];
       $ref= [];
       $refine_ref=[];
       if(is_null($reference))
       {
           Subreference::where('recruit_customer_id',$customer)->delete();
           return true;
       }
       if(is_array($reference) && is_integer($customer) )
       {
           $ref = new RecursiveIteratorIterator(new RecursiveArrayIterator($reference));
           foreach($ref as $value)
           {
            $refine_ref[] = $value;
           }
           Subreference::where('recruit_customer_id',$customer)->delete();
           $id=null;
           foreach ($refine_ref as $key=>$value)
           {
               if(!empty($value))
               {
                   $subref = new Subreference();
                   $subref->recruit_customer_id = $customer;
                   $subref->name =$value;
                   $subref->parent_id =$id?$id:null;
                   $subref->order =++$key;
                   $subref->save();
                   $id = $subref->id;
               }


           }



           return true;
       }

       return false;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

       try{
          $custinfo=Recruit_customer::find(base64_decode($request->id));
          $custinfo->dateOfBirthEN = $request->dateOfBirthEN;
          $custinfo->dateOfBirthBN = $request->dateOfBirthBN;
          $custinfo->placeOfBirth = $request->placeOfBirth;
          $custinfo->gender = $request->gender;
          $custinfo->addressEN = $request->addressEN;
          $custinfo->addressBN = $request->addressBN;
          $custinfo->religionEN = $request->religionEN;
          $custinfo->religionBN = $request->religionBN;
          $custinfo->previousNationality = $request->previousNationality;
          $custinfo->presentNationality = $request->presentNationality;
          $custinfo->maritalStatus = $request->maritalStatus;
          $custinfo->group = $request->group;
          $custinfo->guardianName = $request->guardianName;
          $custinfo->guardianFatherName = $request->guardianFatherName;
          $custinfo->guardianAddressEN = $request->guardianAddressEN;
          $custinfo->guardianReligion = $request->guardianReligion;
          $custinfo->motherName = $request->motherName;
          $custinfo->fatherName = $request->fatherName;
          $custinfo->relationWithCustomer_1 = $request->relationWithCustomer_1;
          $custinfo->relationWithCustomer_2 = $request->relationWithCustomer_2;
          $custinfo->qualification = $request->qualification;
          $custinfo->professionEn = $request->professionEn;
          $custinfo->professionBn = $request->professionBn;
          $custinfo->professionAR = $request->professionAR;
          $custinfo->businessAddressEN = $request->businessAddressEN;
          $custinfo->businessAddressBN = $request->businessAddressBN;
          $custinfo->purposeOfTravel = $request->purposeOfTravel;
          $custinfo->durationOfStay = $request->durationOfStay;
          $custinfo->departureDate = $request->departureDate;
          $custinfo->arrivalDate = $request->arrivalDate;
          $custinfo->visaAdvice = $request->visaAdvice;
          $custinfo->destination = $request->destination;
          $custinfo->passengerNameBN = $request->passengerNameBN;
          $custinfo->passportNumberBN = $request->passportNumberBN;
          $custinfo->contact_number = $request->contact_number;
          $custinfo->sub_reference = null;

          if($custinfo->save())
          {
            $this->subReference($custinfo->id,$request->sub_reference);
              if ($request->hasFile('img_url'))
              {
                  foreach ($request->img_url as $key=>$file)
                  {
                      $index= substr($key, 0, 3 );
                      if ($index =='old')
                      {
                          $fileName = uniqid() . 'st.' . $file->getClientOriginalName();
                          $file->move(public_path('all_image'), $fileName);

                          $id=explode('_',$key)[1];
                          $entry=Customer_file::find($id);
                          $image_path = public_path("all_image/$entry->img_url");
                          $entry->title=$request->title[$key];
                          $entry->img_url=$fileName;

                          if ($entry->save()){

                              if(file_exists($image_path))
                              {
                                  unlink($image_path);
                              }
                          }

                      }else{

                          if (is_array($request->title[$key])) {
                              $tit = array_keys($request->title[$key])[0];
                              $title = $request->title[$key][$tit];
                          } else {
                              $title = $request->title[$key];
                          }

                          if (is_array($request->img_url[$key])) {
                              $amou = array_keys($request->img_url[$key])[0];
                              $file = $request->img_url[$key][$amou];
                          } else {
                              $file = $request->img_url[$key];
                          }

                          $fileName = uniqid() . '.' . $file->getClientOriginalName();
                          $file->move(public_path('all_image'), $fileName);

                          $visa_entry = new Customer_file();
                          $visa_entry->customer_id = $custinfo->id;
                          $visa_entry->title = $title;
                          $visa_entry->img_url = $fileName;
                          $visa_entry->save();
                      }
                  }
                  DB::commit();
                  return Redirect::route('order')->withInput()->with('alert.status', 'success')
                      ->with('alert.message', 'Customer  Updated successfully!');
              }else{

                  if(isset($request->img_id))
                  {

                      $t=Customer_file::whereNotIn('id', $request->img_id)->get();

                      foreach ($t as $value){

                          $image_path = public_path("all_image/$value->img_url");

                          if ( $value->delete()){
                              if(file_exists($image_path))
                              {
                                  unlink($image_path);
                              }
                          }
                      }
                  }

                  DB::commit();
                  return Redirect::route('order')->withInput()->with('alert.status','success')->with('alert.message', 'Customer  Updated successfully!');
              }

          }

      }catch (\Exception $d){

          DB::rollBack();
          return redirect()->back()->withInput()->with('alert.status', 'danger')
              ->with('alert.message', 'Customer information not Updated !');
      }


    }

}
