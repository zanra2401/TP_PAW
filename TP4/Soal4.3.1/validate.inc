<?php
function validateName($field_list, $field_name)
{
    $errors = [];
    if (trim($field_list[$field_name]) == "")
        array_push($errors, "field $field_name tidak boleh kosong");


    $pattern = "/^([a-zA-Z'-]||)+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name]))
        array_push($errors, "$field_name tidak boleh berisi selain alfabet, ', -");
    
    return $errors;
}