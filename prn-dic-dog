<?php
include "framework/database/connect.php";
include "framework/functions/default.php";
include "framework/security/default.php";

$OrdNbr 		= $_GET['ORD_NBR'];
$approvFlag		= $_GET['FLAG'];
$docNumber		= $_GET['DOC_DET_NBR'];

if($approvFlag != ''){
	$query="UPDATE PAY.PRN_DIG_DOC_DET SET APV_F=". $approvFlag .", APV_TS=CURRENT_TIMESTAMP, APV_NBR=".$_SESSION['personNBR']." WHERE DOC_DET_NBR=".$docNumber;
	$result=mysql_query($query);
	echo $query;
}

$detailAdd = '';
if ($ExecSec <= 4 || $ExecSec > 4 ) {
    $detailAdd =
        "<div class='listable-btn'>
            <span class='fa fa-plus listable-btn' onclick=" . chr(34) . "
                if(document.getElementById('ORD_NBR').value==-1){
                    parent.parent.document.getElementById('invoiceAdd').style.display='block';
                    parent.parent.document.getElementById('fade').style.display='block';
                    return;
                };
                slideFormIn('prn-dic-doc-detail.php?ORD_DET_NBR=0&ORD_NBR=" . $OrdNbr . "');" . chr(34) . ">
            </span>
        </div>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
	<script type="text/javascript">
		function check(DocNumber,OrderNbr,DocFlag){
			if (DocFlag=='1'){ stt = "No";flag="0";}else{stt="Yes";flag="1";}
			
			window.scrollTo(0,0);
			
			parent.parent.document.getElementById('fade').style.display='block';
			parent.parent.document.getElementById('Approval'+stt).style.display='block';
			
			parent.parent.document.getElementById('Approval'+stt+'Yes').onclick=function () {
				parent.parent.document.getElementById('content').src='prn-dig-doc.php?FLAG='+flag+'&DOC_DET_NBR='+DocNumber+'&ORD_NBR='+OrderNbr;
				parent.parent.document.getElementById('Approval'+stt).style.display='none';
				parent.parent.document.getElementById('fade').style.display='none'; 
			};
		}
	</script>
</head>
<body>

<?php if ($OrdNbr != ''){ ?>
    <form enctype="multipart/form-data" id="updateForm" action="#" method="post" style="width:400px" onSubmit="return checkform();">
        <table id="mainTable">
            <thead>
                <tr>
                    <th class="listable">Deskripsi</th>
                    <th class="listable">Status</th>
                    <th class="listable" style="width: 10%;">
                        <?php echo $detailAdd; ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
				$query = "SELECT 
					TYP.DOC_TYP_DESC, 
					DET.APV_F, 
					DET.DOC_DET_NBR,
                    (CASE WHEN APV_F=1 THEN DATEDIFF(CRT_TS,UPD_TS)+1 ELSE 0 END) AS CNT_DTE
				FROM CMP.PRN_DIG_DOC_DET DET
					LEFT OUTER JOIN CMP.PRN_DIG_DOC_TYP TYP ON DET.DOC_TYP = TYP.DOC_TYP
				WHERE DET.ORD_NBR = '$OrdNbr'";
				$result = mysql_query($query);
				while($row=mysql_fetch_array($result)){
				?>
                    <tr>
                        <td class="listable"><?php echo $row['DOC_TYP_DESC']; ?></td>
                        <td class="listable" style="text-align:center;">
                            <?php if($row['APV_F'] == 1){ ?>
                            <input id= "DOC_TYP" name="DOC_TYP" value="<?php echo $row['DOC_TYP']; ?>" type="hidden" style="width:100px;" />
                            <?php } ?>
							
							<input name="DOC_DET_NBR[]" type="hidden" value="<?php echo $row['DOC_DET_NBR'];?>">
							<input name='APV_F' value="<?php echo $row['DOC_TYP'];?>" id='DOC_DET_F_<?php echo $row['DOC_DET_NBR'];?>' type='checkbox' class='regular-checkbox' onclick="check(<?php echo $row['DOC_DET_NBR'].",".$OrdNbr.",".$row['APV_F'];?>);" <?php if($row['APV_F']=="1"){echo "checked";} ?>/>&nbsp;
							<label for="DOC_DET_F_<?php echo $row['DOC_DET_NBR'];?>"></label>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
<?php } ?>
</body>
</html>

