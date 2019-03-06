<?php

	class DBController {

		private $hostname 		= 		"localhost";

		private $username 		= 		"root";

		private $password 		= 		"";

		private $database		=       "api_crud";


		// DB connection
		public function connect() {
			$conn 		=		new mysqli($this->hostname, $this->username, $this->password, $this->database) or die("Database connection error" .$conn->error());
			return $conn;
		}


		// Close connection
		public function close($conn) {
			$conn->close();
		}

		// Test function
		public function test() {
			echo "Hello this is test message";
		}


	}

?>