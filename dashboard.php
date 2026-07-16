<!doctype html>
<html>
<head>
  <meta charset="utf-8"><title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>body{background:#f6f8fb}.sidebar{width:240px;min-height:100vh;position:fixed;left:0;top:0;padding:20px;background:#0d6efd;color:#fff}.content{margin-left:260px;padding:28px}</style>
</head>
<style>
body {
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
    font-family: "Segoe UI", sans-serif;
}

.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: linear-gradient(180deg, #0d6efd, #084298);
    padding: 20px;
}

.sidebar h4 {
    font-weight: 600;
    text-align: center;
}

.sidebar a {
    color: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    transition: all 0.3s;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.15);
    transform: translateX(5px);
}

.sidebar .logout {
    background: rgba(255,255,255,0.15);
    margin-top: 15px;
}
</style>
<body>
<div class="sidebar">
    <h4 class="text-white mb-4">📌 Navigation</h4>

    <a href="index.php"><i class="bi bi-house"></i> Home</a>
    <a href="dashboard.php"><i class="bi bi-bar-chart"></i> Dashboard</a>
    <a href="students.php"><i class="bi bi-mortarboard"></i> Students</a>
    <a href="attendance.php"><i class="bi bi-calendar-check"></i> Attendance</a>
    <a href="add_student.php"><i class="bi bi-person-plus"></i> Add Student</a>
    <a href="add_attendance.php"><i class="bi bi-pencil-square"></i> Add Attendance</a>
    <a href="search.php"><i class="bi bi-search"></i> Search</a>
    <a href="predict.php"><i class="bi bi-robot"></i> Prediction (AI)</a>

    <hr class="border-light">
    <a class="logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

  <div class="content">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>Dashboard</h3>
      <div><a class="btn btn-outline-secondary" href="students.php">Manage Students</a></div>
    </div>

    <div class="row g-4">
      <div class="col-md-8">
        <div class="card p-3">
          <h6>Attendance Rate (Last 30 days)</h6>
          <canvas id="chart" height="120"></canvas>
          <div id="chartLoading" class="text-center text-muted">Loading chart…</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3">
          <h6>Quick Stats</h6>
          <div id="quickStats">Loading…</div>
        </div>
      </div>
    </div>
  </div>

<script>
async function loadData() {
  const [attRes, stuRes] = await Promise.all([
    fetch('api_attendance.php').then(r=>r.json()),
    fetch('api_students.php').then(r=>r.json())
  ]);
  const map = {}; 
  attRes.forEach(r=>{
    if (!map[r.date]) map[r.date] = {present:0,total:0};
    map[r.date].total++;
    if (r.status === 'Present') map[r.date].present++;
  });
  const labels = Object.keys(map).sort().slice(-30);
  const data = labels.map(d => Math.round((map[d].present/map[d].total)*100));
  document.getElementById('chartLoading').style.display='none';
  const ctx = document.getElementById('chart');
  new Chart(ctx, {
    type: 'line',
    data: { labels, datasets: [{ label: '% Present', data, tension:0.2, fill:true }] },
    options: { scales:{ y:{min:0,max:100} } }
  });

  const totalStudents = stuRes.length;
  const recents = attRes.slice(0,20);
  const presentCount = attRes.filter(a=>a.status==='Present').length;
  const totalRecords = attRes.length;
  document.getElementById('quickStats').innerHTML = `
    <p>Students: <strong>${totalStudents}</strong></p>
    <p>Total records: <strong>${totalRecords}</strong></p>
    <p>Overall % present: <strong>${ totalRecords ? Math.round(presentCount/totalRecords*100) : 0 }%</strong></p>
    <p>Recent records (top 20) shown in Students / Attendance pages</p>
  `;
}

loadData();
</script>
</body>
</html>