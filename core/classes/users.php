<?php 
class users{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function update($othername, $nickname, $email, $phonenumber, $resaddr, $hobbies, $ambition, $twitter, $facebook, $id){

		$query = $this->db->prepare("UPDATE `thermacians` SET
								`othername`		      = ?,
								`nickname`		      = ?,
								`email`			      = ?,
								`phonenumber`	      = ?,
								`residentialaddress`  = ?,
								`hobbies`		      = ?,
								`ambition`	      	  = ?,
								`twitterhandle`		  = ?,
								`facebooklink`        = ?
								
								WHERE `id` 		      = ? 
								");

		$query->bindValue(1, $othername);
		$query->bindValue(2, $nickname);
		$query->bindValue(3, $email);
		$query->bindValue(4, $phonenumber);
		$query->bindValue(5, $resaddr);
		$query->bindValue(6, $hobbies);
		$query->bindValue(7, $ambition);
		$query->bindValue(8, $twitter);
		$query->bindValue(9, $facebook);
		$query->bindValue(10, $id);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function change_password($user_id, $password) {

		global $bcrypt;

		/* Two create a Hash you do */
		$password_hash = $bcrypt->genHash($password);

		$query = $this->db->prepare("UPDATE `admin` SET `password` = ? WHERE `id` = ?");

		$query->bindValue(1, $password_hash);
		$query->bindValue(2, $user_id);				

		try{
			$query->execute();
			return true;
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function recover($email, $generated_string) {

		if($generated_string == 0){
			return false;
		}else{
	
			$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email` = ? AND `generated_string` = ?");

			$query->bindValue(1, $email);
			$query->bindValue(2, $generated_string);

			try{

				$query->execute();
				$rows = $query->fetchColumn();

				if($rows == 1){
					
					global $bcrypt;

					$username = $this->fetch_info('username', 'email', $email); // getting username for the use in the email.
					$user_id  = $this->fetch_info('id', 'email', $email);// We want to keep things standard and use the user's id for most of the operations. Therefore, we use id instead of email.
			
					$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$generated_password = substr(str_shuffle($charset),0, 10);

					$this->change_password($user_id, $generated_password);

					$query = $this->db->prepare("UPDATE `admin` SET `generated_string` = 0 WHERE `id` = ?");

					$query->bindValue(1, $user_id);
	
					$query->execute();

					mail($email, 'Your password', "Hello " . $username . ",\n\nYour your new password is: " . $generated_password . "\n\nPlease change your password once you have logged in using this password.\n\n-Example team");

				}else{
					return false;
				}

			} catch(PDOException $e){
				die($e->getMessage());
			}
		}
	}

    public function fetch_info($what, $field, $value){

		$allowed = array('id', 'username', 'first_name', 'last_name', 'gender', 'bio', 'email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
		if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
		    throw new InvalidArgumentException;
		}else{
		
			$query = $this->db->prepare("SELECT $what FROM `admin` WHERE $field = ?");

			$query->bindValue(1, $value);

			try{

				$query->execute();
				
			} catch(PDOException $e){

				die($e->getMessage());
			}

			return $query->fetchColumn();
		}
	}

	public function confirm_recover($email){

		$username = $this->fetch_info('username', 'email', $email);// We want the 'id' WHERE 'email' = user's email ($email)

		$unique = uniqid('',true);
		$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);
		
		$generated_string = $unique . $random; // a random and unique string

		$query = $this->db->prepare("UPDATE `admin` SET `generated_string` = ? WHERE `email` = ?");

		$query->bindValue(1, $generated_string);
		$query->bindValue(2, $email);

		try{
			
			$query->execute();

			mail($email, 'Recover Password', "Hello " . $username. ",\r\nPlease click the link below:\r\n\r\nhttp://www.example.com/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- Example team");			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public function user_exists($email) {
	
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}
	 
	public function email_exists($email) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email`= ?");
		$query->bindValue(1, $email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function register($username, $password, $email){

		global $bcrypt; // making the $bcrypt variable global so we can use here

		$time 		= time();
		$ip 		= $_SERVER['REMOTE_ADDR']; // getting the admin IP address
		$email_code = $email_code = uniqid('code_',true); // Creating a unique string.
		
		$password   = $bcrypt->genHash($password);

		$query 	= $this->db->prepare("INSERT INTO `admin` (`username`, `password`, `email`, `ip`, `time`, `email_code`) VALUES (?, ?, ?, ?, ?, ?) ");

		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->bindValue(3, $email);
		$query->bindValue(4, $ip);
		$query->bindValue(5, $time);
		$query->bindValue(6, $email_code);

		try{
			$query->execute();

			mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function activate($email, $email_code) {
		
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");

		$query->bindValue(1, $email);
		$query->bindValue(2, $email_code);
		$query->bindValue(3, 0);

		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				
				$query_2 = $this->db->prepare("UPDATE `admin` SET `confirmed` = ? WHERE `email` = ?");

				$query_2->bindValue(1, 1);
				$query_2->bindValue(2, $email);				

				$query_2->execute();
				return true;

			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}


	public function email_confirmed($username) {

		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `admin` WHERE `username`= ? AND `confirmed` = ?");
		$query->bindValue(1, $username);
		$query->bindValue(2, 1);
		
		try{
			
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function login($email, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `admin` WHERE `email` = ?");
		$query->bindValue(1, $email);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			$username           = $data['username'];
			
			if($password === $stored_password){
				return $id;
				return $username;
				return $email;
			} else{
				return false;	
			}
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM `admin` WHERE `id`= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	  	  	 
	public function get_user($id) {

		$query = $this->db->prepare("SELECT * FROM `thermacians` WHERE `id` = ?");
		$query->bindValue(1, $id);
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();

	}
	public function new_entry($firstname, $lastname, $othername, $nickname, $email, $phonenumber, $birthday, $resaddr, $permaddr, $state, $lga, $hobbies, $ambition, $twitter, $facebook, $set, $about, $thumblink, $imagelink) {

		$query 	= $this->db->prepare("INSERT INTO `thermacians` (`firstname`, `lastname`, `othername`, `nickname`, `email`, `phonenumber`, `birthday`, `residentialaddress`, `permanentaddress`, `stateoforigin`, `lga`, `hobbies`, `ambition`, `twitterhandle`, `facebooklink`, `set`, `about`, `thumblink`, `imagelink`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

		$query->bindValue(1, $firstname);
		$query->bindValue(2, $lastname);
		$query->bindValue(3, $othername);
		$query->bindValue(4, $nickname);
		$query->bindValue(5, $email);
		$query->bindValue(6, $phonenumber);
		$query->bindValue(7, $birthday);
		$query->bindValue(8, $resaddr);
		$query->bindValue(9, $permaddr);
		$query->bindValue(10, $state);
		$query->bindValue(11, $lga);
		$query->bindValue(12, $hobbies);
		$query->bindValue(13, $ambition);
		$query->bindValue(14, $twitter);
		$query->bindValue(15, $facebook);
		$query->bindValue(16, $set);
		$query->bindValue(17, $about);
		$query->bindValue(18, $thumblink);
		$query->bindValue(19, $imagelink);

		try{
			$query->execute();

			if ($query) {
				return true;
			}
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	public function retrieve_all($set) {
		$query = $this->db->prepare("SELECT * FROM `thermacians` WHERE `set` = ?");
		$query->bindValue(1, $set);

		try{

			$query->execute();

			$result = $query->fetchAll();
			return $result;

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
	public function delete($id) {
		$query = $this->db->prepare("DELETE FROM `thermacians` WHERE `id` = ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return true;

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}
}