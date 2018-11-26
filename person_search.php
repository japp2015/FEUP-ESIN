<!DOCTYPE html>
<html lang="en-US">

<head>
</head>

<header><h1>Person search</h1></header>
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
<form action="person_search_result.php" method="post">
    <label>Gender:</label>
    <label><input type="radio" name="gender" value="male">Male</label>
    <label><input type="radio" name="gender" value="female">Female</label><br>
    <label>Name:<input type="text" name="name"></label><br>
    <label>Age:<input type="number" name="age"></label><br>
    <label>Adress:<input type="text" name="adress"></label><br>
    <label>Physical description:</label><br>
    <textarea name="physical_description" cols="40" rows="5"></textarea>
    <p>Hint: Use keywords or key phrases separated by semicolons</p>
    <label>Reference case:<input type="text" name="reference"></label><br>
    <input type="submit" value="Search">
</form>
</html>