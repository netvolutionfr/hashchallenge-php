<?php
$time_start = microtime(true);
$handle = fopen('base-hashed-passwords.csv', 'r');
$users = array();
while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
    $users[] = array($data[0], $data[1]);
}

// ouvrir le fichier cain.txt en lecture seule
$fp = fopen("cain.txt", "r");
while (!feof($fp)) {
    $line = rtrim(fgets($fp), "\r\n");
    $hashed = hash('sha256', $line);
    foreach ($users as $user) {
        if ($user[1] == $hashed) {
            echo $user[0] . ' - ' . $line . "\n";
        }
    }
}
fclose($fp);
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Temps d'execution : $time secondes";
