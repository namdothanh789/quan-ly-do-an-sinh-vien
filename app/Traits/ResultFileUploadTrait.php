<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ResultFileUploadTrait {
  public function uploadResultFile(Request $request, $inputName, $path, $calendarId)
    {
        if($request->hasFile($inputName)){

            $resultFile = $request->{$inputName};
            $ext = $resultFile->getClientOriginalExtension();
            $resultFileName = 'resultFile_'.uniqid().'.'.$ext;

            $resultFile->move(public_path($path), $resultFileName);

           return $path.'/'.$resultFileName;
       }
    }

    public function updateResultFile(Request $request, $inputName, $path, $calendarId, $oldPath=null)
    {
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $resultFile = $request->{$inputName};
            $ext = $resultFile->getClientOriginalExtension();
            $resultFileName = 'resultFile_'.uniqid().'.'.$ext;

            $resultFile->move(public_path($path), $resultFileName);

           return $path.'/'.$resultFileName;
       }
    }

    /** Handle Delte File */
    public function deleteResultFile(string $path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
