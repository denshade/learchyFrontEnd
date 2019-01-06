<?php
require_once ("src/ResultsLoader.php");
$loader = new ResultsLoader();
$value = "";
if (key_exists("q", $_GET)) {
    $value = $_GET["q"];
}
?>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>.col-centered{
        float: none;
        margin: 0 auto;
    }
</style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-centered">
    <h1 class="">Learchy</h1>
        </div>
    </div>

    <form class="form">
        <div class="row">
            <div class="col-lg-6 col-centered">
                <div class="input-group">
                    <input name="q" type="text" class="form-control" placeholder="Search for..." value="<?php echo $value; ?>">
                    <span class="input-group-btn">
        <button class="btn btn-default" type="button">Search!</button>
      </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </form>
    <?php
    if (key_exists("q", $_GET) && $value != ""){
        $results = $loader->getResults($_GET["q"]);
        if (count($results) == 0 )
        {
            echo "Sorry no results for " . $_GET["q"].".</BR>";
        } else {
            echo "Results for " . $_GET["q"]."</BR>";
            foreach( $results as $result)
            {
                echo '<a href="'.$result["url"].'">'. $result["url"]. "</a> matched ".$result["value"]."<BR/>";
            }
        }
        ?>
        <?php
    }   ?>
</div>

</body>
</html>
