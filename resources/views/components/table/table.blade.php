<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            @include('components.table.thead')
            @if($actions)
            <th>Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($results as $key => $result)
        <tr>
            <td>{{++$key}}</td>
            @include('components.table.tbody')
            @if($actions)
            @foreach($actions as $key=> $action)
            <td>
                <a href="{{$action['url']}}"><i class="{{$action['icon']}}"></i> {{ucwords($action['text'])}}</a>
            </td>
            @endforeach
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
