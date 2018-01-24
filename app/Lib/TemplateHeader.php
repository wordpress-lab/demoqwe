<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 20-08-17
 * Time: 17.37
 */

namespace App\Lib;


use App\Models\Template\HeaderTemplate;

class TemplateHeader
{

  public function getBanner()
  {
      $header = [];
      $header = HeaderTemplate::latest()->first();

      if($header){
        return $header;
      }else{
        $header = new \stdClass();
        $header->headerType = 0;
        $header->file_url = "uploads/template/banner.png";
      }

      return $header;

  }
}