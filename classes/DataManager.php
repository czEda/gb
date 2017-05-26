<?php

class DataManager {

private $db;

function __construct() {
try {
$this->db = new PDO('mysql:host=localhost;dbname=realtimeknihanavstev','root','');
$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$this->db->query("SET NAMES 'utf8'");
} catch(PDOEXCEPTION $e) {
die('[DATABASE]: Nastala chyba! <pre> &gt;&gt; ' . $e->getMessage() . ' &lt;&lt; </pre>');
}
}

public function save($name, $text, $date, $email) {
$query = $this->db->prepare('INSERT INTO messages (name, text, email, date) VALUES (:name, :text, :email, :date)');
$query->bindValue(":name", $name);
$query->bindValue(":text", $text);
$query->bindValue(":email", $email);
$query->bindValue(":date", $date);

return (bool) $query->execute();
}

public function load() {
$query = $this->db->prepare('SELECT * FROM messages ORDER BY id DESC');

if($query->execute()) {
return $query->fetchAll(PDO::FETCH_ASSOC);
} else {
return false;
}
}

}