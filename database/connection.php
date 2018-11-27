<?php $db = new PDO('sqlite:database/database.db'); 

function validateLogin($username, $password) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM personnel WHERE username = ? AND password = ? ');
  $stmt->execute([$username, $password]);
  return $stmt->fetch();
}

function getUserByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE username = ?');
  $query->execute(array($username));
  return $query->fetch();
}

function getOccurrencesByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurrences JOIN works ON username_personnel = ?');
  $query->execute(array($username));
  return $query->fetchAll();
}

