<!DOCTYPE html>
<html lang="en">
<body>
    <table>
        <thead>
            <tr>
                <th>No Pasien</th>
                <th>Nama Pasien</th>
                <th>No KTP Pasien</th>
                <th>No Registrasi</th>
                <th>Poli</th>
                <th>Total Pembayaran</th>
                <th>Pay Status</th>
                <th>Created At</th>
                <th>Payed At</th>
                <th>Canceled At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
                @php
                    $poli = @listPoli()[$data->poli_id] ?: null;
                @endphp
                <tr>
                    <td>{{ @$data->pasien ? @$data->pasien->no_pasien : null }}</td>
                    <td>{{ @$data->pasien ? @$data->pasien->name : null }}</td>
                    <td>{{ @$data->pasien ? @$data->pasien->no_ktp : null }}</td>
                    <td>{{ @$data->no_register ?? null }}</td>
                    <td>{{ @$poli['name'] ?: '-' }}</td>
                    <td>{{ @$poli['price'] ? 'Rp ' . number_format(@$poli['price'],0,',','.') : null }}</td>
                    <td>{{ @$data->pay ? 'Yes' : 'No' }}</td>
                    <td>{{ @$data->created_at ? date_format($data->created_at, "Y-m-d H:i:s") : null }}</td>
                    <td>{{ @$data->pay ? 
                            @$data->updated_at ? date_format($data->updated_at, "Y-m-d H:i:s") : null
                        : null}}
                    </td>
                    <td>{{ @$data->deleted_at ? date_format($data->deleted_at, "Y-m-d H:i:s") : null }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>