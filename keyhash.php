<?php
function gotopass($pass) {
    $salt = 'Tk*jJlrsH:cY]O^Z^/JS2)Pz{)qz:+yCa]^+V0S98Zf$sV[c@hKKG07Q{utg%OlODTS';
    return hash('ripemd160',$salt. $pass);
}
?>