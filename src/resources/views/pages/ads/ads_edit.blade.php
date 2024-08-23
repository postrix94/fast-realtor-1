@extends("templates.main")
@section("content")
    <ads-edit :url-olx-ads-prefix="{{json_encode($urlOlxAdsPrefix)}}" :ads="{{json_encode($ads)}}"/>
@endsection
