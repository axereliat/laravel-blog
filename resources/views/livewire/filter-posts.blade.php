<div class="card">
    <div class="card-body">
        @foreach($tags as $tag)
            <div class="form-check form-check-inline">
                <input
                        class="form-check-input"
                        type="checkbox"
                        wire:model="selectedTags"
                        id="tag_{{ $tag->id }}"
                        value="{{ $tag->name }}">
                <label class="form-check-label"
                       for="tag_{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach
        <ul class="list-group d-inline">
            @foreach($categories as $category)
                <li class="list-group-item">
                    <input type="checkbox"
                           name="categories[]"
                           value="{{$category->id}}"
                           id="category_{{$category->id}}"
                           wire:model="selectedCategories"
                    />
                    <label for="category_{{$category->id}}">{{$category->name}}</label>
                </li>
            @endforeach
        </ul>

        <div class="form-group">
            <button class="btn btn-primary mt-2" wire:click.prevent="filter()">Filter</button>
        </div>
    </div>
</div>

<script>
  $('#tags').tagator({
    autocomplete: @json($tags)
  })
</script>