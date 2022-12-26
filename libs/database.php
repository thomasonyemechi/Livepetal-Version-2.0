	<?php

//include("constants.php");

/*
class sqldb {
	var $connect;
		function sqldb()
		{
		$this->connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
 if (!$this->connect) 
			{
				echo "Error: Unable to connect to MySQL." . PHP_EOL;
				echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			return $this->connect; 
		}

	
	function query($query){
	return mysqli_query( $this->connect,$query);
	}
	};
	*/
	

	/* Create database connection */
	//$db = new sqldb;
	$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	
	

?>
