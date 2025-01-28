<?php 

class Checker {

    public function pdf_type_checker($file){

       $allowed_type = ['application/pdf'];
       $file_type = mime_content_type($file['tmp_name']);

       if(!in_array($file_type, $allowed_type)){
            $allowed_types_string = implode(', ', $allowed_type);
            return "Invalid file type $file_type . Allowed type $allowed_types_string";
       }
       else {
        return true;
    }


    }


    public function pic_type_checker($file){

        $allowed_type = ['image/png','image/jpg','image/jpeg'];
        $file_type = mime_content_type($file['tmp_name']);
 
        if(!in_array($file_type, $allowed_type)){
             $allowed_types_string = implode(',', $allowed_type);
             return "Invalid file type $file_type . Allowed type $allowed_types_string";
        }

        else {
            return true;
        }
 
     }

    public function pdf_size_checker($file){

        $max_size_mb = 3;

        $file_size = round($file['size']/(1024*1024),3);

        if($file_size > $max_size_mb){
           return "File size exceeds the limit of 3 MB. Your file is $file_size MB." ;

        }
        else {
            return true;
        }
    }
    
    
    public function pic_size_checker($file){

        $max_size_mb = 1; 

        $file_size = round($file['size']/(1024*1024),3);

        if($file_size > $max_size_mb){
            return "File size exceeds the limit of 1 MB. Your file is $file_size MB." ;

        }

        else {
            return true;
        }
    }

    public function pdf_validate($file){

        $tvalidate = $this->pdf_type_checker($file);
        if($tvalidate !== true){
            return $tvalidate;
        }

        $svalidate = $this ->pdf_size_checker($file);
        
        if($svalidate !== true){
            return $svalidate;
        }

        else {
            return true;
        }

    }

        
    public function pic_validate($file){

        $tvalidate = $this->pic_type_checker($file);
        if($tvalidate !== true){
            return $tvalidate;
        }

        $svalidate = $this ->pic_size_checker($file);
        
        if($svalidate !== true){
            return $svalidate;
        }

        else {
            return true;
        }

    }

        // checks the file size and limits it if need be.
        // takes data straight from the add product page and add pattern 

    }
?>