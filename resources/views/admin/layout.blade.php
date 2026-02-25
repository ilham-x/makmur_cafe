<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') - Coffee Makmur</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  --bg:#fefefe;
  --primary:#7ca36a;
  --secondary:#f4d35e;
  --accent:#ee6c4d;
  --dark:#111;
  --light:#fff;
  --shadow:6px 6px 0 var(--dark);
}

*{box-sizing:border-box;font-family:Arial, Helvetica, sans-serif;}
body{margin:0;background:var(--bg);}
.app{display:flex;height:100vh;}

.sidebar{
  width:240px;
  background:var(--secondary);
  border-right:4px solid var(--dark);
  padding:26px 20px;
}

.sidebar h2{margin:0 0 28px;font-weight:900;}

.menu a{
  display:block;
  padding:14px;
  margin-bottom:14px;
  background:var(--light);
  border:3px solid var(--dark);
  box-shadow:var(--shadow);
  text-decoration:none;
  color:var(--dark);
  font-weight:900;
}

.menu a.active{
  background:var(--primary);
  color:white;
}

.main{
  flex:1;
  padding:26px;
  overflow:auto;
}

.card{
  background:var(--light);
  border:3px solid var(--dark);
  box-shadow:var(--shadow);
  padding:20px;
  margin-bottom:20px;
}

button{
  background:var(--primary);
  color:white;
  border:3px solid var(--dark);
  padding:8px 14px;
  font-weight:900;
  cursor:pointer;
  box-shadow:var(--shadow);
}

table{
  width:100%;
  border-collapse:collapse;
}

table th, table td{
  border:3px solid var(--dark);
  padding:10px;
  text-align:left;
}

table th{
  background:var(--secondary);
}
input, textarea {
    width:100%;
    padding:8px;
    border:3px solid var(--dark);
    box-shadow: var(--shadow);
}

.card div:hover {
    transform: translate(-3px,-3px);
    box-shadow:6px 6px 0px #000;
    transition:0.2s;
}

</style>
</head>

<body>
<div class="app">

<aside class="sidebar">
  <h2>☕ COFFEE MAKMUR</h2>
  <nav class="menu">
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
       Dashboard
    </a>

    <a href="{{ route('admin.produk.index') }}"
       class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
       Produk
    </a>

    <a href="{{ route('admin.meja.index') }}"
       class="{{ request()->routeIs('admin.meja.*') ? 'active' : '' }}">
       Meja
    </a>

    <a href="{{ route('admin.transaksi.index') }}"
       class="{{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
       Transaksi
    </a>

    <a href="{{ route('admin.kasir.index') }}"
       class="{{ request()->routeIs('admin.kasir.*') ? 'active' : '' }}">
       Kasir
    </a>
  </nav>
</aside>

<main class="main">
    <h2>@yield('title')</h2>
    @yield('content')
</main>

</div>

@yield('script')

</body>
</html>