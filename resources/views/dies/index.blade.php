@extends('layouts.layout')

@section('title')
	Dies Natalis
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background: #3C3B3F; background: -webkit-linear-gradient(to top, #605C3C, #3C3B3F);  background: linear-gradient(to top, #c3a72f, #222); height: 70vh;">
        <div class="container" style="margin-top: 25vh;">
            <div class="text-center">
                <h1 style="font-size: 48px;
                margin: 0;
                line-height: 1;
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                color:#FFF;
                text-transform: uppercase;">PORSENI DIES NATALIS</h1>
            </div>
        </div>
    </div>

    <div class="container" style="padding-top:80px; padding-bottom:80px;">
        <h1 class="text-center mb-4">Tentang Porseni DIES NATALIS</h1>
        <p class="text-justify">
            Universitas Udayana pada tahun <script>
                document.write(new Date().getFullYear());
            </script> ini memasuki usia ke-<script>
                document.write(new Date().getFullYear()-1962);
            </script>. Sepanjang perjalanannya, Universitas Udayana telah mengupayakan untuk senantiasa berada dan membaur di tengah-tengah masyarakat. Para alumni dan segenap civitas akademika Fakultas Teknik Universitas Udayana telah tersebar diberbagai tempat melalui bidang kerja yang dijalani puluhan tahun, menebar dan menyebar insan-insan pembangunan, tentu amat banyak pahit manis yang dirasakan. Potensi yang tersebar itu sudah saatnya untuk dipertemukan dalam suatu kesempatan. Berbagai pengalaman dari tempat-tempat yang berbeda sangat dibutuhkan oleh almamater tercinta untuk dimanfaatkan dalam perjalanan ke depan. Peringatan usia ke-<script>
                document.write(new Date().getFullYear()-1962);
            </script> Universitas Udayana yang dikenal sebagai DIES NATALIS <script>
                document.write(new Date().getFullYear()-1962);
            </script> merupakan suatu ajang yang dapat mempersatukan seluruh civitas Universitas Udayana.  
        </p>
        <p class="text-justify">
            Berbagai kegiatan yang akan diselenggarakan sangat berkaitan dengan apresiasi terhadap kesenian dan budaya Bali. Seni tak akan dapat lepas dari kehidupan masyarakat Bali. Kebudayaan Bali tercermin dari segala produk-produk kesenian yang dihasilkan. Masyarakat Bali baik itu generasi muda dan tua selalu bersama-sama memberikan kontribusi bagi perkembangan budaya Bali. Semua komponen piranti masyarakat juga tak dapat lepas dari seni dan budaya, begitu pula Fakultas Teknik Universitas Udayana. Sebagai lembaga pendidikan tinggi mengemban misi Tri Dharma Perguruan Tinggi yaitu pendidikan, penelitian, dan pengabdian kepada masyarakat Bali. Tugas mulia ini, tersebut dalam perjalanannya senantiasa mengikuti dinamika yang terjadi pada masyarakat. Perkembangan yang kian cepat tersebut tak mungkin dapat diikuti hanya dengan lingkungan sendiri, melainkan sangat perlu keterbukaan dan keterlibatan masyarakat luas. Keterbatasan tersebut tidak hanya mengenai dana dan sarana, tetapi kesempatan untuk sama-sama berkumpul dan mencurahkan pikiran merupakan barang langka. Berbagai kesibukan dan rutinitas keseharian, barangkali merupakan kendala betapa tidak mudah melakukan sumbangan secara bersama-sama bagi kemajuan almamater. Dengan adanya rangkaian kegiatan DIES NATALIS <script>
                document.write(new Date().getFullYear()-1962);
            </script> Universitas Udayana ini akan menjadi media untuk memupuk kebersamaan sekaligus berkreasi dalam kesenian.
        </p>
        <hr class="my-5">
        <h4 class="text-center mb-4">Download Form Kehadiran</h4>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Proram Studi</th>
                            <th>Ukuran Kertas</th>
                            <th>Warna Kertas</th>
                            <th>Link Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Teknik Arsitektur</td>
                            <td>F4</td>
                            <td>Kuning</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Teknik Sipil</td>
                            <td>F4</td>
                            <td>Biru</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Teknik Elektro</td>
                            <td>F4</td>
                            <td>Hijau</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Teknik Mesin</td>
                            <td>F4</td>
                            <td>Merah</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Teknologi Informasi</td>
                            <td>F4</td>
                            <td>Putih</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Teknik Lingkungan</td>
                            <td>F4</td>
                            <td>Putih</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Teknik Industri</td>
                            <td>F4</td>
                            <td>Putih</td>
                            <td>
                                <p class="text-center">
                                    <a class="btn btn-sm" target="_blank" href="{{ route('dies.download_form')}}" style="color:#FFF; background-color:#c3a72f"><span class="fa fa-download"></span> Download Berkas</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <div class="row justify-content-between">
                    <div class="col-md-4">
                        <a target="_blank"href="{{ route('beranda-sd.biodata-pdf') }}"><i class="fa fa-user"></i> Cetak Biodata</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.name-tag') }}"><i class="fa fa-print"></i> Cetak Name Tag</a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{ route('beranda-sd.evaluasi-pdf') }}"><i class="fa fa-print"></i> Cetak Kartu Evaluasi</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    
    
@endsection

@section('footer')
    <footer>
        <div class="footer-container">
            <p class="text-center m-0 pt-3">
                &#169; SMFT @1963-2018
                {{-- <span class="float-right"><a href="#">Ke atas</a></span> --}}
            </p>
        </div>
    </footer>
@endsection

@section('custom_javascript')

@endsection