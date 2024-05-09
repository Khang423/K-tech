@extends('layout_admin.header')
@extends('layout_admin.master')
<div class="">

</div>
@foreach($view as $i)
    {!!$i->describe!!}
@endforeach
