<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/app.css">
        <title>Todo List</title>
    </head>
    <body>
        <p id="result"><button onClick='xmlreq("/ajax?sort=1" ,func , "{{ csrf_token() }}");'>Turn priority on</button></p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <section class="tasks">
            <section class="todo">
            <h1>To do</h1>
            <section id="todolist" class="data">
                @foreach($tasks as $task)                    
                    @if( $task['done'] == 0)
                        @include('partials.task', ['task'=>$task])
                    @endif  
                @endforeach
                </section>
            </section>
            <section class="done">
                <h1>Finished</h1>
            <section id="donelist" class="data">
                @foreach($tasks as $task)
                    @if( $task['done'] == 1)
                        @include('partials.task', ['task'=>$task])
                    @endif
                @endforeach
            </section>
            </section>
            <section class="add">
                <h1>Add task</h1>
                <section class="data">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="title" id="title" placeholder="Title (max 25 characters)">
                    <textarea cols="30" rows="10" name="description" id="description" placeholder="description goes here"></textarea>
                    <button type="submit">Save</button>
                </form>
                </section>
            </section>
        </section>

        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
