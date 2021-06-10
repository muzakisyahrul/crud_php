<?php
require_once "koneksi.php";

function select_all($query)
{
    global  $koneksi;
    $result = mysqli_query($koneksi, $query);
    $data = array();
    while ($d = mysqli_fetch_assoc($result)) {
        $data[] = $d;
    }
    return $data;
}

function select_one($query)
{
    global  $koneksi;
    $result = mysqli_query($koneksi, $query);
    $data = array();
    if ($result) {
        $data = mysqli_fetch_assoc($result);
    }
    return $data;
}

function insert_data($query)
{
    global  $koneksi;
    $result = mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}

function update_data($query)
{
    global  $koneksi;
    $result = mysqli_query($koneksi, $query);
    return true;
}

function delete_data($query)
{
    global  $koneksi;
    $result = mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}
