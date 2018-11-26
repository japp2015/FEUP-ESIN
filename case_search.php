<!DOCTYPE html>
<html lang="en-US">

<head>
</head>

<header><h1>Case search</h1></header>
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
<form action="case_search_result.php" method="post">
    <label>Name:<input type="text" name="name"></label><br>
    <label>State:</label>
    <label><input type="radio" name="state" value="open">Open</label>
    <label><input type="radio" name="state" value="closed">Closed</label>
    <label><input type="radio" name="state" value="filed">Filed</label><br>
    <label>Start date:<input type="date" name="age"></label><br>
    <label>Chief detective:<input type="text" name="position"></label><br>
    <label>Case description:</label><br>
    <textarea name="case_description" cols="40" rows="5"></textarea>
    <p>Hint: Use keywords or key phrases separated by semicolons</p>
    <input type="submit" value="Search">
</form>
</html>