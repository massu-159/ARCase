<div class="card mt-3">
  <img src="{{ Storage::url($product->image) }}" class="img-fluid" />
  <div class="card-body d-flex flex-row pb-0">
    <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class="text-dark">
      <i class="fas fa-user-circle fa-3x mr-1"></i>
    </a>
    <div class="card-body pt-0 pb-2">
      <h3 class="h4 card-title pt-2">
        <a class="text-dark" href="{{ route('products.show', ['product' => $product]) }}">
          {{ $product->title }}
        </a>
      </h3>
    </div>
    @if( Auth::id() === $product->user_id )
    <!-- dropdown -->
    <div class="ml-auto card-text">
      <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-link text-muted m-0 p-2">
            <i class="fas fa-ellipsis-v"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route("products.edit", ['product'=> $product]) }}">
            <i class="fas fa-pen mr-1"></i>更新
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $product->id }}">
            <i class="fas fa-trash-alt mr-1"></i>削除
          </a>
        </div>
      </div>
    </div>
    <!-- dropdown -->
    
    <!-- modal -->
    <div id="modal-delete-{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              {{ $product->title }}を削除します。よろしいですか？
            </div>
            <div class="modal-footer justify-content-between">
              <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
              <button type="submit" class="btn btn-danger">削除する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- modal -->
    @endif
  </div>
  <div class="pl-3">
    <div class="font-weight-normal pl-2">
      <a href="{{ route('users.show', ['name' => $product->user->name]) }}" class="text-dark">
        {{ $product->user->name }}
      </a>
    </div>
    <div class="font-weight-lighter">
      {{ $product->created_at->format('Y/m/d H:i') }}
    </div>
  </div>
  <div class="card-body pt-0 pb-2 pl-3">
    <div class="card-text">
      <product-like
      :initial-is-liked-by='@json($product->isLikedBy(Auth::user()))'
      :initial-count-likes='@json($product->count_likes)'
      :authorized='@json(Auth::check())'
      endpoint="{{ route('products.like', ['product' => $product]) }}"
      >
        
      </product-like>
    </div>
  </div>
</div>
