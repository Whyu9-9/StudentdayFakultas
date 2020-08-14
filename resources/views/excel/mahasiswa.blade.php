<?php
//     protected $fillable = [
    //     'nim', 'password', 'nama', 'nama_panggilan', 'program_studi', 'jenis_kelamin', 
    //     'gol_darah', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'alamat_sekarang', 
    //     'no_telepon', 'no_hp', 'email', 'asal_sekolah', 'hobi', 'cita-cita', 'idola', 
    //     'moto', 'jumlah_saudara', 'nama_ayah', 'nama_ibu', 'vegetarian', 'penyakit_khusus', 
    //     'mahasiswa_baru', 'angkatan', 'ganti_pass'
    // ];
?>
<table>
	<thead>
		<tr>
			<th>No</th>
		    <th>NIM</th>
		    <th>Nama Lengkap</th>
		    <th>Nama Panggilan</th>
		    <th>Program Studi</th>
		    <th>Jenis Kelamin</th>
		    <th>Gol Darah</th>
		    <th>Tempat Lahir</th>
		    <th>Tanggal Lahir</th>
		    <th>Alamat Asal</th>
		    <th>Alamat Sekarang</th>
		    <th>No Telp',
		    <th>No HP</th>
		    <th>Email</th>
		    <th>Asal Sekolah</th>
		    <th>Hobi</th>
		    <th>Cita-cita</th>
		    <th>Idola</th>
		    <th>Moto</th>
		    <th>Jumlah Saudara</th>
		   	<th>Nama Ayah</th>
		    <th>Nama Ibu</th>
		    <th>Penyakit Khusus</th>
		    <th>Mahasiswa Baru</th>
		    <th>Angkatan</th>
		    <th>Prestasi</th>
		    <th>Pengalaman Organisasi</th>
		    <th>Terakhir Login</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $i => $row)
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $row->nim }}</td>
			<td>{{ $row->nama }}</td>
			<td>{{ $row->nama_panggilan }}</td>
			<td>
			@if(isset($row->prodi))
				{{ $row->prodi->nama }}
			@endif
			</td>
			<td>
			@if(isset($row->kelamin))
				{{ $row->kelamin->nama }}
			@endif
			</td>
			<td>
			@if(isset($row->goldarah))
				{{ $row->goldarah->nama }}
			@endif
			</td>
			<td>{{ $row->tempat_lahir }}</td>
			<td>{{ $row->tanggal_lahir }}</td>
			<td>{{ $row->alamat }}</td>
			<td>{{ $row->alamat_sekarang }}</td>
			<td>{{ $row->no_telepon }}</td>
			<td>{{ $row->no_hp }}</td>
			<td>{{ $row->email }}</td>
			<td>{{ $row->asal_sekolah }}</td>
			<td>{{ $row->hobi }}</td>
			<td>{{ $row->cita_cita }}</td>
			<td>{{ $row->idola }}</td>
			<td>{{ $row->moto }}</td>
			<td>{{ $row->jumlah_saudara }}</td>
			<td>{{ $row->nama_ayah }}</td>
			<td>{{ $row->nama_ibu }}</td>
			<td>{{ $row->penyakit_khusus }}</td>
			<td>
				@if($row->mahasiswa_baru)
					Ya
				@else
					Tidak
				@endif
			</td>
			<td>
				@if(isset($row->mhsangkatan))
				{{ $row->mhsangkatan->tahun }}
				@else
					Tidak diketahui
				@endif
			</td>
			<td>
				@if(count($row->prestasi) > 0)
					{{$row -> $prestasi;}}
				@else
					Tidak Ada
				@endif
			</td>
			<td>
				@if($row->minat_bakat!= NULL)
				{{ $row->minat_bakat }}
				@else
					Tidak diketahui
				@endif
			</td>
			<td>
				@if(count($row->organisasi) > 0)
					{{$row -> $organisasi;}}
				@else
					Tidak Ada
				@endif
			</td>
			<td>
				@if(count($row->logs) > 0)
					{{ $row->logs[0]->created_at->format('d-m-Y') }}
				@else
					Tidak Ada
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>