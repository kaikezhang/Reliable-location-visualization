<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Reliable facility location problems
          </h1>
          <h2 class="subtitle">
            Experiments and results
          </h2>
        </div>
      </div>
    </section>
    <section>
     <div class="container" id="app">
      <div class="columns" style="padding-top:10px;">
        <div class="column is-half is-offset-one-quarter">
          <div class="notification has-text-centered">
            View natural disaster <a href="/heatmaps">heat maps</a>.
          </div>
        </div>
      </div>
      <div class="columns">
            <filter-form></filter-form>
      </div>
      <div class="columns">
        <div class="column is-12" >
          <dash-table></dash-table>
        </div>
      </div>
      <div class="columns">
        <div class="column is-12">
        {{ $solutions->links() }}
        </div>    
      </div>
    </div>       
    </section>
    <script type="text/javascript">
     let data = {!! $solutions->toJson()!!};
     window.solutions = data.data;
     window.shouldRecieveUpdate = true;
     window.filters = {!! json_encode($filters)!!};
    </script>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
  </body>
</html>