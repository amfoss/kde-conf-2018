<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<title>MiniDebConf Registration List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

</head>

<body>
<div style="text-align:center;margin-left:5%;margin-top:10%;margin-right:5%">
    <h1>MiniDebConf Kollam Registration List</h1>
    <a href="getcsv.php"><button class="btn btn-primary">Get CSV</button></a>
    <table class='table table-bordered' style='width:100%'>
        <tr>
            <th>Sl. No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Organization</th>
            <th>City</th>
            <th>Laptop</th>
            <th>Accomodation</th>
            <th>T Shirt</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Paper Title</th>
            <th>Paper Descirption</th>
            <th>Registration Time</th>
        </tr>
<?php
#Database Connection
class database extends SQLite3
{
    function __construct()
    {
        $this->open('minidebconf.db');
    }
}
$db = new database();
$sql = "select * from registration_speaker";
$result = $db->query($sql);
$cnt = 1;
function getval($a)
{
    if($a==0)
    {
        return "False";
    }
    else
    {
        return "True";
    }
}

while ($row = $result->fetchArray(SQLITE3_ASSOC))
{
    echo "<tr>";
    echo "<td class='col-md-3'>".$cnt."</td>";
    echo "<td class='col-md-3'>".$row['NAME']."</td>";
    echo "<td class='col-md-3'>".$row['EMAIL']."</td>";
    echo "<td class='col-md-3'>".$row['ORG']."</td>";
    echo "<td class='col-md-3'>".$row['CITY']."</td>";
    echo "<td class='col-md-3'>".getval($row['LAP'])."</td>";
    echo "<td class='col-md-3'>".getval($row['ACCOM'])."</td>";
    echo "<td class='col-md-3'>".$row['TSHIRT']."</td>";
    echo "<td class='col-md-3'>".$row['ARRIVAL']."</td>";
    echo "<td class='col-md-3'>".$row['DEPARTURE']."</td>";
    echo "<td class='col-md-3'>".$row['TITLE']."</td>";
    echo "<td class='col-md-3'>".$row['DESC']."</td>";
    echo "<td class='col-md-3'>".$row['REGTIME']."</td>";
    echo "</tr>";
    $cnt = $cnt + 1;
}

?>
    </table>
</div>
</body>
</html>
