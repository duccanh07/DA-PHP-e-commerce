<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Render_data{
    public function redirectLink($totalItemPageCurrent, $arrLinkBack){
        $expoleArr=explode('/', $arrLinkBack);
        $lengthArr=count($expoleArr);//echo 'Length: '.$lengthArr."<br />";
        if($totalItemPageCurrent == 0){
            if($lengthArr == 2){
                if($expoleArr[1] >= 2){
                    return $expoleArr[0].'/'.($expoleArr[1] - 1);
                }else{
                    return $arrLinkBack;
                }
            }else{
                if($lengthArr == 3){//print_r($expoleArr);echo "<br />";
                    if($expoleArr[2] >= 2){//echo '100: '.$expoleArr[0].'/'.$expoleArr[1].'/'.($expoleArr[2] - 1);
                        return $expoleArr[0].'/'.$expoleArr[1].'/'.($expoleArr[2] - 1);
                    }else{
                        return $arrLinkBack;
                    }
                }
            }
        }else{
            return $arrLinkBack;
        }
    }

    public function getStatus(){
        $status = '';
        $url=explode('/', uri_string());
        if($url[2]=='list-pending'){
            $status = STATUS_PENDING;
        }else if($url[2]=='list-block'){
            $status = STATUS_BLOCK;
        }
        return array(
            'status' => $status,
            'url' => $url[2]
        );
    }
}