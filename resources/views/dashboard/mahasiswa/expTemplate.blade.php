<table>
    <thead>
        <tr>
            <th>no</th>
            <th>nim</th>
            <th>nama</th>
            <th>jurusan</th>
            <th>status</th>
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
            <td>1 (isi dengan ID atau kode jurusan/prodi)</td>
            <td>Aktif</td>
            <td></td>
            <td></td>
            <td><strong>ID/Kode Jurusan</strong></td>
            <td>Jurusan/Prodi</td>
        </tr>
        @foreach ($jurusan as $prodi)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>{{ $prodi->id }}</strong></td>
                <td>{{ $prodi->jurusan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
