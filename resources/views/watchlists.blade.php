@extends('template')

@section('title', 'MovieList | WatchList')

@section('css')
<link rel="stylesheet" href="{{ asset('css/watchlist.css') }}">
@endsection

@section('content')
<div class="row g-3">
  <div class="col">
    <form action="/watchlists">
        <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Search Movie" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
        </div>
    </form>
  </div>
</div>
<div class="row"> 
    <div class="col-3">
        <form action="/watchlists">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01"><span class="fa fa-filter"></i></label>
                <select onchange="this.form.submit();" name="status" class="form-select" aria-label="Default select example">
                    @if (!isset($status))
                        <option value="" selected>All</option>
                    @else
                        <option value="">All</option>
                    @endif
                    @if (isset($status) and $status == 'Planning')
                        <option value="Planning" selected>Planned</option>
                    @else
                        <option value="Planning">Planned</option>
                    @endif
                    @if (isset($status) and $status == 'Watching')
                        <option value="Watching" selected>Watching</option>
                    @else
                        <option value="Watching">Watching</option>
                    @endif
                    @if (isset($status) and $status == 'Finished')
                        <option value="Finished" selected>Finished</option>
                    @else
                        <option value="Finished">Finished</option>
                    @endif
                </select>
            </div>
        </form>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-5 g-3">
    <table class="table table-dark table-borderless table-hover">
        <tr>
            <th>Poster</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @forelse ($movies as $m)
            <tr>
                <td><img src="{{Storage::url('public/'.$m->img_url)}}" class="img-row" alt="..."></td>
                <td>{{$m->title}}</td>
                <td>
                    <?php $temp = $m->watchStatus(Auth::user()->id) ?>
                    @if ($temp == 'Planning')
                        <p class="green">{{$temp}}</p>
                    @elseif ($temp == 'Watching')
                        <p class="yellow">{{$temp}}</p>
                    @else
                        <p class="red">{{$temp}}</p>
                    @endif
                </td>
                <td>
                    <button type="button" class="edit_status profile" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="{{$m->id}}">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>
            </tr>
        @empty
            No watchlist found.
        @endforelse
    </table>
</div>

<ul class="pagination d-flex justify-content-end">
    <li class="page-item">
        <a class="page-link" href="{{$movies->previousPageUrl()}}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" href="{{$movies->nextPageUrl()}}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        @if ($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        <form action="/watchlists/changeStatus" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="movie_id">
                <select name="status" class="form-select" aria-label="Default select example">
                    <option value="Planning">Planned</option>
                    <option value="Watching">Watching</option>
                    <option value="Finished">Finished</option>
                    <option value="Remove">Remove</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary c_btn" type="submit" name="btn-submit" value="submit"> Save Changes </button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var exampleModal = document.getElementById('staticBackdrop')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')
        modalBodyInput.value = recipient
    })
</script>
@endsection