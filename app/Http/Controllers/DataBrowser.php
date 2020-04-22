<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\OdooRecord;
use App\Counter;

class DataBrowser extends Controller
{
    public function index()
    {
        $LastData = OdooRecord::orderBy('InventoryPushCount', 'desc')->first();
        $inventoryItems = OdooRecord::where('InventoryPushCount',intval($LastData->InventoryPushCount))->get();
        $itemCounter = Counter::all();        
        return view ('Inventory')
            ->with('inventoryItems', $inventoryItems )
            ->with('itemCounter', $itemCounter);


      //  return view ('Inventory',['inventoryItems' => $inventoryItems]);
    }

    public function update()
    {       
       return redirect('/show/' . request('index'));        
    }

    public function show($index)
    {
        $inventoryItems = OdooRecord::where('InventoryPushCount',$index)->get();
        $itemCounter = Counter::all();        
        return view ('Inventory')
            ->with('inventoryItems', $inventoryItems )
            ->with('itemCounter', $itemCounter);
    }

}
