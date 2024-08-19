@extends("templates.main")
@section("content")
    <ads-edit :url="{{json_encode($url)}}" :ads="{{json_encode($ads)}}" :public_url_ads="{{json_encode($public_url_ads)}}"/>
@endsection
