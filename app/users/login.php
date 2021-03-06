<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['password'])) {
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->execute();
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	$dbPassword = $user['password'];

	if (password_verify($password, $dbPassword)) {
			$_SESSION['user'] = [
			'id' 		=> $user['id'],
			'firstname' => $user['first_name'],
			'lastname' 	=> $user['last_name'],
			'username' 	=> $user['username'],
			'email' 	=> $user['email'],
			'password' 	=> $user['password'],
			'avatar' 	=> $user['avatar']
		];

		redirect('/home.php');
	}	else {
		//not working??
		$_SESSION['error'] = "wrong password!";
	}
	redirect('/../login.php');
}
