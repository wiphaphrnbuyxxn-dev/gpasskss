<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>WAC10 Grade Viewer</title>
    <style type="text/css">
		table {
		border-collapse: separate;
		border-spacing: 10px 5px;
		font-family: Tahoma;
		font-size: 10pt;
		border: 1px solid black;
		}
		th {
			background-color: #ff794d;
			color: white;
		}
		.stylePink
		{
			background-color: #FFCCFF;
			height: 30;
		}
    </style>
    <script language="javascript" type="text/javascript">
    function validateForm()
       {
        var p=document.forms["gradeForm"]["ID"].value
        var d=document.forms["gradeForm"]["BDate"].value
        if (p==null || p=="" || d==null || d=="")
          {
             alert("กรุณากรอกข้อมูลให้ครบถ้วน");
             return false;
          }
       }
    </script>
</head>
<body>
  <div align=center>
  <FORM name="gradeForm" METHOD=POST ACTION="gradeviewer.php" onsubmit="return validateForm()">
   <table>
   <tr> <th colspan="3" align="center">ระบบแสดงผลการเรียน</th></tr>
   <tr> <td align="right">เลขประจำตัวนักเรียน</td><td align="center"> :</td><td>
        <INPUT TYPE="text" NAME="ID" size="10"></td> </tr>
   <tr> <td align="right">วันเกิด วว/ดด/ปปปป</td><td align="center"> :</td><td>
        <INPUT TYPE="text" NAME="BDate" size="10"></td> </tr>
   <tr class="stylePink"> <td align="right" colspan="3">
        <INPUT NAME="mSend" TYPE="submit" value="แสดงผลการเรียน" />
        <INPUT NAME="mReset" TYPE="reset" value="ล้างข้อมูล" /></td></tr>
  </table>
  </FORM>
  </div>
</body>
</html>
