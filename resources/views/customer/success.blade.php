<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran Berhasil</title>

<style>

:root{
  --bg:#fefefe;
  --primary:#7ca36a;
  --secondary:#f4d35e;
  --accent:#2ecc71;
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

h1{
  margin-bottom:10px;
}

.success{
  font-size:60px;
}

button{
  margin-top:20px;
  padding:10px 20px;
  background:var(--primary);
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

<div class="success">✅</div>

<h1>Pembayaran Berhasil</h1>

<p>
Terima kasih! Pesanan kamu sedang diproses oleh dapur ☕
</p>

<a href="{{route('')}}">
<button>
Kembali ke Menu
</button>
</a>

</div>

</body>
</html>