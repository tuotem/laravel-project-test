<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite("resources/js/app.js")
</head>
<body>
    <h1>Show message here</h1>
    <ul>
        <li>Test notification</li>
    </ul>

    <script type="module">
        Echo.channel("my-channel")
        .listen("my-event", (e) => {
            console.log(e);
        });
    </script>
</body>
</html>