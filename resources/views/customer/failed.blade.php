<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran Gagal</title>

<style>

:root{
  --bg:#fefefe;
  --accent:#ee6c4d;
  --dark:#111;
  --shadow:6px 6px 0 var(--dark);
}

body{
  margin:0;
  background:var(--bg);
  font-family:Arial;
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}

.card{
  background:white;
  border:3px solid var(--dark);
  box-shadow:var(--shadow);
  padding:40px;
  text-align:center;
  max-width:400px;
}

.fail{
  font-size:60px;
}

button{
  margin-top:20px;
  padding:10px 20px;
  background:#ee6c4d;
  border:3px solid var(--dark);
  box-shadow:var(--shadow);
  color:white;
  font-weight:bold;
  cursor:pointer;
}

</style>
</head>

<body>

<div class="card">

<div class="fail">❌</div>

<h1>Pembayaran Gagal</h1>

<p>
Pembayaran tidak berhasil. Silakan coba lagi.
</p>

<a href="javascript:history.back()">
<button>
Coba Lagi
</button>
</a>

</div>

</body>
</html>