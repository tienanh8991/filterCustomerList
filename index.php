<?php

$customerList = array(
    "0" => array(
        "name" => "Mai Văn Hoàn",
        "day_of_birth" => "1983/08/20",
        "address" => "Hà Nội",
        "image" => "images/img1.jpg"
    ),
    "1" => array(
        "name" => "Nguyễn Văn Nam",
        "day_of_birth" => "1983/08/21",
        "address" => "Bắc Giang",
        "image" => "images/img2.jpg"
    ),
    "2" => array(
        "name" => "Nguyễn Thái Hòa",
        "day_of_birth" => "1983/08/22",
        "address" => "Nam Định",
        "image" => "images/img3.jpg"
    ),
    "3" => array(
        "name" => "Trần Đăng Khoa",
        "day_of_birth" => "1983/08/17",
        "address" => "Hà Tây",
        "image" => "images/img4.jpg"
    ),
    "4" => array(
        "name" => "Nguyễn Đình Thi",
        "day_of_birth" => "1983/08/19",
        "address" => "Hà Nội",
        "image" => "images/img5.jpg"
    )
);

function searchByDate($customers, $fromDate, $toDate)
{
    if (empty($fromDate) && empty($toDate)) {
        return $customers;
    }
    $filteredCustomers = [];
    foreach ($customers as $customer) {
        if (!empty($fromDate) && (strtotime($customer['day_of_birth'])) < strtotime($fromDate)) {
            continue;
        }
        if (!empty($toDate) && (strtotime($customer['day_of_birth'])) > strtotime($toDate)) {
            continue;
        }
        $filteredCustomers[] = $customer;
    }
    return $filteredCustomers;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $dateFrom = $_REQUEST['dateFrom'];
    $dateTo = $_REQUEST['dateTo'];
}
$filteredCustomers = searchByDate($customerList, $dateFrom, $dateTo);

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="get">
    From :
    <input type="date" name="dateFrom">
    To :
    <input type="date" name="dateTo">
    <button type="submit">Filter</button>
</form>
<table>
    <caption><h2>Customer List</h2></caption>
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Birth Day</th>
        <th>Address</th>
    </tr>
    <?php if (count($filteredCustomers) == 0): ?>
        <tr>
            <td colspan="5" class="message">Not Found</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($filteredCustomers as $index => $customer): ?>
        <tr>
            <td> <?php echo $index + 1; ?> </td>
            <td> <?php echo $customer['name']; ?></td>
            <td> <?php echo $customer['day_of_birth']; ?></td>
            <td> <?php echo $customer['address']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
