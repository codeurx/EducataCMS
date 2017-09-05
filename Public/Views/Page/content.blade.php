<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
@foreach($page as $page)
    id : {{ $page->page_id }}<br>
    Title : {{ $page->page_title }}<br>
    <b>{{ $page->page_content }}</b>
@endforeach
</body>
</html>