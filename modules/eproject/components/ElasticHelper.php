<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 17/9/2560
 * Time: 14:08
 */

namespace app\modules\eproject\components;
use yii\httpclient\Client;

class ElasticHelper
{
    private static function analyze($text){
//        $segment = new Segment();
//        $result = $segment->get_segment_array($text);
//        $text= implode('|', $result);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:9200/komkeao/_analyze')
            ->setData(['analyzer'=>'thai',
                'text'=>$text])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['tokens'];
            $result='';
            foreach ($newUserId as $item) {
                $result = $result . $item['token'] . ' ';
            }
            return $result;
        }else{
            return false;
        }
    }

    public static function index($text,$type){
//        $data = self::analyze($text);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl('http://localhost:9200/komkeao/'.$type)
            ->setData(['name'=>$text])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['_id'];
            return $newUserId;
        }else{
            return false;
        }
    }

    public static function search($query,$type){
//        $data = self::analyze($type);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:9200/komkeao/'.$type.'/_search')
            ->setData(['q'=>''.$query])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['hits']['hits'];
            foreach ($newUserId as $item) {
                return $item['_source']['name'];
            }
        }else{
            return false;
        }
    }
}