<?php
class alertSms {
    public function alert($temp) {
        if($temp <23.5) {
//            $filename = "/dev/ttyACM0";
//
//            if (!$handle = fopen($filename, 'r+'))
//            {
//                echo "The device isn't detected";
//                exit;
//            }
//            else
//            {
//                var_dump(fwrite($handle,"AT+CMGS=64\r"));
//                sleep(1);
//                var_dump(fwrite($handle,'07917360120099F911000B917360034428F40000AA39C1B53D2C4FD7DB6F10BDDC8697E5617A5D1E06B9EB6B799AFE06E9CBED74B80E92CD5C35103B9C86CFDDE93A489E16BFE721' . chr(26)."\r"));
//            }
//            fclose($handle);
            echo "siunciu sms " . " " . $temp . "\n";
            return "Down";
        } else if($temp > 25){
//            $filename = "/dev/ttyACM0";
//
//            if (!$handle = fopen($filename, 'r+'))
//            {
//                echo "The device isn't detected";
//                exit;
//            }
//            else
//            {
//                var_dump(fwrite($handle,"AT+CMGS=56\r"));
//                sleep(1);
//                var_dump(fwrite($handle,'07917360120099F911000B917360034428F40000AA2FC1B53D2C4FD7DB6F10BDDC8697E5617A5D1E06D9D3F2795E1D06C96A2076380D9FBBD375903C2D0E8700' . chr(26)."\r"));
//            }
//            fclose($handle);
            echo "siunciu sms " . " " . $temp . "\n";
            return "Up";
        }else
            echo "nesiunciu sms" . " " .$temp . "\n";
            return "Ok";
        }
}
