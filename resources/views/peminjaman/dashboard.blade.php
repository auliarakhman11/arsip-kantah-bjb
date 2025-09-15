<div class="row">
    @foreach ($dashboard as $d)
        <div class="col-md-3 col-6">

            <a href="#modal_detail_dashboard" jenis_history="{{ $d->jenis_history }}" data-toggle="modal"
                class="detail_dashboard"><i class="fas fa-dot-circle text-info"></i> {{ ucwords($d->jenis_history) }} :
                {{ $d->jml }}</a>

        </div>
    @endforeach


</div>
