<?php
$f = fopen("list.csv", "w") or die("Unable to open file!");
#Database Connection
class database extends SQLite3
{
    function __construct()
    {
        $this->open('minidebconf.db');
    }
}
$db = new database();
$sql = "select * from registration";
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
fwrite($f,"Sl.No,Name,Email,Organisation,City,Laptop,Accomodation,T-Shirt,Arrival Date,Departure Date,Registration Time\n");
while ($row = $result->fetchArray(SQLITE3_ASSOC))
{
     fwrite($f,$cnt.",".$row['NAME'].",".$row['EMAIL'].",".$row['ORG'].",".$row['CITY'].",".getval($row['LAP']).",".getval($row['ACCOM']).",".$row['TSHIRT'].",".$row['ARRIVAL'].",".$row['DEPARTURE'].",".$row['REGTIME']."\n");
     echo $cnt.",".$row['NAME'].",".$row['EMAIL'].",".$row['ORG'].",".$row['CITY'].",".getval($row['LAP']).",".getval($row['ACCOM']).",".$row['TSHIRT'].",".$row['ARRIVAL'].",".$row['DEPARTURE'].",".$row['REGTIME']."\n";
     $cnt = $cnt + 1;
     
}

fclose($f);
header('location:list.csv');
?>
