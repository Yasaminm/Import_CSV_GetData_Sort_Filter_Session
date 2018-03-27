
<?php

function importCSV2DB($csvFile, $tbName, $delimiter = ',' , $columNames = FALSE){
    $handle = fopen($csvFile, 'r');
    if($columNames === FALSE){
    $columNames = fgetcsv($handle, 0, $delimiter, '"');
    } 
    $z = 0;
    while(($row = fgetcsv($handle, 0, $delimiter, '"')) !==FALSE){
        $z++;
        printf('%s. Stadt: %s <br>',$z,$row[0]);
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>City</th>
                        <th>City_ascii</th>
                        <th>lat</th>
                        <th>lng</th>
                        <th>pop</th>
                        <th>Country</th>
                        <th>iso2</th>
                        <th>iso3</th>
                        <th>Province</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
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
