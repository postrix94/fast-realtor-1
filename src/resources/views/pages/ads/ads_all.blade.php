@extends("templates.main")

@section("content")
    <ads-all :url="{{json_encode($url)}}"/>
@endsection
