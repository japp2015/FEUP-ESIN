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

function AddStation($name, $city, $adress){
  global $db;
  $stmt = $db->prepare('INSERT INTO stations (id, name, city, adress) VALUES (NULL,?,?,?)');
  return $stmt->execute([$name, $city, $adress]);
}

function GetAllSchools(){
  global $db;
  $query = $db->prepare('SELECT * FROM schools ');
  $query->execute();
  return $query->fetchAll();
}

function AddPersonnel($username, $password, $email, $fullname, $gender, $birthdate, $naturality, $start_service, $school, $position, $station){
  global $db;
  $stmt = $db->prepare('INSERT INTO personnel (username, password, email, fullname, gender, birthdate, naturality, start_service, school, position, station) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
  return $stmt->execute([$username, $password, $email, $fullname, $gender, $birthdate, $naturality, $start_service, $school, $position, $station]);
}

function getUserStation($username) {
  global $db;
  $query = $db->prepare('SELECT stations.* FROM stations JOIN personnel ON stations.id=station WHERE username = ? ');
  $query->execute(array($username));
  return $query->fetch();
}

function getMissingPeople() {
  global $db;
  $query = $db->prepare('SELECT person.* FROM person JOIN referenced ON person.id=id_person JOIN occurrences ON id_occurrence=occurrences.id WHERE occurrences.state=? AND occurrences.type=? AND referenced.type=?');
  $query->execute(array('Aberto', 'Desaparecimento', 'Vítima'));
  return $query->fetchAll();
}

function getOccByMissingPerson($missing) {
  global $db;
  $query = $db->prepare('SELECT occurrences.* FROM occurrences JOIN referenced ON occurrences.id=id_occurrence JOIN person ON id_person=person.id WHERE occurrences.state=? AND occurrences.type=? AND referenced.type=?');
  $query->execute(array('Aberto', 'Desaparecimento', 'Vítima'));
  return $query->fetch();
}

function GetStations() {
  global $db;
  $query = $db->prepare('SELECT * FROM stations ');
  $query->execute();
  return $query->fetchAll();
}

function CountOccurrencesByStateAndStation($state, $station) {
  global $db;
  $id=$station['id'];
  $query = $db->prepare('SELECT count(occurrences.id) FROM occurrences JOIN stations ON station=stations.id WHERE state=? AND stations.id=?');
  $query->execute([$state,$id]);
  return $query->fetch();
}

function CountOccurrencesByState($state) {
  global $db;
  $query = $db->prepare('SELECT count(occurrences.id) FROM occurrences WHERE state=?');
  $query->execute([$state]);
  return $query->fetch();
}

function GetNews() {
  global $db;
  $query = $db->prepare('SELECT * FROM news');
  $query->execute();
  return $query->fetchAll();
}

function SetStationChief($username, $station){
  global $db;
  $stmt = $db->prepare('UPDATE stations SET chief = ? WHERE id = ? ');
  return $stmt->execute([$username, $station]);
  
}