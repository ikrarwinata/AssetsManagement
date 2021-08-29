<!doctype html>
<html>

<head>
    <title><?php echo ($Page->title); ?></title>
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .word-table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            padding: 3px 5px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2><?php echo ($Page->title); ?></h2>
        </div>
    </div>
    <hr>
    <div class="col-lg-12 text-center">
        <h3><?php echo ($Page->subtitle[0]); ?></h3>
    </div>
    <?php echo (dayToString() . ", " . date("d") . " " . monthToString() . " " . date("Y")); ?>
    <hr>
    <table class="word-table" style="margin-bottom: 10px">
        <thead>
            <tr>
                <th>
                Master_id
            </th>
                <th>
                Quantity
            </th>
                <th>
                Price
            </th>
                <th>
                Date
            </th>
                <th>
                User_account
            </th>
                <th>
                Description
            </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr>
                    <td><?php echo $value->master_id ?></td>
                    <td class="text-center"><?php echo $value->quantity ?></td>
                    <td class="text-center"><?php echo $value->price ?></td>
                    <td><?php echo $value->date ?></td>
                    <td><?php echo $value->user_account ?></td>
                    <td><?php echo $value->description ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>