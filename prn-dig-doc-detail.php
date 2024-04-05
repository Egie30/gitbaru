<?php
    include "framework/database/connect.php";

    $Security = getSecurity($_SESSION['userID'],"AddressBook");
    $upperSecurity = getSecurity($_SESSION['userID'],"Executive");
    $UpperSec = getSecurity($_SESSION['userID'],"Accounting");
    $OrdNbr = $_GET['ORD_NBR'];
    $DocDetNbr = $_GET['DOC_DET_NBR'];
    $DocTyp = isset($_POST['DOC_TYP']) ? $_POST['DOC_TYP'] : ''; 
    $addNew = false;


    if ($DocDetNbr == -1) {
        $addNew = true;
        $query = "SELECT COALESCE(MAX(DOC_DET_NBR), 0) + 1 AS NEW_NBR FROM CMP.PRN_DIG_DOC_DET";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $DocDetNbr = $row['NEW_NBR'];
        $query_insert = "INSERT INTO CMP.PRN_DIG_DOC_DET (DOC_DET_NBR) VALUES (" . $DocDetNbr . ")";
        $result_insert = mysql_query($query_insert);
        $create = "CRT_TS=CURRENT_TIMESTAMP,CRT_NBR=" . $_SESSION['personNBR'] . ",";
        
        echo $query_insert;
    }
            if ($addNew) {
                $notif_success = "Data tersimpan";
            }

?>

<html lang="en">
    <head>
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
        <script>parent.Pace.restart();</script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
        <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="framework/datepicker/css/calendar-eightysix-v1.1-default.css" media="screen" />
        <script type="text/javascript" src="framework/validation/mootools-1.2.3.js"></script>
        <script type="text/javascript" src="framework/mootools/mootools-latest.min.js"></script>
        <script type="text/javascript" src="framework/mootools/mootools-latest-more.js"></script>
        <script type="text/javascript" src="framework/datepicker/js/calendar-eightysix-v1.1.min.js"></script>
        <script type="text/javascript" src="framework/functions/default.js"></script>
        <script type="text/javascript">jQuery.noConflict();</script>
        <link rel="stylesheet" href="framework/combobox/chosen.css">
    </head>

    <body>
        <span class='fa fa-times toolbar' style='margin-left:10px' onclick="slideFormOut();"></span>
        <br><br>
        <form enctype="multipart/form-data" action="#" method="post" style="width:400px" >
            <input name="DOC_DET_NBR" id="DOC_DET_NBR" value="<?php echo $DocDetNbr ?>" type="hidden"/>
                <tr>
                    <label for="DOC_TYP">Syarat</label>&emsp;
                    <td>
                        <select name="DOC_TYP" id="DOC_TYP" class="chosen-select" style="width: 110px;">
                            <?php
                            $query = "SELECT DOC_TYP, DOC_TYP_DESC FROM PRN_DIG_DOC_TYP";
                            genCombo($query, "DOC_TYP", "DOC_TYP_DESC", $_POST["DOC_TYP"], "Pilih Syarat");
                            ?>
                        </select>
                    </td>
                </tr>
                <br><br>
                <div>
                        <?php
                            if (@$_GET['readonly'] != 1) { ?>
                                <input class="process" type="submit" value="<?php echo ($addNew) ? 'Tambah' : 'Simpan' ?>"/>
                                <?php
                            } ?>
                </div>
        </form>
    </body>
</html>
