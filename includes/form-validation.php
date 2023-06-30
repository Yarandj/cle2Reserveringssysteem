<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($name == "") {
    $errors['name'] = 'Name cannot be empty';
}
if ($email == "") {
    $errors['email'] = 'Email cannot be empty';
}
if ($time == "") {
    $errors['time'] = 'Time cannot be empty';
}
if ($date == "") {
    $errors['date'] = 'Date cannot be empty';
}
/** this error message wil overwrite the previous error when tracks is empty
if ($tracks == "") {
    $errors['tracks'] = 'Tracks cannot be empty';
} */