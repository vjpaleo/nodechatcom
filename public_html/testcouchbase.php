<?php
// adjust these parameters to match your installation
$cb = new Couchbase("127.0.0.1:8091", "beer-sample", "", "beer-sample");
$result = $cb->view("dev_beer", "beer_by_name", array('startkey' => 'O', 'endkey' => 'R'));
foreach($result["rows"] as $row) {
echo $row['key'] . "<br/>";
}
?>