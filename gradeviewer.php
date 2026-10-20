<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>WAC10 Grade Viewer</title>
    <style type="text/css">
		table {
		border-collapse: separate;
		border-spacing: 5px 2px;
		font-family: Tahoma;
		font-size: 10pt;
		border: 1px solid black;
		}
		tr:nth-child(even){background-color: #E0E0E0}
		th {
			background-color: #ff794d;
			color: white;
		}
		table#t01 {
		border-collapse: separate;
		border-spacing: 5px 2px;
		width: 100%;
		background-color: #FBD4B4;
		font-family: Tahoma;
		font-size: 10pt;
		border: 0px;
		}
		table#t01 tr:nth-child(even) {
			background-color: white;
		}
        .styleOrange
        {
            background-color: #FBD4B4;
        }
        .styleSkyBlue
        {
            background-color: #B9DCFF;
        }
    </style>
</head>
<body>
<div align=center>
<?php
  $NotFound = true;
  foreach($_POST as $Arrs => $value) {  $p[$Arrs] = $value; } 
  if(file_exists('wac10xml.xml')) {
    $xml = simplexml_load_file('wac10xml.xml');
    if(file_exists('subjectxml.xml'))
       $subxml = simplexml_load_file('subjectxml.xml');
	else exit('Failed to open subjectxml.xml.');
	foreach($xml->children() as $Student)
      {
        if($Student->Psn->Co == $p['ID'] and $Student->Psn->BD == $p['BDate'])
		  {
			echo "  <Table>";
			echo "     <tr><td><A HREF=\"input.php\"><< กลับ</A></td><td colspan=\"3\" align=\"right\"><b>ระบบแสดงผลการเรียน</b></td></tr>";
	  	    echo "     <tr><th colspan=\"4\">เลขประจำตัวนักเรียน: " . $Student->Psn->Co . " ชื่อ: " . $Student->Psn->Na . "</th></tr>";
	  	    echo "     <tr><th colspan=\"4\">ระดับชั้น: " . $Student->Psn->CR  . "</th></tr>";
			echo "     <tr><th colspan=\"4\">";
			echo "  <Table id=\"t01\" align=\"right\">";
			echo "     <tr>";
	  	    echo "       <td></td>";
	  	    echo "       <td align=\"center\">ไทย</td>";
	  	    echo "       <td align=\"center\">คณิต</td>";
	  	    echo "       <td align=\"center\">วิทย์</td>";
	  	    echo "       <td align=\"center\">สังคม</td>";
	  	    echo "       <td align=\"center\">สุขศึกษา</td>";
	  	    echo "       <td align=\"center\">ศิลปะ</td>";
	  	    echo "       <td align=\"center\">การงานฯ</td>";
	  	    echo "       <td align=\"center\">ภาษาฯ</td>";
	  	    echo "       <td align=\"center\">รวม</td>";
	  	    echo "     </tr>";
	  	    echo "     <tr>";
	  	    echo "       <td align=\"center\" class=\"styleOrange\">ผลการเรียนเฉลี่ยสะสม</td>";
	  	    echo "       <td align=\"center\">" . $Student->Psn->Th . "</td>";
	  	    echo "       <td align=\"center\">" . $Student->Psn->Ma . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->Sc . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->So . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->He . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->Ar . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->Jo . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->En . "</td>";
	   	    echo "       <td align=\"center\">" . $Student->Psn->GP . "</td>";
	   	    echo "     </tr>";
			echo "  </Table>";
			echo "     </tr>";
		    foreach($Student->Trs->children() as $Transcript)
	    	  {
	      	    echo "     <tr>";
	      	    echo "       <th colspan=\"4\">ปีการศึกษา: " . $Transcript->Se->Yr .  "&nbsp;&nbsp;" . $Transcript->Se->Tm ;
	      	    echo "&nbsp;&nbsp;&nbsp;ผลการเรียนเฉลี่ย: " . $Transcript->Se->GA . "</th>";
	  	        echo "     </tr>";

				echo "     <tr>";
		  	    echo "       <td align=\"center\" class=\"styleSkyBlue\">รหัสวิชา</td>";
		  	    echo "       <td align=\"center\" class=\"styleSkyBlue\">ชื่อวิชา</td>";
	            if($Transcript->Se->Tm == "")
					echo "       <td align=\"center\" class=\"styleSkyBlue\">ชั่วโมง</td>";
				else
			  	    echo "       <td align=\"center\" class=\"styleSkyBlue\">หน่วยกิต</td>";
		  	    echo "       <td align=\"center\" class=\"styleSkyBlue\">เกรด</td>";
			    echo "     </tr>";
				foreach($Transcript->Ss->children() as $Subjects)
			      {
					$TrID = (string)$Subjects->C;
					foreach($subxml->children() as $SubMaster)
				      {
						$SubID = (string)$SubMaster->I;
						if($SubID == $TrID)
						  {
							echo "     <tr>";
							echo "       <td align=\"left\">" . $SubMaster->C . "</td>";
				            echo "       <td align=\"left\">" . $SubMaster->N . "</td>";
				            echo "       <td align=\"center\">" . $SubMaster->R . "</td>";
				            echo "       <td align=\"center\">" . $Subjects->G . "</td>";
			  	            echo "     </tr>";
						  }
					  }
	  		      }
			  }
			$NotFound = false;
		  }
  	  }
	if($NotFound)
	  {
		echo "  <Table>";
		echo "     <tr><th>ไม่พบข้อมูลดังกล่าวกรุณาป้อนข้อมูลใหม่</th></tr>";
		echo "<tr><td><A HREF=\"input.php\">กลับ</A></td></tr>";
		echo "  </Table>";
	  }
	else
	  {
		echo "<tr><td colspan=\"4\"><A HREF=\"input.php\"><< กลับ</A></td></tr>";
		echo "</Table>\n";
	  }
  } else {
    exit('Failed to open wac10xml.xml.');
  }
?>
</div>
</body>
</html>
