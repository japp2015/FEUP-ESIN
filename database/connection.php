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

function getOccurrenceById($id) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurrences WHERE id = ?');
  $query->execute(array($id));
  return $query->fetch();
}

function GetAllOcc_type(){
  global $db;
  $query = $db->prepare('SELECT * FROM occ_type');
  $query->execute();
  return $query->fetchAll();
}

function GetPersonnelStation($positions, $station){
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE position = ? AND station = ?');
  $query->execute(array($positions, (int) $station));
  return $query->fetchAll();
}

function AddOcurrence($type, $title, $chief_detective, $state, $oppening_date, $location, $description){
  global $db;
  $stmt = $db->prepare('INSERT INTO occurrences (id, type, title, chief_detective, state, oppening_date, location, description) VALUES (NULL,?,?,?,?,?,?,?)');
  return $stmt->execute([$type, $title, $chief_detective, $state, $oppening_date, $location, $description]);
}

function GetStationByID($id){
  global $db;
  $query = $db->prepare('SELECT * FROM stations WHERE id = ?');
  $query->execute([$id]);
  return $query->fetch();
}

function GetStationByUsername($username){
  global $db;
  $query = $db->prepare('SELECT station FROM personnel WHERE username= ?');
  $query->execute([$username]);
  return $query->fetch();
}

function GetNotesByUsername($username){
  global $db;
  $query = $db->prepare('SELECT * FROM notes WHERE personnel_username = ? ');
  $query->execute(array($username));
  return $query->fetchAll();
}

function AddNote($username, $title, $text){
  global $db;
  $stmt = $db->prepare('INSERT INTO notes (id, personnel_username, title, text) VALUES (NULL,?,?,?)');
  return $stmt->execute([$username, $title, $text]);
}

function DeleteNote($id){
  global $db;
  $stmt = $db->prepare('DELETE FROM notes WHERE id = ?');
  return $stmt->execute([$id]);
}

function GetAllStations(){
  global $db;
  $query = $db->prepare('SELECT * FROM stations ');
  $query->execute();
  return $query->fetchAll();
}

function AddStation($name, $city, $adress, $chief){
  global $db;
  $stmt = $db->prepare('INSERT INTO stations (id, name, city, adress, chief) VALUES (NULL,?,?,?,?)');
  return $stmt->execute([$name, $city, $adress, $chief]);
}

function GetAllSchools(){
  global $db;
  $query = $db->prepare('SELECT * FROM schools ');
  $query->execute();
  return $query->fetchAll();
}