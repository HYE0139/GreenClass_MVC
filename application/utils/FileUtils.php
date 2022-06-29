<?php

    function getRandomFileNm($fileName){
        return $fileName = gen_uuid_v4().".".getExt($fileName);
    }

    //확장자를 추출하는 함수
    function getExt($fileName) {
        //return end(explode(".", $fileName));
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    //랜덤아이디값
    function gen_uuid_v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
           mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
           mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
           mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
         );
     }
    