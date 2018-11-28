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

function GetAllOcc_type(){
  global $db;
  $query = $db->prepare('SELECT * FROM occ_type');
  $query->execute();
  return $query->fetchAll();
}

function GetPersonnel($positions){
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE position = ?');
  $query->execute(array($positions));
  return $query->fetchAll();
}

function AddOcurrence($type, $title, $chief_detective, $state, $oppening_date, $location, $description){
  global $db;
  $stmt = $db->prepare('INSERT INTO occurrences (id, type, title, chief_detective, state, oppening_date, location, description) VALUES (NULL,?,?,?,?,?,?,?)');
  return $stmt->execute([$type, $title, $chief_detective, $state, $oppening_date, $location, $description]);
}