<form action="{{ route($route, [$item_name=>$item])}}" method="post" style="display: inline-block">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
</form>