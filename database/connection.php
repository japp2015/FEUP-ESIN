<?php $db = new PDO('sqlite:database/database.db'); 

function generate_random_token() {
  return bin2hex(openssl_random_pseudo_bytes(32));
}

function userExists($username) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM personnel WHERE username = ? ');
  $stmt->execute([$username]);
  return $stmt->fetch();
}

function validateLogin($username, $password) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM personnel WHERE username = ? ');
  $stmt->execute([$username]);
  $user = $stmt->fetch();
  return password_verify($password , $user['password']);
}

function changePassword($new_password, $username) {
  global $db;
  $stmt = $db->prepare('UPDATE personnel SET password = ? WHERE username = ? ');
  return $stmt->execute([password_hash($new_password, PASSWORD_BCRYPT), $username]);
}

function UploadProfilePicture($pic, $username) {
  global $db;
  $stmt = $db->prepare('UPDATE personnel SET profile_pic = ? WHERE username = ?  ');
  return $stmt->execute([$pic, $username]);
}

function getUserByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE username = ?');
  $query->execute(array($username));
  return $query->fetch();
}

function GetStates() {
  global $db;
  $query = $db->prepare('SELECT * FROM states');
  $query->execute();
  return $query->fetchAll();
}
function UpdateState($state, $occurrence){
  global $db;
  $stmt = $db->prepare('UPDATE occurrences SET state = ? WHERE id = ? ');
  return $stmt->execute([$state, $occurrence]);
}

function GetAllOccurrences() {
  global $db;
  $query = $db->prepare('SELECT * FROM occurrences');
  $query->execute();
  return $query->fetchAll();
}

function GetAllUpdates() {
  global $db;
  $query = $db->prepare('SELECT * FROM updates');
  $query->execute();
  return $query->fetchAll();
}

function GetOccurrencesByStation($station) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurrences WHERE station=? ');
  $query->execute(array($station));
  return $query->fetchAll();
}

function GetUpdatesByStation($station) {
  global $db;
  $query = $db->prepare('SELECT updates.* FROM updates JOIN occurrences ON updates.id_occurrence=occurrences.id WHERE station=? ');
  $query->execute(array($station));
  return $query->fetchAll();
}

function GetOccurrencesByUsernameAndMinorOccurrences($username,$station) {
  global $db;
  $query = $db->prepare('SELECT occurrences.* FROM occurrences JOIN occ_type ON type = occ_type.id JOIN works ON occurrences.id = id_occurrence WHERE (username_personnel=? OR (station=? AND relevance=1)) ');
  $query->execute([$username,$station]);
  return $query->fetchAll();
}

function GetUpdatesByUsernameAndMinorOccurrences($username,$station) {
  global $db;
  $query = $db->prepare('SELECT updates.* FROM updates JOIN occurrences ON updates.id_occurrence=occurrences.id JOIN occ_type ON occurrences.type = occ_type.id JOIN works ON occurrences.id = works.id_occurrence WHERE (works.username_personnel=? OR (station=? AND relevance=1)) ');
  $query->execute([$username, $station]);
  return $query->fetchAll();
}

function GetOccurrencesByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT occurrences.* FROM occurrences JOIN works ON id = id_occurrence WHERE username_personnel=? ');
  $query->execute(array($username));
  return $query->fetchAll();
}

function getOcc_TypeById($occurrence) {
  global $db;
  $query = $db->prepare('SELECT * FROM occ_type WHERE id=? ');
  $query->execute(array($occurrence));
  return $query->fetch();
}

function GetUpdatesByUsername($username) {
  global $db;
  $query = $db->prepare('SELECT updates.* FROM updates JOIN occurrences ON updates.id_occurrence=occurrences.id JOIN works ON occurrences.id = works.id_occurrence WHERE works.username_personnel=? ');
  $query->execute(array($username));
  return $query->fetchAll();
}

function GetOccurrencePersonnel($id){
  global $db;
  $query = $db->prepare('SELECT personnel.* FROM personnel JOIN works ON username = username_personnel WHERE id_occurrence=? ');
  $query->execute(array($id));
  return $query->fetchAll();
}

function getOccurrenceById($id) {
  global $db;
  $query = $db->prepare('SELECT * FROM occurrences WHERE id = ?');
  $query->execute(array($id));
  return $query->fetch();
}

