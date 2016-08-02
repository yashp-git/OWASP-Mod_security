<?php 

    Class csvWriter 

    { 

            

        var $fp=null; 

        var $error; 

        var $state="CLOSED"; 

        var $newRow=false; 

        

       
         

        function csvWriter($file="") 

        { 

            return $this->open($file); 

        } 

        

        /* 

        * @Params : $file : file name of excel file to be created. 

        * if you are using file name with directory i.e. test/myFile.xls 

        * then the directory must be existed on the system and have permissioned properly 

        * to write the file. 

        * @Return : On Success Valid File Pointer to file 

        * On Failure return false 

        */ 

        function open($file) 

        { 

            if($this->state!="CLOSED") 

            { 

                $this->error="Error : Another file is opend .Close it to save the file"; 

                return false; 

            } 

            

            if(!empty($file)) 

            { 

                $this->fp=@fopen($file,"w+"); 

            } 

            else 

            { 

                $this->error="Usage : New ExcelWriter('fileName')"; 

                return false; 

            } 

            if($this->fp==false) 

            { 

                $this->error="Error: Unable to open/create File.You may not have permmsion to write the file."; 

                return $this->error; 

            } 

            $this->state="OPENED"; 

            return $this->fp; 

        } 

        

        function close() 

        { 

            if($this->state!="OPENED") 

            { 

                $this->error="Error : Please open the file."; 

                return false; 

            } 

            if($this->newRow) 

            { 

                fwrite($this->fp,"</tr>"); 

                $this->newRow=false; 

            } 

            

            fclose($this->fp); 

            $this->state="CLOSED"; 

            return TRUE; 

        } 

        /* @Params : Void 

        * @return : Void 

        * This function write the header of Excel file. 

        */ 

                                     



        

        /* 

        * @Params : $line_arr: An valid array 

        * @Return : Void 

        */ 

         

        function writeLine($line_arr) 

        { 

            if($this->state!="OPENED") 

            { 

                $this->error="Error : Please open the file."; 

                return false; 

            } 

            if(!is_array($line_arr)) 

            { 

                $this->error="Error : Argument is not valid. Supply an valid Array."; 

                return false; 

            } 



            foreach($line_arr as $col) 

                fwrite($this->fp,"$col,"); 

            fwrite($this->fp,"\n"); 

        } 

        

        function writeupcLine($line_arr) 

        { 

            if($this->state!="OPENED") 

            { 

                $this->error="Error : Please open the file."; 

                return false; 

            } 

            if(!is_array($line_arr)) 

            { 

                $this->error="Error : Argument is not valid. Supply an valid Array."; 

                return false; 

            } 



            foreach($line_arr as $col) 

            { 

                $upc = strtoupper($col); 

                fwrite($this->fp,"$upc,"); 

            } 

            fwrite($this->fp,"\n"); 

        } 

        

    } 

?> 