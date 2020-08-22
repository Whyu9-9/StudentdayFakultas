@extends('layouts.beranda-layout')

@section('active10')
    active
@endsection

@section('content')
    <h2 class="mb-4"><i class="fa fa-fw fa-building"></i> Kelompok Studi</h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="text-danger fas fa-check mr-1"></i> {{Session::get('errors')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="text-info fas fa-check mr-1"></i> Tonton semua video dibawah dan buatlah Resume dari apa yang kamu sudah tonton
    </div>
    <style>
        .myIframe {
     position: relative;
     padding-bottom: 65.25%;
     padding-top: 30px;
     height: 0;
     overflow: auto; 
     -webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
     border: solid black 1px;
} 
.myIframe iframe {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
}
    </style>
    <div class="card-columns" style="width:100%;">
        @foreach ($kelompoks as $kelompok)
        <div class="card" >
            <a data-toggle="modal" data-target="#youtube" class="btn btn-block" data-youtube="{{ $kelompok->link }}" class="stretched-link">
            <img style="width: auto ;max-width: 100% ;height: auto ; display: block;margin-left: auto;margin-right: auto;" class="card-img-top" src="{{asset('/public/'.$kelompok->gambar)}}" alt="Card image" style="width:100%">
            </a>
            <div class="card-body">
              <h4 align="center" class="card-title"><strong>{{$kelompok->nama}}</strong></h4>
            </div>
          </div>
        @endforeach
        <div id="youtube" class="modal fade bd-example-modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4><i class="fab fa-youtube"></i> Youtube</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body myIframe" style="align:center;">
                        <iframe id="youtube" src="" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection
@section('custom_javascript')
<script>
    $('#youtube').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var youtube = button.data('youtube')
            var modal = $(this)
            modal.find('.modal-body #youtube').attr("src",youtube);
        });
    
    $(function(){
        $('body').on('hidden.bs.modal', function(e){
            var $iframes = $(e.target).find('iframe');
            $iframes.each(function(index, iframe){
                $(iframe).attr('src', $(iframe).attr('src'));
            });
        });
    })
</script>
@endsection