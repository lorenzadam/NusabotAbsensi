<?php

require_once("config.php");

function getAnyTampil($mysqli, $tampil, $tabel, $where, $valueWhere)
{
    $result = mysqli_fetch_row(mysqli_query($mysqli, "SELECT $tampil FROM $tabel where $where = $valueWhere"));

    return $result['0'];
}

function comboBoxSelect($mysqli, $name, $id, $tampil, $tabel, $ignore)
{
    $result = mysqli_query($mysqli, "SELECT $id, $tampil FROM $tabel");

    echo '<select class="custom-select" name="' . $name . '">';
    while ($data = mysqli_fetch_array($result)) {
        if ($data[$id] == $ignore) {
            continue;
        }
        echo '<option value=' . $data[$id] . '>' . $data[$tampil] . '</option>';
    }
    echo '</select>';
}

function comboBoxSelectEdit($mysqli, $name, $id, $tampil, $tabel, $ignore, $value, $tampilValue)
{
    $result = mysqli_query($mysqli, "SELECT $id, $tampil FROM $tabel");

    echo '<select class="custom-select" name="' . $name . '">';
    echo '<option value=' . $value . '>' . $tampilValue . '</option>';
    while ($data = mysqli_fetch_array($result)) {
        if ($data[$id] == $ignore || $data[$id] == $value) {
            continue;
        }
        echo '<option value=' . $data[$id] . '>' . $data[$tampil] . '</option>';
    }
    echo '</select>';
}
