<?

function formattMask($val, $mask) {
    $masked = '';
    $k = 0;
    for($i = 0; $i < strlen($mask); $i++){
        if($mask[$i] == '#'){
            if(isset($val[$k])) $masked .= $val[$k++];
        } else {
            $masked .= $mask[$i];
        }
    }
    return $masked;
}

function removeMask($valor)
{
    return preg_replace('/\D/', '', $valor);
}
