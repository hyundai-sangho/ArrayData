<?php

declare(strict_types=1);

$connect = mysqli_connect("localhost", "root", "whtkdgh1", "crud");

$order_array = array(
  "0" => array("스마트폰", "1", "5000"),
  "1" => array("보조 배터리", "1", "500"),
  "2" => array("셀카봉", "1", "250")
);

// 각 행에 대한 반복 삽입 명령
function option1(array $array, mysqli $connect)
{
  if (is_array($array)) {
    foreach ($array as $row => $value) {
      $item_name = mysqli_real_escape_string($connect, $value[0]);
      $quantity = mysqli_real_escape_string($connect, $value[1]);
      $price = mysqli_real_escape_string($connect, $value[2]);

      $sql = "INSERT INTO item (item_name, qty, price) VALUES ('$item_name', '$quantity', '$price')";
      mysqli_query($connect, $sql);
    }
  }
}

option1($order_array, $connect);

// 모든 배열 값을 배열에 연결하여 단일 삽입 명령
function option2(array $array, mysqli $connect)
{
  if (is_array($array)) {
    $values = array();

    foreach ($array as $row => $value) {
      $item_name = mysqli_real_escape_string($connect, $value[0]);
      $quantity = mysqli_real_escape_string($connect, $value[1]);
      $price = mysqli_real_escape_string($connect, $value[2]);

      $values[] = "('$item_name', '$quantity', '$price')";
    }
    $sql = "INSERT INTO item (item_name, qty, price) VALUES " . implode(", ", $values);

    mysqli_query($connect, $sql);
  }
}

option2([['장난감', '2', '50000']], $connect);

?>
