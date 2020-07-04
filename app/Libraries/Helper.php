<?php

namespace App\Libraries;

class Helper {
    public static function getHumanType($typeCode)
    {
        return str_replace(['-2','-1','1','2'], ['사용취소','충전취소','충전','사용'], $typeCode);
    }

    public static function getMinifiedType($typeCode)
    {
        return str_replace(['-2','-1','1','2'], ['(+)','(-)','+','-'], $typeCode);
    }
}
