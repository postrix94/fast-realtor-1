<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


@can(['public-link'],\Illuminate\Support\Facades\Auth::user())
<h1>Public Link</h1>
@endcan

@can(["save-images"],\Illuminate\Support\Facades\Auth::user())
<h1>save images</h1>
@endcan

@can(["send-to-telegram"],\Illuminate\Support\Facades\Auth::user())
<h1>send to telegram</h1>
@endcan

@can(["view-user", "add-new-user", "blocked-user", "view-user-payment"], \Illuminate\Support\Facades\Auth::user())
<h1>view user</h1>
<h1>add new user</h1>
<h1>blocked user</h1>
<h1>view user payment</h1>
@endcan

@can('role-management', \Illuminate\Support\Facades\Auth::user())
<h1>assign role</h1>
<h1>change role</h1>
<h1>remove role</h1>
@endcan

</body>
</html>
