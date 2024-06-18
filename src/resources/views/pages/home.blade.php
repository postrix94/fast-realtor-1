@extends("templates.main")
@section("content")
    <Home :user="{{json_encode($user)}}" :olx_parser_route="{{ json_encode($olx_link) }}"/>
@endsection
