<div class="row">
    @foreach ($dashboard as $d)
    <div class="col-md-3 col-6">

        <p><i class="fas fa-dot-circle text-info"></i> {{ ucwords($d->jenis_history) }} : {{ $d->jml }}</p>
        
    </div>
    @endforeach
    

</div>