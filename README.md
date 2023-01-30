## Laravel
By Default, Laravel will escape any data automatically.
```html
<h2>You Searched: &lt;script&gt;alert(1)&lt;/script&gt;</h2>
```

*Controller*
```php
class SearchController extends Controller
{
    public function submit(Request $request)
    {
        $search = $request->input('search');

        // Process form data
        return view('welcome', ['search' => $search]);
    }
}
```

*View*
```html
<html>
    <body class="antialiased">
        <div>
            <h1>XSS Laravel</h1>
            <form action="/submit" method="post">
                @csrf
                <input type="text" name="search">
                <input type="submit" value="Submit">
            </form>
            <h2>You Searched: {{ $search }}</h2>
        </div> 
    </body>
</html>
```


**Vulnerability 1) echo**<br/>
The example above uses the blade templating engine to render the user's input on the screen. The blade templating engine will automatically escape any HTML characters. Using the `echo` command to render user input can result in XSS as the input will not be escaped.

*Controller*
```php
class SearchController extends Controller
{
    public function submit(Request $request)
    {
        $search = $request->input('search');

        echo $search;
    }
}
```

The following XSS vulnerability can be prevented by using the `htmlspecialchars` function:
```php
class SearchController extends Controller
{
    public function submit(Request $request)
    {
        $search = $request->input('search');

        echo htmlspecialchars($search);
    }
}
```

**Vulnerability 2) href**<br/>
Inserting user input into an `href` tag will result in XSS.

*View*
```html
<html>
    <body class="antialiased">
        <div>
            <h1>XSS Laravel</h1>
            <form action="/submit" method="post">
                @csrf
                <input type="text" name="search">
                <input type="submit" value="Submit">
            </form>
            <a href={{$search}}>Website</a>
        </div> 
    </body>
</html>
```

