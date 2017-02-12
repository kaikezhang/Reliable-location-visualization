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
          Solution {{$solution->id}}
          </h1>
        </div>
      </div>
    </section>
    
    <section>
      <div class="container" style="padding-top:10px;">
            <table class="table is-bordered is-striped">
              <tr>
                <td><code>Number of Nodes</code></td><td>{{$solution->nb_nodes}}</td>
              </tr>
              <tr>
                <td><code>Parameters</code></td><td>{{$solution->parameters}}</td>
              </tr>
              <tr>
                <td><code>Number of Open Facilities</code></td><td>{{$solution->nb_open}}</td>
              </tr>
              <tr>
                <td><code>Obejctive Value</code></td><td>{{$solution->obj_value}}</td>
              </tr>
              <tr>
                <td><code>Gap(%)</code></td><td>{{$solution->gap}}</td>
              </tr>
              <tr>
                <td><code>Time</code></td><td>{{$solution->solution_time}}</td>
              </tr>
              <tr>
                <td><code>Number of Cuts</code></td><td>{{$solution->nb_cuts}}</td>
              </tr>
              <tr>
                <td><code>Problem</code></td><td>{{$solution->problem}}</td>
              </tr>
              <tr>
                <td><code>Solver</code></td><td>{{$solution->solver}}</td>
              </tr>
              <tr>
                <td><code>Status</code></td><td>{{$solution->status}}</td>
              </tr>
              <tr>
                <td><code>Log</code></td>
                <td>
                @if ($solution->has_log)
                <a href="/solutions/{{$solution->id}}/log">View</a>
                @endif
                </td>
              </tr>
              <tr>
                <td><code>Map</code></td>
                <td>
                @if ($solution->status != "Error" && $solution->status != "Infeasible")
                <a href="/solutions/{{$solution->id}}/map">View</a>
                @endif
                </td>
              </tr>
              <tr>
              <td><code>Created At</code></td><td>{{$solution->created_at}}</td>
              <tr>
            </table>
      </div>
    </section>
  </body>
</html>