
<!DOCTYPE html>
<html>
<head>
    <style>
table {
    font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
    border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
background-color: #dddddd;
        }

       .header {
            background-color: #26a9e0;
            font-weight: bold;
            font-size:25px;
        }
        button {
            width: 5%;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px;
            border: none;
            background: #1c87c9;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            user-focus-pointer: true;
        }
        .grab {
            cursor: grab;
        }
    </style>
</head>
<body>

<button class="button grab"  value="back" onclick="back()">
    BACK
</button>

<h2>Logs Table</h2>


<table>

    <tr class="header">
        <th>Id</th>
        <th>Class</th>
        <th>Action</th>
        <th>Value</th>
        <th>Timestamp</th>
    </tr>
    <?php
        include ("../../includes/Logg.php");
        include ("../../includes/database.php");

        $data= array();
        $logg = new Logg($conn);
        $data = $logg->getAllLogs();
        if( !empty($data) ) {
            foreach($data as $key => $value) {
                echo "<tr>
                    <th>" . $value['id'] . "</th>
                    <th>" . $value['class'] . "</th>
                    <th>" . $value['action'] . "</th>
                    <th>" . $value['value'] . "</th>
                    <th>" . $value['time'] . "</th>
                </tr>";
            }
        }



    ?>
</table>

</body>
<script>
    function back(){
       window.location.href = '../../index.php';
    }
</script>
</html>