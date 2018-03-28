<?php
session_start();
if(!isset($_SESSION['prevOrderCol'])){
    $_SESSION['prevOrderCol'] = ' ';
}

require_once './config.php';

function getAllData($tblName, $columnNames = ['*'], $orderColumns = ['id'], $sort = 'ASC', $filter="%") {
    $pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
    $cols = implode(',', $columnNames);
    $orderCols = implode(',', $orderColumns);
    $where = "WHERE  city LIKE '$filter%'";
    $query = "SELECT $cols FROM $tblName $where ORDER BY $orderCols $sort";
    $stmt = $pdo->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

$columnNames = ['country', 'province', 'city', 'pop'];
//order
$orderCol = filter_input(1, 'order', 513);
if ($orderCol) {
    $_SESSION['$orderCol'] = $orderCol;
}elseif (!isset ($_SESSION['$orderCol'])){
    $_SESSION['$orderCol'] = 'country';
}

//if(isset($orderCol)){ 
//$rows = getAllData('tb_cities', $columnNames, [$orderCol]);
//}else{
//    $rows = getAllData('tb_cities', $columnNames);
//}

//sort
$sort = filter_input(1, 'sort', 513);
if ($_SESSION['$orderCol'] !== $_SESSION['prevOrderCol']){
    $sort = 'ASC';
}
//filter
$filter = filter_input(1, 'filter', 513);
//$filter = ($filter) ? $filter : '%'; 
if ($filter) {
    $_SESSION['$filter'] = $filter;
}elseif (!isset ($_SESSION['$filter'])){
    $_SESSION['$filter'] = '%';
}
$rows = getAllData('tb_cities', $columnNames, [$_SESSION['$orderCol']], $sort, $_SESSION['$filter']);

$sort = ($sort === 'ASC') ? 'DESC' : 'ASC';
$_SESSION['prevOrderCol'] = $_SESSION['$orderCol'];

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
            <form cla="form-inline" method="get">
                <label>
                    <input placeholder="City" class="form-control" type="text" name="filter" value="<?php echo $filter ?>">
                </label>
                <button class="btn btn-primary">Filtern</button>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                        <th><a href="index.php?order=country&sort=<?php echo $sort ?>">Land</a></th>
                        <th><a href="index.php?order=province&sort=<?php echo $sort ?>">Region</a></th>
                        <th><a href="index.php?order=city&sort=<?php echo $sort ?>">Stadt</a></th>
                        <th><a href="index.php?order=pop&sort=<?php echo $sort ?><?php ?>">Einwohner</a></th>
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
