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
            Location solution visualization
          </h1>
          <h2 class="subtitle">
            Reliable facility location problems
          </h2>
        </div>
      </div>
    </section>
    <section>
     <div class="container">
     <div class="colums">
      <div class="column is-half is-offset-one-quarter">
        <div class="notification has-text-centered">
          View natural disaster <a href="/heatmaps">heat maps</a>.
        </div>
      </div>
     </div>
      <div class="columns">
        <div class="column is-8 is-offset-2">
          <table class="table is-striped" id="solutionsTable">
            <thead>
              <tr>
                <th>ID</abbr></th>
                <th>#Nodes</th>
                <th>Parameters</th>
                <th>#Open</th>
                <th>ObjValue</th>
                <th>Gap(%)</th>
                <th>Time</th>
                <th>#Cuts</th>
                <th>Solver</th>
                <th>Solved at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($solutions as $solution)
              <tr>
                <td> {{$solution->id}}</td>
                <td> {{$solution->nbNodes}}</td>
                <td> <pre>{{$solution->parameters or '-'}}</pre></td>
                <td> {{$solution->nbOpen}}</td>
                <td> {{number_format($solution->objValue, 0, '.', ',')}}</td>
                <td> {{number_format($solution->gap * 100, 2, '.', ',')}}</td>
                <td> {{number_format($solution->solutionTime,2)}}</td>
                <td> {{$solution->nbCuts or '-'}}</td>
                <td> {{$solution->solver}}</td>
                <td> {{$solution->created_at}} </td>
                <td><a href="/solutions/{{$solution->id}}">View</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{ $solutions->links() }}
    </div>     
    </section>
    <script type="text/javascript" src="{{asset('js/index.js')}}"></script>
  </body>
</html>