<table class="table">
    <tbody>
        <tr>
            <th scope="row" style="width: 25%">No Pasien</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->pasien ? @$data->pasien->no_pasien : '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">Nama Pasien</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->pasien ? @$data->pasien->name : '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">No KTP Pasien</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->pasien ? @$data->pasien->no_ktp : '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">No Registrasi</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->no_register ?? '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">Poli</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->poli['name'] ?: '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">Total Pembayaran</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->poli['price'] ? 'Rp ' . number_format(@$data->poli['price'],0,',','.') : '-' }}</td>
        </tr>
        <tr>
            <th scope="row" style="width: 25%">Tanggal Registrasi</th>
            <td style="width: 5%">:</td>
            <td>{{ @$data->created }}</td>
        </tr>
    </tbody>
</table>