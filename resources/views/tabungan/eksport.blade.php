<?php 

    use Illuminate\Support\Carbon;

?>

<table id="data_table" class="table data_table">
    
    <thead class="bg-primary text-white">
    	<tr>
    		<!--
            <th colspan="6" class="text-center">Data Total Tabungan Siswa Bulan {{Carbon::parse(date('M', strtotime($data_tabungan[0]->tgl_transaksi)))->isoFormat('MMMM')}}</th>
            -->
            <th colspan="6" class="text-center">Data Total Tabungan Siswa Kelas {{ $data_tabungan[0]->siswa->kelas->kelas }}</th>
    	</tr>
    	<tr>
    		<th></th>
    	</tr>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
    		@foreach ($data_tabungan as $item)
    			<tr>
    				<td scope="row">{{$loop->iteration}}</td>
    				<td>
                       {{ $item->siswa->nama_siswa }}
    					
    				</td>
    				<td>
    					{{ $item->siswa->kelas->kelas }}                  					
    				</td>
                    <td>
                        {{$item->total_debit}}
                    </td>
                    <td>
                        {{$item->total_kredit}}
                    </td>
                    <td>
                        {{$item->total_debit - $item->total_kredit}}
                    </td>
    			</tr>
    		@endforeach
    </tbody>
</table>