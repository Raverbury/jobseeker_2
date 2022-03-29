<?php

class LoginModel extends Model {
	public function executeQuery($params) { // $params should be $_POST, passed from a controller
		// extracting, validating login info
		$username = htmlspecialchars($params['username']);
		if ($username === '') {
			$this->result['message'] = 'The username cannot be empty.';
			return;
		}
		$password = htmlspecialchars($params['password']);
		if ($password === '') {
			$this->result['message'] = 'The password cannot be empty.';
			return;
		}
		$id = NULL;
		$role = NULL;
		$retrievedPassword = NULL;
		// retrieving user info
		$query = 'SELECT id, username, password, role FROM users WHERE username = ?';
		if ($statement = $this->dbInstance->prepare($query)) {
			$statement->bind_param('s', $username);
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		if ($statement->execute()) {
			$statement->store_result();
			if ($statement->num_rows == 1) {
				$statement->bind_result($id, $username, $retrievedPassword, $role);
				if ($statement->fetch()) {
					if (password_verify($password, $retrievedPassword)) {
						$this->result['message'] = 'OK';
						$this->result['id'] = $id;
						$this->result['username'] = $username;
						$this->result['role'] = $role;
					}
					else {
						$this->result['message'] = 'The password provided is incorrect.';
					}
				}
				else {
					$this->result['message'] = 'Something went wrong. Please try again later.';
					return;
				}
			}
			else {
				$this->result['message'] = 'Could not find a user with the provided username.';
			}
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
	}
}

?>