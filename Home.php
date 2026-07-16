<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AI Attendance — Landing</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body{
      font-family:'Poppins',sans-serif;
      height:100vh;
      margin:0;
      background: linear-gradient(
        120deg,
        rgba(7, 82, 125, 0.85),
        rgba(0,118,255,0.6)
      ),
      url('https://images.unsplash.com/photo-1535905748047-14f55a56f3ff')
      center/cover no-repeat;
    }

    .glass{
      max-width:980px;
      padding:40px;
      border-radius:16px;
      background:rgba(255,255,255,0.06);
      backdrop-filter: blur(8px);
      box-shadow: 0 10px 30px rgba(2,6,23,0.5);
      color:#fff;
      margin:auto;
    }

    .brand{
      font-weight:700;
      font-size:28px;
      letter-spacing:0.3px;
    }

    .lead{opacity:0.95}
    .feature{opacity:0.95}

    .btn-primary{
      background:linear-gradient(90deg,#00c6ff,#0072ff);
      border:none;
    }

    /* ⭐ 学校 Logo 样式 */
    .school-logo{
      max-width:220px;
      width:100%;
      height:auto;
      margin:auto;
      display:block;
    }

    footer{
      position:fixed;
      bottom:12px;
      width:100%;
      text-align:center;
      color:rgba(255,255,255,0.6);
    }
  </style>
</head>

<body>
  <div class="d-flex align-items-center justify-content-center" style="height:100vh">
    <div class="glass text-center">
      <div class="row align-items-center">

        <!-- 左边文字 -->
        <div class="col-md-7 text-start">
          <div class="brand">AI-Based Student Attendance System</div>

          <p class="lead mt-3">
            Smart attendance management with machine learning prediction —
            designed for final-year projects and real admin use.
          </p>

          <ul class="list-unstyled feature">
            <li>• Student & attendance management</li>
            <li>• Dashboard with charts and history</li>
            <li>• Optional ML prediction via Python (Logistic Regression)</li>
          </ul>

          <div class="mt-4">
            <a href="login.php" class="btn btn-primary btn-lg me-2">
              Get Started
            </a>
            <a href="index.php" class="btn btn-outline-light btn-lg">
              Quick Add (Guest)
            </a>
          </div>
        </div>

        <!-- 右边学校 Logo -->
        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center">
          <img
            src="assets/images/image_schoollogo.jpg"
            alt="School Logo"
            class="school-logo"
          >
        </div>

      </div>
    </div>
  </div>

  <footer>
    © <?php echo date('Y'); ?> AI Attendance — University Level Prototype
  </footer>
</body>
</html>