
```html name=index.html
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WAC10 Grade Viewer</title>
  <style>
    body {
      margin: 0;
      font-family: Tahoma, sans-serif;
      background: linear-gradient(135deg, #fff5f0, #f1f8ff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      width: 90%;
      max-width: 700px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.12);
      padding: 30px 25px;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
      color: #333;
      font-size: 28px;
    }

    .menu {
      display: grid;
      gap: 16px;
      margin-top: 20px;
    }

    .btn {
      display: inline-block;
      text-decoration: none;
      color: white;
      background: linear-gradient(135deg, #ff7a4d, #ff5a36);
      border-radius: 12px;
      padding: 16px 20px;
      font-size: 18px;
      font-weight: bold;
      transition: 0.2s ease;
      box-shadow: 0 6px 14px rgba(255, 122, 77, 0.3);
    }

    .btn:hover {
      transform: translateY(-2px);
      opacity: 0.95;
    }

    .btn.secondary {
      background: linear-gradient(135deg, #5aa7ff, #3d8bfd);
      box-shadow: 0 6px 14px rgba(61, 139, 253, 0.3);
    }

    .btn.success {
      background: linear-gradient(135deg, #46b775, #2e9d65);
      box-shadow: 0 6px 14px rgba(46, 157, 101, 0.3);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>ระบบแสดงผลการเรียน</h1>

    <div class="menu">
      <a class="btn" href="input.php">เข้าสู่ระบบแสดงผลการเรียน</a>
      <a class="btn secondary" href="gradeviewer.php">ไปที่หน้าแสดงผล (แบบตรง)</a>
      <a class="btn success" href="wac10xml.xml">ดูข้อมูลนักเรียน XML</a>
      <a class="btn secondary" href="subjectxml.xml">ดูข้อมูลรายวิชา XML</a>
    </div>
  </div>
</body>
</html>
```
