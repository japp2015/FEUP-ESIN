<?php $db = new PDO('sqlite:database/database.db'); 

function validateLogin($username, $password) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = ? ');
  $stmt->execute([$username, $password]);
  return $stmt->fetch();
}

function getUserByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM user WHERE username = ?');
  $query->execute(array($username));
  return $query->fetch();
}

function getOccurenceById($id) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurences WHERE id = ?');
  $query->execute(array($id));
  return $query->fetch();
}

function getOccurenceByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurences JOIN works ON username_personnel = ?');
  $query->execute(array($id));
  return $query->fetch();
}

