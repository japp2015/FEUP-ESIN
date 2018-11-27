<?php $db = new PDO('sqlite:database/database.db'); 

function validateLogin($username, $password) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ? ');
  $stmt->execute([$username, $password]);
  return $stmt->fetch();
}
function userExists($username) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ? ');
  $stmt->execute([$username]);
  return $stmt->fetch();
}