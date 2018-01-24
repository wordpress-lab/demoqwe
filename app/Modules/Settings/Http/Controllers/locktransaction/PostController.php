<?php

namespace App\Modules\Settings\Http\Controllers\locktransaction;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use mysqli;
class PostController extends Controller
{
   public function edit()
   {


       if(file_exists(base_path() . '/.tempenv'))
       {
           $data =  file_get_contents(base_path() . '/.tempenv');
           $op = unserialize($data);
           return view('settings::locktransaction.index', compact('op'));
       }
       else
       {
           $username=config('database.connections.mysql.username');
           $temp_username=config('database.connections.mysql.temp_username');
           $op = new \stdClass();
           $op->status = 0;
           $op->username = $username;
           $op->tempuser = $temp_username;
           $temp_env = serialize($op);
           file_put_contents(base_path() . '/.tempenv', $temp_env);
           return view('settings::locktransaction.index', compact('op'));
       }

   }

   public function update(Request $request)
   {
     $status = $request->status;
       if($status==1)
       {

           $username=config('database.connections.mysql.temp_username');
           $temp_username=config('database.connections.mysql.username');

       }
       elseif($status==0)
       {

           $username=config('database.connections.mysql.temp_username');
           $temp_username=config('database.connections.mysql.username');

       }
       $op = new \stdClass();
       $op->status = $status;
       $op->username = $username;
       $op->tempuser = $temp_username;

       $temp_env = serialize($op);
       file_put_contents(base_path() . '/.tempenv', $temp_env);
       $env_update = $this->changeEnv([
           'DB_USERNAME'   => $username,
           'DB_TEMP_USERNAME' => $temp_username,

       ]);
       if($env_update)
       {
           return redirect()
               ->route('locktransaction')
               ->with('alert.status', 'success')
               ->with('alert.message', 'Change transaction!');
       }
       else
       {
           return redirect()
               ->route('locktransaction')
               ->with('alert.status', 'success')
               ->with('alert.message', ' Not change transaction!');
       }


   }

    protected function changeEnv($data = array()){
        if(count($data) > 0)
        {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value)
            {

                // Loop through .env-data
                foreach($env as $env_key => $env_value)
                {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key)
                    {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    }
                    else
                    {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

        return true;
        }
        else
        {
            return false;
        }
    }

    function array_flat($my_array)
    {
        $fa = array();
        $l = 0;
        foreach($my_array as $k => $v )
        {
            if( !is_array( $v ) )
            {
                $fa[ ]= $v;

                continue;
            }
            $l++;
            $fa= array_flat( $v, $fa, $l );
            $l--;
        }

        if( $l == 0 ) $fa = array_values( array_unique( $fa ) );
        return $fa;
    }
}
