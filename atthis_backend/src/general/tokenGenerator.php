<?php

class tokenGenerator{
    public function generate($username){
        $date = date('YmdGisu');
        $token = $date.$username;
        return md5($token);
    }
}