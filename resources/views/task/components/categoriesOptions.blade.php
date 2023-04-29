<option value='0' selected >My Task</option>
@foreach (Auth::user()->UserCategory as $category)
<option value="{{ $category->id }}">{{ $category->category_name }}</option>
@endforeach