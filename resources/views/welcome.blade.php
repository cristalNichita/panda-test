<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <form action="{{ route('subscribe') }}" method="POST">
            @csrf
            <input name="ad_url" placeholder="url">
            <input name="email" placeholder="email">
            <button type="submit">submit</button>
        </form>
    </body>
</html>
