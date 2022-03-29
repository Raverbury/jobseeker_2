<?php

class RegisterModel extends Model {
	public function executeQuery($params) { // $params should be $_POST, passed from a controller
		// extracting, validating registration info
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
		$retypePassword = htmlspecialchars($params['retypePassword']);
		if ($retypePassword === '') {
			$this->result['message'] = 'The retyped password cannot be empty.';
			return;
		}
		if ($password !== $retypePassword) {
			$this->result['message'] = 'The passwords do not match.';
			return;
		}
		$password = password_hash($password, PASSWORD_DEFAULT);
		$role = htmlspecialchars($params['role']);
		$id = NULL;
		// checking if username already exists
		$query = 'SELECT username FROM users WHERE username = ?';
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
				$this->result['message'] = 'This username is already taken.';
				return;
			}
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		// adding new user
		$query = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?);';
		if ($statement = $this->dbInstance->prepare($query)) {
			$statement->bind_param('sss', $username, $password, $role);
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		if ($statement->execute()) {
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		// querying info to get id, bruh
		$query = 'SELECT id FROM users WHERE username = ?';
		if ($statement = $this->dbInstance->prepare($query)) {
			$statement->bind_param('s', $username);
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
		if ($statement->execute()) {
			$statement->store_result();
			$statement->bind_result($id);
			if ($statement->fetch()) {
				$this->result['message'] = 'OK';
				$this->result['id'] = $id;
				$this->result['username'] = $username;
				$this->result['role'] = $role;
			}
			else {
				$this->result['message'] = 'Something went wrong. Please try again later.';
				return;
			}
		}
		else {
			$this->result['message'] = 'Something went wrong. Please try again later.';
			return;
		}
	}
}

?>