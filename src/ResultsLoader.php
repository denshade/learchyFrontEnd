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
        $queryElements = explode(" ", $q);
        $combined = [];
        $counter = 1;
        $map = [];
        foreach( $queryElements as $queryElement)
        {
            $combined []=  " value LIKE :query$counter";
            $map[":query$counter"] = "%$queryElement%";
            $counter++;
        }
        $v = "SELECT * FROM keywords 
            INNER JOIN keyword2url ON keywords.idkeywords = keyword2url.idkeyword
            INNER JOIN url ON url.idurl = keyword2url.url
            WHERE ". implode(" OR ", $combined);
        $statement = $this->pdo->prepare($v);

        $statement->execute($map);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
}