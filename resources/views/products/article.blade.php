<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{ url(env('PRODUCT_IMAGE'), $product->image1) }}" alt="">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>Price: <strong>{{ $product->price . 'E'}}</strong></p>
            <p>{{ link_to(route('product.show', $product->id), 'Buy', ['class' => 'btn btn-success']) }}</p>
        </div>
    </div>
</div>