@extends('base')

@section('body')
<div class="container-fluid title-box">
  <h1>{{ $message or 'Nothing Found' }}</h1>
  <h4 class="text-muted">{{ $submessage or 'Try something different' }}</h4>
</div>
@stop