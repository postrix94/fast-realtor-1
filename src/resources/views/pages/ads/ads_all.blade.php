@extends("templates.main")

@section("content")
    <ads-all :ads="{{json_encode($ads)}}"/>
@endsection
