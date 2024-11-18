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
    
    function validateEmail($field_list, $field_name) {
        $errors = [];
        if (trim($field_list[$field_name]) == "")
            array_push($errors, "field $field_name tidak boleh kosong");
            return $errors;

        if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "email tidak valid!");
        } 

        return $errors;
        
    }
    
    function validatePassword($field_list, $field_name){
        if(trim($field_list[$field_name]) == "")
        {
            return ["password tidak boleh kosong"];
        }

        if (strlen(trim($field_list[$field_name])) < 8){
            return ["password minimal 8 character"];
        } 

        return [];
    }
    
    function validateStreetAddress($field_list, $field_name) {
        if (trim($field_list[$field_name]) == ""){
            return ["street address tidak boleh kosong"];
        }
        return [];
    }

    function validatejenisKelamin($field_list, $field_name) {
        if (trim($field_list[$field_name]) == ""){
            return ["pilih  jenis kelamin"];
        }

        if ($field_list[$field_name] != "laki-laki" and $field_list[$field_name] != "perempuan") {
            return ["jenis kelamin tidak valid"];
        }

        return [];
    }

    function validateHobi($field_list, $field_name) {
        $valid_hobi = ["berenang", "berlari"];
        if ($field_list[$field_name] == null or count($field_list[$field_name]) < 1) {
            return ["hobi tidak boleh kosong"];
        }

        foreach($field_list[$field_name] as $hobi) {
            if (!in_array($hobi, $valid_hobi)) {
                return ["hobi tidak valid"];
            }
        }

        return [];

    }

    function validateState($field_list, $field_name) {
        $valid_state = ["jawa-timur", "jawa-barat", "sumatera-barat", "kalimantan-barat"];
        if (trim($field_list[$field_name]) == ""){
            return ["state tidak boleh kosong"];
        }

        if (!in_array($field_list[$field_name], $valid_state)) {
            return ["state tidak valid"];
        }

        return [];

        
    }
?>