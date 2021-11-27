@if (session()->exists('estado'))
    <div class="container p-3 mensaje">
        <div class="alert alert-{{ session()->get('alert') }} p-2" role="alert">
            {{ session()->get('estado') }}
        </div>
    </div>
    <?php
    session()->forget('estado');
    session()->forget('alert');
    ?>
@endif