function getUpdatesByOccurrenceId($id){
  global $db;
  $query = $db->prepare('SELECT * FROM updates WHERE id_occurrence = ?');
  $query->execute([$id]);
  return $query->fetchAll();
}

function GetOcc_type($relevance){
  global $db;
  $query = $db->prepare('SELECT * FROM occ_type WHERE relevance=?');
  $query->execute([$relevance]);
  return $query->fetchAll();
}

function GetPersonnelStation($positions, $station){
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE position = ? AND station = ?');
  $query->execute(array($positions, (int) $station));
  return $query->fetchAll();
}

function GetPersonnelAvailable($position,$station,$id){
  global $db;
  $query = $db->prepare('SELECT * FROM personnel WHERE position = ? AND station= ? AND personnel.username NOT IN (SELECT username FROM personnel JOIN works ON username=username_personnel AND id_occurrence=?)');
  $query->execute([$position,$station,$id]);
  return $query->fetchAll();
}


function AddWorksPersonnel($personnel_username,$occurrence){
  global $db;
  $stmt = $db->prepare('INSERT INTO works (username_personnel, id_occurrence) VALUES (?,?)');
  return $stmt->execute([$personnel_username,$occurrence]);
}

function AddOccurrence1($type, $title, $state, $oppening_date, $location, $description, $station){
  global $db;
  $stmt = $db->prepare('INSERT INTO occurrences (id, type, title, state, oppening_date, location, description, station) VALUES (NULL,?,?,?,?,?,?,?)');
  return $stmt->execute([$type, $title, $state, $oppening_date, $location, $description, $station]);
}

function AddOccurrence2($type, $title, $chief_detective, $state, $oppening_date, $location, $description, $station){
  global $db;
  $stmt = $db->prepare('INSERT INTO occurrences (id, type, title, chief_detective, state, oppening_date, location, description, station) VALUES (NULL,?,?,?,?,?,?,?,?)');
  return $stmt->execute([$type, $title, $chief_detective, $state, $oppening_date, $location, $description, $station]);
}

function AddUpdate($title, $text, $username, $id_occurrence, $date_hour){
  global $db;
  $stmt = $db->prepare('INSERT INTO updates (id, title, text, username_personnel, id_occurrence, date_hour) VALUES (NULL,?,?,?,?,?)');
  return $stmt->execute([$title, $text, $username, $id_occurrence, $date_hour]);
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

function DeleteUpdate($id){
  global $db;
  $stmt = $db->prepare('DELETE FROM updates WHERE id = ?');
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
  return $stmt->execute([$username, password_hash($password, PASSWORD_BCRYPT), $email, $fullname, $gender, $birthdate, $naturality, $start_service, $school, $position, $station]);
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
  $query->execute(array('Aberto', 12, 'Vítima'));
  return $query->fetchAll();
}

function getOccByMissingPerson($missing) {
  global $db;
  $query = $db->prepare('SELECT occurrences.* FROM occurrences JOIN referenced ON occurrences.id=id_occurrence JOIN person ON id_person=person.id WHERE occurrences.state=? AND occurrences.type=? AND referenced.type=?');
  $query->execute(array('Aberto', 12, 'Vítima'));
  return $query->fetch();
}

function GetStations() {
  global $db;
  $query = $db->prepare('SELECT * FROM stations');
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

function GetNewById($id) {
  global $db;
  $query = $db->prepare('SELECT * FROM news WHERE id=?');
  $query->execute(array($id));
  return $query->fetch();
}

function AddMissingPerson($gender, $name, $adress, $physical_description, $local, $date, $station){
  global $db;
  $stmt = $db->prepare('INSERT INTO missing_person (id, gender, name, adress, description, local, date, id_station) VALUES (NULL,?,?,?,?,?,?,?)');
  return $stmt->execute([$gender, $name, $adress, $physical_description, $local, $date, $station]);
}

function AddNews($title, $text, $date){
  global $db;
  $stmt = $db->prepare('INSERT INTO news (id, title, text, date) VALUES (NULL,?,?,?)');
  return $stmt->execute([$title, $text, $date]);
}

function GetMissingPeopleByUserStation($username) {
  global $db;
  $query = $db->prepare('SELECT * FROM missing_person JOIN personnel ON id_station=station WHERE username=?');
  $query->execute(array($username));
  return $query->fetchAll();
}

function DeleteMissingPersonById($missing) {
  global $db;
  $stmt = $db->prepare('DELETE FROM missing_person WHERE id = ?');
  return $stmt->execute([$missing]);
}