<article class="artic">
    <h2>{{ $task['title'] }}</h2>
    <p>{!! nl2br(e($task['description'])) !!}</p>
    <div class="form">
        <form action="/{{ $task['id'] }}" method="post">
            {{ csrf_field() }}
            {{ method_field("POST")}}
            <button type="submit">{{ $task['done'] ? "Todo" : "Finished" }}</button>
        </form>
        @if( $task['priority'] == 1)
        <form action="/{{ $task['id'] }}/priority" method="post">
            {{ csrf_field() }} 
            {{ method_field("POST")}}
            <button type="submit">{{ $task['priority'] ? "Unprioritize" : "Prioritize" }}</button>
        </form>
        @endif
        @if( $task['priority'] == 0)
        <form action="/{{ $task['id'] }}/priority" method="post">
            {{ csrf_field() }}
            {{ method_field("POST")}}
            <button type="submit">Prioritize</button>
        </form>
        @endif
        <form action="/{{ $task['id'] }}" method="post">
            {{ csrf_field() }}
            {{ method_field("DELETE")}}
            <button type="submit">Delete</button>
        </form>
    </div>
</article>