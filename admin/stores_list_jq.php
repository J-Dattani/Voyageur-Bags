<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables CSS and JS library -->
<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
<script type="text/javascript" src="datatables/datatables.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<table id="userDataList" class="display" style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>Location</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function(){
    $('#userDataList').dataTable({
            "processing": true,
            "ajax": "stores_fetchData.php",
            "columns": [
                {data: 'id'},
                {data: 'image'},
                {data:'location'}
                
            ]
        });
});
</script>
  

</body>
</html>
