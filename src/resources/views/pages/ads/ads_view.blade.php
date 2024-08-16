@includeIf("partials.header")
<Ads :ads="{{json_encode($ads)}}" :url="{{json_encode($url)}}"/>
@includeIf("partials.footer")


