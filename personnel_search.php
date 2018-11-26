<!DOCTYPE html>
<html lang="en-US">

<head>
</head>

<header><h1>Personnel search</h1></header>
<aside id="rightBar">
    <ul>
        <li><a href="news.php">News</a></li> 
        <li><a href="station.php">Station</a></li>
        <li><a href="new_occurence.php">New Occurence</a></li>
        <li><a href="occurences.php">Occurences</a></li>
        <li><a href="notes.php">Notes</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>
</aside>
<form action="personnel_search_result.php" method="post">
    <label>Gender:</label>
    <label><input type="radio" name="gender" value="male">Male</label>
    <label><input type="radio" name="gender" value="female">Female</label><br>
    <label>Name:<input type="text" name="name"></label><br>
    <label>Age:<input type="number" name="age"></label><br>
    <label>Position:<input type="text" name="position"></label><br>
    <label>First service year:<input type="number" name="year"></label><br>
    <input type="submit" value="Search">
</form>
</html>