<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>替代语法</title>
</head>

<body>
    <table width=100 border=1>
        <?php for ($i=1;$i<=9;$i++) {?>
        <tr>
            <?php for ($j=1;$j<=$i;$j++) {?>
            <td><?php echo $i .'*' .$j .'='. $i*$j;?>
            </td>
            <?php }?>
        </tr>
        <?php }?>
    </table>
    <hr />
    <table width=100 border=1>
        <?php for ($i=1;$i<=9;$i++):?>
        <tr>
            <?php for ($j=1;$j<=$i;$j++):?>
            <td><?php echo $i .'*' .$j .'='. $i*$j;?>
            </td>
            <?php endfor;?>
        </tr>
        <?php endfor;?>
    </table>
</body>

</html>