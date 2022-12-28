<table>
    <thead>
        <tr>
            <th>no</th>
            <th>nim</th>
            <th>nama</th>
            <th>jurusan</th>
            <th>tempat_lahir</th>
            <th>tanggal_lahir</th>
            <th>jenis_kelamin</th>
            <th>tanggal_lulus</th>
            <th>tanggal_wisuda</th>
            <th>pin</th>
            <th>nomor_ijazah</th>
            <th>judul_skripsi</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>1990014001</td>
            <td>Nama Lengkap</td>
            <td>1 (isi dengan ID atau kode jurusan/prodi)</td>
            <td>Jombang</td>
            <td>YYYY/MM/DD</td>
            <td>Laki-Laki/Perempuan</td>
            <td>YYYY/MM/DD/</td>
            <td>YYYY/MM/DD/</td>
            <td>2023020866000981</td>
            <td>000130</td>
            <td>Rancangan Bangun Rumah ..... ..... .....</td>
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
