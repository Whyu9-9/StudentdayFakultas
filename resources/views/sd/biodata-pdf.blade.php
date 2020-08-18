<!DOCTYPE html>
<html>
	<head>
		<title>Form Verifikasi</title>
		<style type="text/css">
			@page { 
				margin: 1cm 3cm 2cm 3cm; 
			}

			#cutting{
				position:fixed;
				padding:10px;
				margin: 0.5cm 0.5cm -0.5cm 0.5cm;
				border:1.5px dashed #000000;
			}
			
			#outtable{
				position:fixed;
				padding:0;
				margin: 1cm 1cm 0.5cm 1cm;
				border:5px solid #000000;
			}
			#watermark { 
				position: fixed; bottom: 100px; left: 5px; right: 5px; width: 550px; height: 550px; opacity: .1; 
			}
			
			body {
				margin-top:0;
				padding:0px;
			}
			
			table.tabel1{
				width : 100%;
				font-family:  "Times New Roman", Times, serif;
				text-align: center;
				color:#000000;
			}
			table.tabel1 td{
				font-size: 18px;
				padding-left: 10px;
				font-style:normal; 
				font-weight:bold
			}
			
			table.tabel2{
				border-collapse: collapse;
				width : 100%;
				font-family: "Times New Roman", Times, serif;
				color:#000000;
				border: 2px solid black;
				
			}
			table.tabel2 th{
				border: 1px solid black;

			}table.tabel2 td{
				padding-left: 5px;
				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<table class="tabel1">
			<tr>
				<td rowspan="6" style='width: 5%;'><img src="/img/UNUD.png" alt="" height=100 width=100></td>
				<td style='width: 90%;'>&nbsp;</td>
				<td rowspan="6" style='width: 5%;'><img src="/img/TEKNIK_1.png" alt="" height=100 width=100></td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td style='text-align: center; font-size:20px;'>STUDENT DAY 2020</td>
			</tr>
			<tr>
				<td style='text-align: center; font-size:14px;'>FAKULTAS TEKNIK UNIVERSITAS UDAYANA</td>
			</tr>
			<tr>
				{{-- <td style='text-align: center; font-size:10px;'>Sekretariat Bersama : Kampus Fakultas Teknik Jl. PB Sudirman</td> --}}
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="3" style='width: 100%; font-size: 1px; border-bottom: 4px solid #000000;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3", style='width: 100%; font-size: 1px; border-top: 2px solid #000000;'>&nbsp;</td>
			</tr>
		</table>
		<table class="tabel2">
			<tr>
				<td colspan="7" style='text-align: center; font-size: 20px; font-weight:bold; border: 2px solid black; text-transform: uppercase;'>BIODATA MAHASISWA 
					{{ $data->prodi }}
				</td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->nama }}
				</td>
				
			</tr>
			<tr>
				<td>Nama Panggilan</td>
				<td colspan="2" style='text-transform: uppercase;'>
					{{ $data->nama_panggilan }}
				</td>
				<td colspan="2" style='text-align: center;'>
					<div
						@if($data->jenis_kelamin == 2)
							style ='text-decoration: line-through;'
						@endif>
						Laki-laki
					</div>
				</td>
				<td colspan="2" style='text-align: center;'>
					<div
						@if($data->jenis_kelamin == 1)
							style ='text-decoration: line-through;'
						@endif>
						Perempuan
					</div>
				</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->nim }}
				</td>
			</tr>
			<tr>
				<td>TTL</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->tempat_lahir }}, {{ date('d F Y', strtotime($data->tanggal_lahir)) }}
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->agama_ }}
  				</td>
			</tr>
			<tr>
				<td rowspan="2" style='vertical-align: top;'>Alamat</td>
				<td colspan="6" style='text-transform: uppercase;'>Asal : {{ $data->alamat }}</td>
			</tr>
			<tr>
				<td colspan="6" style='text-transform: uppercase;'>Sekarang : {{ $data->alamat_sekarang }}</td>
			</tr>
			<tr>
				<td>No. Tlp</td>
				<td colspan="2">
					@if (isset($data->no_telepon))
						{{ $data->no_telepon}}
					@else
					-
					@endif
				</td>
				<td colspan="4">HP. 
					@if (isset($data->no_hp))
						{{ $data->no_hp}}
					@else
					-
					@endif
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td colspan="6">
					{{ $data->email }}
				</td>
			</tr>
			<tr>
				<td>Hobi</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->hobi }}
				</td>
			</tr>
			<tr>
				<td>Asal Sekolah</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->asal_sekolah}}
				</td>
			</tr>
			<tr>
				<td>Cita-cita</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->cita_cita }}
				</td>
			</tr>
			<tr>
				<td>Tokoh Idola</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->idola }}
				</td>
			</tr>
			<tr>
				<td>Jumlah Saudara</td>
				<td style='text-transform: uppercase;'>
					{{ $data->jumlah_saudara}}
				</td>
				<td style='text-align: center; padding: 0px'>Golongan Darah</td>
				<td style='text-align: center; padding: 0px'>
					<div @if($data->gol_darah != 4) style ='text-decoration: line-through;' @endif> O </div>
				</td>
				<td style='text-align: center; padding: 0px'>
					<div @if($data->gol_darah != 1) style ='text-decoration: line-through;' @endif> A </div>
				</td>
				<td style='text-align: center; padding: 0px'>
					<div @if($data->gol_darah != 2) style ='text-decoration: line-through;' @endif> B </div>
				</td>
				<td style='text-align: center; padding: 0px'>
					<div @if($data->gol_darah != 3) style ='text-decoration: line-through;' @endif> AB </div>
				</td>
			</tr>
			<tr>
				<td>Nama Ayah</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->nama_ayah }}
				</td>
			</tr>
			<tr>
				<td>Nama Ibu</td>
				<td colspan="6" style='text-transform: uppercase;'>
					{{ $data->nama_ibu }}
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top;'>Pengalaman Berorganisasi</td>
				<td colspan="6" style='text-transform: uppercase;vertical-align: top;'>
					@if (count($organisasis))
						<?php $first = true ?>
						@foreach ($organisasis as $organisasi)
							@if ($first)
								{{ $organisasi->nama }}
								<?php $first = false ?>
							@else
								{{ ", ".$organisasi->nama }}
							@endif
						@endforeach
					@else
						Tidak Ada
					@endif
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top;'>Prestasi yang Paling Menonjol</td>
				<td colspan="6" style='text-transform: uppercase; vertical-align: top;'>
					@if (count($prestasis))
						<?php $first = true ?>
						@foreach ($prestasis as $prestasi)
							@if ($first)
								{{ $prestasi->nama }}
								<?php $first = false ?>
							@else
								{{ ", ".$prestasi->nama }}
							@endif
						@endforeach
					@else
						Tidak Ada
					@endif
				</td>
			</tr>
			<tr>
				<td style='vertical-align: top; '>Alasan Kuliah di 
					{{ $data->prodi }}
				</td>
				<td colspan="6" style='text-transform: uppercase; vertical-align: top;'>
					{{ $data->alasan_kuliah }}
				</td>
			</tr>
			<tr>
				<td style='width: 26%;border-style: none;' >&nbsp;</td>
				<td style='width: 22%;border-style: none;'>&nbsp;</td>
				<td style='width: 22%;border-style: none;'>&nbsp;</td>
				<td style='width: 7.5%;border-style: none;'>&nbsp;</td>
				<td style='width: 7.5%;border-style: none;'>&nbsp;</td>
				<td style='width: 7.5%;border-style: none;'>&nbsp;</td>
				<td style='width: 7.5%;border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style='border-style: none;'>&nbsp;</td>
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				<td rowspan="8" colspan="2" style='vertical-align: top; padding-left: 50px; border-style: none;'><img src="{{$data->profile !== null ? '/public'.$data->profile : ''}}" alt="" height=150px width=120px></td>
				<td colspan="5" style='text-align: center; border-style: none;'>Denpasar, ___________________2020</td>
			</tr>
			<tr>
				
				<td colspan="5"style='text-align: center; border-style: none;'>Biodata diisi dengan sebenar-benarnya</td>
			</tr>
			<tr>
				
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				
				<td colspan="5" style='border-style: none;'></td>
			</tr>
			<tr>
				
				<td colspan="5" style='text-align: center; border-style: none;'>(.............................................................)</td>
			</tr>
			<tr>
				<td colspan="2" style='border-style: none;'>&nbsp;</td>
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style='border-style: none;'>&nbsp;</td>
				<td colspan="5" style='border-style: none;'>&nbsp;</td>
			</tr>
		</table>
		</div>
		</div>
	</body>
</html>
