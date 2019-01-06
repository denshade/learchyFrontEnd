<?php

class ResultsLoader
{


    private $pdo;

    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=learchy', 'lieven', 'lieven', array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));
    }

    public function getResults($q)
    {
        $statement = $this->pdo->prepare("SELECT * FROM keywords 
            INNER JOIN keyword2url ON keywords.idkeywords = keyword2url.idkeyword
            INNER JOIN url ON url.idurl = keyword2url.url
            WHERE value = :query
            ");
        $statement->execute([':query' => $q]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
}