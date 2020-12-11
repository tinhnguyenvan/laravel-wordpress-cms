@foreach($subCategories as $subCategory)
    <tr data-node-id="{{$subCategory->id}}" data-node-pid="{{$subCategory->parent_id}}">
        <td>{{$subCategory->name}}</td>
    </tr>
    @if(count($subCategory->subcategory))
        @include('view_affiliate::admin.category.tree_view',['subCategories' => $subCategory->subcategory])
    @endif
@endforeach
