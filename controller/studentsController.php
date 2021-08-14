<?php
    require 'model/studentsModel.php';
    require 'model/students.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class studentsController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new studentsModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;								
				default:
                    $this->list();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($studenttb)
        {    $noerror=true;
            // Validate nama        
            if(empty($studenttb->nama)){
                $studenttb->nama = "Field is empty.";$noerror=false;
            } elseif(!filter_var($studenttb->nama, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->nama = "Invalid entry.";$noerror=false;
            }else{$studenttb->nama_msg ="";} 

            // Validate panggilan            
            if(empty($studenttb->panggilan)){
                $studenttb->panggilan_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->panggilan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->panggilan_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->panggilan_msg ="";}
            return $noerror;

            // Validate ttl            
            if(empty($studenttb->ttl)){
                $studenttb->ttl_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->ttl, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->ttl_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->ttl_msg ="";}
            return $noerror;

            // Validate alamat            
            if(empty($studenttb->alamat)){
                $studenttb->alamat_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->alamat, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->alamat_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->alamat_msg ="";}
            return $noerror;

             // Validate no HP            
             if(empty($studenttb->no_hp)){
                $studenttb->no_hp_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->no_hp, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->no_hp_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->no_hp_msg ="";}
            return $noerror;

             // Validate kelas            
             if(empty($studenttb->kelas)){
                $studenttb->kelas_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->kelas, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->kelas_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->kelas_msg ="";}
            return $noerror;

             // Validate nisn            
             if(empty($studenttb->nisn)){
                $studenttb->nisn_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->nisn, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->nisn_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->nisn_msg ="";}
            return $noerror;

             // Validate sekolah            
             if(empty($studenttb->sekolah)){
                $studenttb->sekolah_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->sekolah, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->sekolah_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->sekolah_msg ="";}
            return $noerror;

             // Validate jurusan            
             if(empty($studenttb->jurusan)){
                $studenttb->jurusan_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($studenttb->jurusan, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->jurusan_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->jurusan_msg ="";}
            return $noerror;
        }
        // add new record
		public function insert()
		{
            try{
                $studenttb=new students();
                if (isset($_POST['addbtn'])) 
                {   
                    // read form value
                    $studenttb->nama = trim($_POST['nama']);
                    $studenttb->panggilan = trim($_POST['panggilan']);
                    $studenttb->ttl = trim($_POST['ttl']);
                    $studenttb->alamat = trim($_POST['alamat']);
                    $studenttb->no_hp = trim($_POST['no_hp']);
                    $studenttb->kelas = trim($_POST['kelas']);
                    $studenttb->nisn = trim($_POST['nisn']);
                    $studenttb->sekolah = trim($_POST['sekolah']);
                    $studenttb->jurusan = trim($_POST['jurusan']);
                    //call validation
                    $chk=$this->checkValidation($studenttb);                    
                    if($chk)
                    {   
                        //call insert record            
                        $pid = $this -> objsm ->insertRecord($studenttb);
                        if($pid>0){			
                            $this->list();
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {    
                        $_SESSION['studenttbl0']=serialize($studenttb);//add session obj           
                        $this->pageRedirect("view/insert.php");                
                    }
                }
            }catch (Exception $e) 
            {
                $this->close_db();	
                throw $e;
            }
        }
        // update record
        public function update()
		{
            try
            {
                
                if (isset($_POST['updatebtn'])) 
                {
                    $studenttb=unserialize($_SESSION['studenttbl0']);
                    $studenttb->id = trim($_POST['id']);
                    $studenttb->nama = trim($_POST['nama']);
                    $studenttb->panggilan = trim($_POST['panggilan']);
                    $studenttb->ttl = trim($_POST['ttl']);
                    $studenttb->alamat = trim($_POST['alamat']);
                    $studenttb->no_hp = trim($_POST['no_hp']);
                    $studenttb->kelas = trim($_POST['kelas']);
                    $studenttb->nisn = trim($_POST['nisn']);
                    $studenttb->sekolah = trim($_POST['sekolah']);
                    $studenttb->jurusan = trim($_POST['jurusan']);                   
                    // check validation  
                    $chk=$this->checkValidation($studenttb);
                    if($chk)
                    {
                        $res = $this -> objsm ->updateRecord($studenttb);	                        
                        if($res){			
                            $this->list();                           
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {         
                        $_SESSION['studenttbl0']=serialize($studenttb);      
                        $this->pageRedirect("view/update.php");                
                    }
                }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                    $id=$_GET['id'];
                    $result=$this->objsm->selectRecord($id);
                    $row=mysqli_fetch_array($result);  
                    $studenttb=new students();                  
                    $studenttb->id=$row["id"];
                    $studenttb->nama =$row["nama"];
                    $studenttb->panggilan =$row["panggilan"];
                    $studenttb->ttl =$row["ttl"];
                    $studenttb->alamat =$row["alamat"];
                    $studenttb->no_hp =$row["no_hp"];
                    $studenttb->kelas =$row["kelas"];
                    $studenttb->nisn =$row["nisn"];
                    $studenttb->sekolah =$row["sekolah"];
                    $studenttb->jurusan =$row["jurusan"]; 
                    $_SESSION['studenttbl0']=serialize($studenttb);
                    $this->pageRedirect('view/update.php');
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        // delete record
        public function delete()
		{
            try
            {
                if (isset($_GET['id'])) 
                {
                    $id=$_GET['id'];
                    $res=$this->objsm->deleteRecord($id);                
                    if($res){
                        $this->pageRedirect('index.php');
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        public function list(){
            $result=$this->objsm->selectRecord(0);
            include "view/list.php";                                        
        }
    }
		
	
?>