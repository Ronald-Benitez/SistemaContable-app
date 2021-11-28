@if (session()->missing('typeUser'))
    @include('theme.navBarBase')
@elseif (session()->get('typeUser')=='admin')
    @include('theme.navBarAdmin')
@else
    @include('theme.navBarUser')
@endif
