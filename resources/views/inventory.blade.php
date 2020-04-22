<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta
        http-equiv="X-UA-Compatible"
        content="ie-edge">
    <title>Inventory</title>
</head>
<style>
    *{box-sizing: border-box;}
    table{border-collapse:collapse;}
    td,th{padding:5px 15px;text-align:center; background: aliceblue;}
    table,th,td{border:1px solid #000;}
</style>
<body>
<h1>Data Record</h1> <div class="table-responsive">
    <button onclick="window.location.href = '../create';">Update Record</button>
    <h2>Latest Update: {{ $inventoryItems[0] -> updated_at }}</h2>


    <form action="/show" method="POST">
        @csrf
        <label for="Menu">Select Record:</label>
        <select id="Menu" name="index">
            @foreach($itemCounter as $list)
                <option value="{{ $list-> PushCounter }}">{{ $list->ClonedUpdate}}</option>
            @endforeach
        </select>
        <input type="submit" value="Submit">
    </form>

        <table>
        <thead>
        <tr>
            <th><strong>ID</strong></th>
            <th><strong>Product Code</strong></th>
            <th><strong>Description</strong></th>
            <th><strong>Quantity</strong></th>
            <th><strong>InventoryPushCount</strong></th>
            <th><strong>Update At</strong></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($inventoryItems as $inventoryItem)
            <tr>
                <td>{{ $inventoryItem -> id }}</td>
                <td>{{ $inventoryItem -> default_code }}</td>
                <td>{{ $inventoryItem -> name }}</td>
                <td>{{ $inventoryItem -> qty_available }}</td>
                <td>{{ $inventoryItem -> InventoryPushCount }}</td>
                <td>{{ $inventoryItem -> updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
