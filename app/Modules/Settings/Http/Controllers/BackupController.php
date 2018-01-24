<?php

namespace App\Modules\Settings\Http\Controllers;


use App\Models\Backup\backupschedule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use mysqli;

use App\Models\Backup\backup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use ZipArchive;


class BackupController extends Controller
{


    public function index()
    {
        $backup = backup::orderBy('id','DESC')->get();

        return view('settings::backup.index', compact('backup'));
    }

    public function setSchedule(){

     //$backupschedule = backupschedule::first();

      Artisan::call('email:backupschedule');

    }

    public function schedule()
    {
       $schedule = backupschedule::count();
       if($schedule){
       $schedule = backupschedule::latest()->first();
       return view('settings::backupschedule.index',compact('schedule'));
       }else{
           $schedule = new backupschedule();
           $schedule->mail = "example@yourmail.com";
           $schedule->intervaldays = 7;
           $schedule->save();

           $this->setSchedule();
           return view('settings::backupschedule.index',compact('schedule'));
       }


    }

    public function scheduleUpdate(Request $request,$id){

        $this->validate($request, [
            'days' => 'required|max:365|numeric',
            'to_mail' => 'required|email',

        ]);
        try{
            $schedule =  backupschedule::find($id);
            $schedule->mail = $request->to_mail;
            $schedule->intervaldays = $request->days;
            $schedule->save();
           // $this->setSchedule();
            return back()->with('status', 'success')
                ->with('msg', 'BackUp Schedule Updated successfully!');
        }catch (\Exception $e){


            return back()->with('status', 'danger')
                ->with('msg', 'Sorry, something went wrong! Data cannot be updated.');
        }


    }

    public function download($id)
    {
        try{
            $bak = backup::find($id);
            $bak->updated_by =Auth::id();
            $bak->save();
            $file= storage_path($bak->file_url);
            $headers = array(
                'Content-Type: text/sql',
            );
            $autofile = explode('/',$bak->file_url);


            return Response::download($file,$autofile[1], $headers);
        }catch(\Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException $exception)
        {

            return back()->with('msg','File not found')->with('status', 'danger');
        }
        catch(\Exception $e)
        {

        }
    }

    public function create()
    {

        try{
            ini_set('max_execution_time', 8000);
            $this->EXPORT_TABLES('localhost',config::get('database.connections.mysql.username'),config::get('database.connections.mysql.password'),config::get('database.connections.mysql.database'),$tables=false,$backup_name=false,$filename);
            $bak = new backup();
            $bak->file_url= "db/".$filename;
            $bak->created_by =Auth::id();
            $bak->updated_by =Auth::id();
            $bak->save();
            $file= storage_path($bak->file_url);
            $headers = array(
                'Content-Type: text/sql',
            );
            $autofile = explode('/',$bak->file_url);
            return Response::download($file,$autofile[1], $headers);
        }catch (\Exception $e){

           // dd($e);
              return back()->with('msg','File createtion failed,timeout')->with('status', 'danger');
        }

    }

   public function  EXPORT_TABLES($host,$user,$pass,$name,$tables=false, $backup_name=false,&$backup_name_)
   {
   set_time_limit(8000);
   $mysqli = new mysqli($host,$user,$pass,$name);
   $mysqli->select_db($name);
   $mysqli->query("SET NAMES 'utf8'");
   $queryTables = $mysqli->query('SHOW TABLES');
    while($row = $queryTables->fetch_row()) {
     {
      $target_tables[] = $row[0];
     }
    if($tables !== false)
     {
        $target_tables = array_intersect($target_tables,$tables);
     }
   }

   $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET FOREIGN_KEY_CHECKS=0;\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
         foreach($target_tables as $table)
         {
          if(empty($table))
          {
            continue;
          }
           $result = $mysqli->query('SELECT * FROM `'.$table.'`');
           $fields_amount=$result->field_count;
           $rows_num=$mysqli->affected_rows;
           $res = $mysqli->query('SHOW CREATE TABLE '.$table);
           $TableMLine=$res->fetch_row();
           $content .= "\n\n".$TableMLine[1].";\n\n";
           for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0){
           while($row = $result->fetch_row())
           { //when started (and every after 100 command cycle):
            if($st_counter%100 == 0 || $st_counter == 0 )
            {
                $content .= "\nINSERT INTO ".$table." VALUES";
            }
              $content .= "\n(";    for($j=0; $j<$fields_amount; $j++)
            {
                $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
                if (isset($row[$j]))
                {
                    $content .= '"'.$row[$j].'"';
                }else
                {
                 $content .= '""';
                }
                if($j<($fields_amount-1))
                {
                 $content.= ',';
                }
            }
              $content .=")";
            //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
            if((($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
            {
              $content .= ";";
            }
            else
            {
             $content .= ",";
            }
                $st_counter=$st_counter+1;
            }
         }
            $content .="\n\n\n";
       }
       $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
       $content .= "\n\n\n\r\nSET FOREIGN_KEY_CHECKS=1;\r\n";

       $backup_name_ = $backup_name?$backup_name : $name."_".date('H-i-s')."_".date('d-m-Y')."_".rand(1,11111111).".sql";
        //ob_get_clean();
       // header('Content-Type: application/octet-stream');
        //header("Content-Transfer-Encoding: Binary");
        //header("Content-disposition: attachment;filename=\"".$backup_name."\"");
       file_put_contents(storage_path('db/'.$backup_name_), $content);


      }



}
