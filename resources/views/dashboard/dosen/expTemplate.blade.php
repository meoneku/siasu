<table>
    <thead>
        <tr>
            <th>no</th>
            <th>niy</th>
            <th>nidn</th>
            <th>nama</th>
            <th>rekening</th>
            <th>email</th>
            <th>jurusan</th>
            <th>tmt</th>
            <th>jabatan</th>
            <th>jafung</th>
            <th>golongan</th>
            <th>pendidikan</th>
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
            <td>UHA.01.0001</td>
            <td>0742112001</td>
            <td>Aldi Taher</td>
            <td>7171171111</td>
            <td>xxxxx@mail.com</td>
            <td>1 (isi dengan ID atau kode jurusan/prodi)</td>
            <td>dd/mmmm/yyyy</td>
            <td>Tenaga Pengajar</td>
            <td>Asisten Ahli</td>
            <td>III/b</td>
            <td>S1/S2/S3</td>
            <td>Dosen Tetap / Dosen Tidak Tetap</td>
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
                <td></td>
                <td><strong>{{ $prodi->id }}</strong></td>
                <td>{{ $prodi->jurusan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
