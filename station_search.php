<!DOCTYPE html>
<html lang="en-US">

<head>
</head>

<header><h1>Station search</h1></header>
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
<form action="occurence_search_result.php" method="post">
    <label>Name:<input type="text" name="name"></label><br>
    <label>City:<input type="text" name="age"></label><br>
    <input type="submit" value="Search">
</form>
</html>