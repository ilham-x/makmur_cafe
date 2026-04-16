<h2>Struk Coffee Makmur</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>Nama</th>
        <th>Qty</th>
        <th>Harga</th>
    </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $item['nama'] }}</td>
        <td>{{ $item['qty'] }}</td>
        <td>{{ $item['harga'] }}</td>
    </tr>
    @endforeach
</table>