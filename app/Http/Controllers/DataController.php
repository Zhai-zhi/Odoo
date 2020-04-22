<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Ripcord\Ripcord;
use DB;
use App\OdooRecord;
use App\Counter;

class DataController extends Controller
{

    private $pushCount = 1;
    private $currentPush;
    public function store()
    {

        $url = 'https://demo-snoe.odoo.com';
        $db = 'demo-snoe';
        $username = 'umwency@gmail.com';
        $password = '123456';

        $common = Ripcord::client("$url/xmlrpc/2/common");
        $uid = $common->authenticate($db, $username, $password, array());
        $models = Ripcord::client("$url/xmlrpc/2/object");

        $inventoryCount = $models->execute_kw($db, $uid, $password,
            'product.template', 'search_count',array(array()));

        $ListsItems = $models->execute_kw($db, $uid, $password,
            'product.template', 'search',array(array()));
        $storeItemsDB = $models->execute_kw($db, $uid, $password,
            'product.template', 'read',
            array($ListsItems),
            array('fields'=>array('default_code','name','standard_price','qty_available')));

        $productcollection = collect($storeItemsDB);
        $dbCheck = new OdooRecord();
        $pushCount = new Counter();
  
        if($dbCheck->get()->isEmpty()) {
            
            //$pushCount->PushCounter =  0;
            //$pushCount->save();

            $productcollection->transform(function ($item, $key) {
                unset($item['id']);
                $item['InventoryPushCount'] = 0;//$this->pushCount;
                return $item;
            });
            OdooRecord::Insert($productcollection->all());
            $pushCount->PushCounter =  0;
            $pushCount->save();
            }
        else 
            {
                $LastData = OdooRecord::orderBy('InventoryPushCount', 'desc')->first();
                $this->currentPush = intval($LastData->InventoryPushCount) + $this->pushCount;
                $productcollection->transform(function ($item, $key) {
                    unset($item['id']);
                    $item['InventoryPushCount'] =  $this->currentPush;
                    return $item;
                });
               OdooRecord::Insert($productcollection->all());
               $pushCount->PushCounter =  $this->currentPush;
               $pushCount->save();
           }
       return redirect('/');
    }

}
