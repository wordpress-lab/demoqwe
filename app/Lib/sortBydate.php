<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 25-09-17
 * Time: 14.26
 */

namespace App\Lib;


use DateTime;
use Exception;

class sortBydate
{

  protected $modal = null;
  protected $col = null;
  protected $data = array();


  public  function get($modal,$col,$format,$data)
  {
      $collection = [];
      if(!class_exists($modal)){
          return [];
      }
      if(!is_string($col))
      {
          return [];
      }
      if(!is_array($data))
      {
          return [];
      }
      $this->modal = $modal;
      $this->col = $col;
      $date = $this->col;
      $this->data = $data;
      $temp  = $data;
      try{
          usort($this->data,function($a, $b) use ($date,$format)
          {

              $a = date($format,strtotime($a[$date]));
              $b = date($format,strtotime($b[$date]));
              $a_int = DateTime::createFromFormat($format, $a)->getTimestamp();
              $b_int = DateTime::createFromFormat($format, $b)->getTimestamp();
              return ($a_int == $b_int) ? 0 : ($a_int < $b_int) ? 1 : -1;

          });
          $ModalName = $this->modal;
          foreach($this->data as  $item)
          {
              $inv= new $ModalName;
              foreach ($item as $key =>$value){
                  $inv->{$key} = $value;
              }
              $collection[] = $inv;
          }
          return collect($collection);
      }catch (\Exception $exception){

          $ModalName = $this->modal;
          foreach($temp as  $item)
          {
              $inv= new $ModalName;
              foreach ($item as $key =>$value){
                  $inv->{$key} = $value;
              }
              $collection[] = $inv;
          }
          return collect($collection);
      }


  }

}