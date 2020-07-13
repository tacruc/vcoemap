<?php namespace myClasses;

use \PDO;
/**
 * Klasse, verwaltet die Verbindung zur Datenbank. Get Instance gibt eine Datenbankverbindung zurück, wenn noch keine existiert
 * wird eine erstellt.
 */
class ConnectionMysql{

public static $conn = null;
public static $instance = null;

//der Constructor wird protected gesetzt, d.h. von ausserhalb des Objekts kann keine Instanz mehr erstellt werden...
/**
 * Konstruktor der Connection-Klasse
 */
protected function __construct(){
    

    // $dsn = 'mysql:dbname=testdb;host=127.0.0.1';
    // $user = 'dbuser';
    // $password = 'dbpass';
    
    // try {
    //     $dbh = new PDO($dsn, $user, $password);

    $dsn = 'mysql:dbname=leaflet2020;host=127.0.0.1';
    $user = 'root';
    $password = '';
    
    try {
        // self::$conn = new PDO("mysql:host=$servername;dbname=$dbname; username=$username; password=$password");
        self::$conn = new PDO($dsn, $user, $password);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Connection worked!';
    } catch(PDOException $e) {
        // echo 'Fehler! - Datenbankverbindung konnte nicht hergestellt werden '; 
        // echo "Fehler",  $e->getMessage();
    }
}

/**
 * Die statische Methode liefert eine Instanz der im Konstruktor definierten Datenbankverbindung zurück 
 * (Will man eine Instanz der Datenbankverbindung erzeugen, ist man auf die Methode getInstance angewiesen)
 *
 * @return void
 */
public static function getInstance(){
    if(self::$instance == null){
        self::$instance = new ConnectionMysql();
    }
    return self::$conn;
}

/**
 * das Clonen des Objekts außerhalb der Klasse wird unterbunden, durch Überschreiben der clone-Methode 
 * wobei diese auf private gesetzt wird! (verhindert, dass das Singleton-Prinzip umgangen werden kann)
 *
 * @return void
 */
private function __clone(){

}

}




?>