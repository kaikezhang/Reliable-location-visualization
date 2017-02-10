<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <title>View Log File</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/prism.css')}}">
    </head>
    <body>
  <pre class="language-none line-numbers"><code>{!! $solution->log !!}</code></pre>    
    
    <script type="text/javascript" src="{{asset('js/prism.js')}}"></script>  
    </body>
   
</html>