<?php
	
	class studentsModel
	{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
    			die("Error in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}	

		// insert record
		public function insertRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("INSERT INTO students (nama,panggilan,ttl,alamat,no_hp,kelas,nisn,sekolah,jurusan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$query->bind_param("sssssssss",$obj->nama,$obj->panggilan,$obj->ttl,$obj->alamat,$obj->no_hp,$obj->kelas,$obj->nisn,$obj->sekolah,$obj->jurusan);
				$query->execute();
				$res= $query->get_result();
				$last_id=$this->condb->insert_id;
				$query->close();
				$this->close_db();
				return $last_id;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}
        //update record
		public function updateRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->condb->prepare("UPDATE students SET nama=?,panggilan=?, ttl=?, alamat=?, no_hp=?,kelas=?, nisn=?, sekolah=?,jurusan=? WHERE id=?");
				$query->bind_param("sssssssssi", $obj->nama,$obj->panggilan,$obj->ttl,$obj->alamat,$obj->no_hp,$obj->kelas,$obj->nisn,$obj->sekolah,$obj->jurusan,$obj->id);
				$query->execute();
				$res=$query->get_result();						
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}
        }
         // delete record
		public function deleteRecord($id)
		{	
			try{
				$this->open_db();
				$query=$this->condb->prepare("DELETE FROM students WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->closeDb();
            	throw $e;
        	}		
        }   
        // select record     
		public function selectRecord($id)
		{
			try
			{
                $this->open_db();
                if($id>0)
				{	
					$query=$this->condb->prepare("SELECT * FROM students WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM students");	}		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}
	}

?>