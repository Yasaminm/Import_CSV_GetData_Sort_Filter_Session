<?php
require_once './config.php';

function getAllData($tblName, $columnNames = ['*'], $orderColumns = ['id']) {
    $pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
    $cols = implode(',', $columnNames);
    $orderCols = implode(',', $orderColumns);
    $query = "SELECT $cols FROM $tblName ORDER BY $orderCols";
    $stmt = $pdo->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}



$columnNames = ['country', 'province', 'city', 'pop'];

$orderCol = filter_input(1, 'order', 513);

$orderCol = ($orderCol) ? $orderCol : 'country';

$rows = getAllData('tb_cities', $columnNames, [$orderCol]);
 
//if(isset($orderCol)){ 
//$rows = getAllData('tb_cities', $columnNames, [$orderCol]);
//}else{
//    $rows = getAllData('tb_cities', $columnNames);
//}
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                        <th><a href="index.php?order=country">Land</a></th>
                        <th><a href="index.php?order=province">Region</a></th>
                        <th><a href="index.php?order=city">Stadt</a></th>
                        <th><a href="index.php?order=pop">Einwohner</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <?php foreach ($row as $val) : ?>
                                <td><?php 
                                
                                echo (is_numeric($val)) ? number_format($val, 2, ',', '.') : $val;
                                ?>
                                
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr>
        
            
        </div>
        <pre>
<?php

?>
        </pre>
        
    </body>
</html>
