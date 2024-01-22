<table>
    <thead>
        <tr>
            <th>no</th>
            <th>nim</th>
            <th>nama</th>
            <th>jurusan</th>
            <th>kegiatan</th>
            <th>va</th>
            <th>nominal</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>2094074001</td>
            <td>Aldi Taher</td>
            <td>S1 Ilmu Ghoib</td>
            <td>1 (ID Kegiatan)</td>
            <td>12345678987654321</td>
            <td>250000</td>
            <td></td>
            <td></td>
            <td><strong>ID/Kode Jurusan</strong></td>
            <td>Jurusan/Prodi</td>
        </tr>
        @foreach ($kegiatan as $k)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>{{ $k->id }}</strong></td>
                <td>{{ $k->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
