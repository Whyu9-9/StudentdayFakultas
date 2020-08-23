<!--==========================
Contact Section
============================-->
<section id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3">
                <div class="info-pilihan">
                    <h5>Informasi Pilihan</h5>
                    <a href="{{ route('sd.index')}}"><h6>Student Day 
                        <script>
                            document.write(new Date().getFullYear());
                        </script></h6></a>
                    <a href="{{ route('sd-pengumuman.index')}}"><h6>Pengumuman</h6></a>
                    <a target="_blank" href="https://www.granatsmft.com/"><h6>GrAnaT 
                        <script>
                            document.write(new Date().getFullYear());
                        </script></h6></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="info">
                    <h5>Sekretariat SMFT</h5>
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p>Jl. PB Sudirman<br>Denpasar, Bali</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p>senat.ft.unud@gmail.com</p>
                    </div>
                    {{-- <div>
                        <i class="fa fa-phone"></i>
                        <p>+1 5589 55488 55s</p>
                    </div> --}}
                </div>
                <div class="social-links">
                    <a href="https://twitter.com/smft_unud?lang=en" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/senat.ft.unud" target="_blank" class="facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/smft_unud/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="line://ti/p/@bye5870b" target="_blank" class="instagram"><i class="fab fa-line"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <iframe style="height:300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1972.1031456915207!2d115.21920857969029!3d-8.671922290645485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd240ec7f9cc977%3A0xb424284c3310f82c!2sFakultas+Teknik+UNUD%2C+Kampus+Sudirman+-+Denpasar!5e0!3m2!1sen!2sid!4v1531969481290" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            
        </div>
    </div>
</section><!-- #contact -->

<footer id="footer">
    <div class="container">
        <div class="py-3">
                <div class="footer-line">

                </div>
        </div>
        
        <div class="copyright">
            &copy; 2018 <a href="/"><strong>SMFT</strong></a>. All Rights Reserved
        </div>
    </div>
</footer>