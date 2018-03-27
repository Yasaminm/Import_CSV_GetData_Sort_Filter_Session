
<?php

function importCSV2DB($csvFile, $tbName, $delimiter = ',' , $columNames = FALSE){
    if(!file_exists($csvFile)){
        return FALSE;
    }
    $handle = fopen($csvFile, 'r');
    $pdo = new PDO('mysql:host='. HOST . ';dbname=' . DB, USER, PASSWORD);
    if($columNames === FALSE){
    $columNames = fgetcsv($handle, 0, $delimiter, '"');
    } 
    $cols = implode(',', $columNames);
    $vals = [];
    for ($i = 0; $i < count($columNames); $i++) {
        $tmp[] = '?';
    }
    $vals = implode(',', $tmp);
    
    $query = "INSERT INTO tb_cities($cols) VALUES ($vals)";
    $stmt = $pdo->prepare($query);
    
//    $z = 0;
    while(($row = fgetcsv($handle, 0, $delimiter, '"')) !==FALSE){
        for ($i = 0; $i < count($row); $i++) {
            $stmt->bindParam($i+1, $row[$i], PDO::PARAM_STR);
        }
        $stmt->execute();
//        $z++;
//        printf('%s. Stadt: %s <br>',$z,$row[0]);
    }
}


require_once 'config.php';
$folder = './import/';
$filename = 'simplemaps-worldcities-basic.csv';
$path = $folder . $filename;
$columNames = ['city','city_ascii','lat','lng','pop','country','iso2','iso3','province '];

$do = filter_input(INPUT_POST, 'do', 513);

if($do === 'import'){
    importCSV2DB($path, 'tb_cities');
    //fgetcsv
    //schleife
    //PDO
    //insert
    //bindvalue / -param
    //Ausgabe ok / falsh / Anzahl der Datensätze
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP 09 Import CSV Cities file into Table</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        
        <div class="container">
            <h1>Import einer CSV Datei</h1>
            <hr>
            
        </div>
        <hr>
        <form method="post" class="form-control">
            <button name="do" value="import" class="btn btn-primary">
                Import von: <?php echo $filename?>
            </button>
        </form>
            
        </div>
        <pre>
<?php
?>
        </pre>
        
    </body>
</html>
