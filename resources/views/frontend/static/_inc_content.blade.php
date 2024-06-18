<div style="max-width: 100%">
    <h1 style="font-size: 24px;margin: 15px 0">{{ $pageContent->name ?? "" }}</h1>
    <h4 style="font-size: 20px">{{ $pageContent->description ?? "" }}</h4>
    {!! $pageContent->page_content  ?? ""!!}
</div>
