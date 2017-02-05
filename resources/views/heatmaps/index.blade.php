<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <title>Heatmaps</title>
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
    <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-half is-offset-one-quarter">
          <table class="table">
            <thead>
              <tr>
                <th>Name</abbr></th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($maps as $map)
              <tr>
                <th> {{ucfirst($map)}}</th>
                <td><a href="/heatmaps/{{$map}}">View</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>      
    </section>  
  </body>
</html>