<?php
/**
 * Created by PhpStorm.
 * User: Frigy Zoli
 * Date: 2018. 01. 22.
 * Time: 9:45
 */
$hostname = 'localhost';
$username = 'root';
$password = 'd209system';
$DBRMAname='revotica_rma';


if($kapcsolat = mysqli_connect($hostname,$username,$password,$DBRMAname))
{
    $updateFile = 'szallitolevelek.csv';
    if(file_exists($updateFile))
    {
      echo 'YO';
    }
    $table_name = 'szallitolevelek_update_db';

    mysqli_query($kapcsolat,('CREATE TABLE IF NOT EXISTS '. $table_name .' (
         `vevokod` int NOT NULL,
         `sorszam` varchar(20) NOT NULL,
         `kiszallitas_idopont` DATE NOT NULL
        ) DEFAULT CHARSET=utf8;'));
    mysqli_query($kapcsolat,("TRUNCATE TABLE ".$table_name.";"));
    mysqli_query($kapcsolat,("LOAD DATA LOCAL INFILE '" . $updateFile. "' IGNORE INTO TABLE `".$table_name."` CHARACTER SET 'cp1250' FIELDS TERMINATED BY ';'"));


    $table_name = 'szallitolevelek';
    mysqli_query($kapcsolat,'CREATE TABLE IF NOT EXISTS '. $table_name .' (
             `vevokod` int NOT NULL,
             `sorszam` varchar(20) NOT NULL,
             `kiszallitas_idopont` DATE NOT NULL,
             CONSTRAINT szallitolevelek_unique_row UNIQUE (vevokod,sorszam,kiszallitas_idopont)
            ) DEFAULT CHARSET=utf8;');
    mysqli_query($kapcsolat,'INSERT IGNORE INTO `szallitolevelek`(`vevokod`, `sorszam`, `kiszallitas_idopont`) SELECT vevokod,sorszam,kiszallitas_idopont FROM szallitolevelek_update_db;');

      mysqli_close($kapcsolat);
    echo 'RMA ok';
}