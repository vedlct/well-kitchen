<div id="cart">
<!-- cart button right fixed start -->
<div class="cart-button-fixed" onclick="showNav()" id="cartNav">
    <i class="pe-7s-shopbag"></i>
    <h5 class="mb-0">Cart <span class="cart_count">{{Cart::getContent()->count()}}</span></h5>
</div>
<!-- cart button right fixed end -->

<!-- right fixed cart start -->
<div class="full-body-overlay" id="fullBodyOverlay" onclick="hideOverlay()"></div>
<section class="side-cart side-nav px-3 py-md-5 py-3" id="sideNav">
  <div class="d-flex justify-content-between">
      <div>
          <h4>Shopping Cart</h4>
      </div>
      <div class="">
        <i class="fa fa-times close-icon" onclick="hideNav()"></i>
      </div>
  </div>
  <div class="product-area my-md-5 my-4 carNavWrapper">
    @foreach (\Cart::getContent() as $item)
    {{-- @dd($item); --}}
    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
        <div>
            <img src="{{asset('admin/public/featureImage/'.$item->associatedModel->featureImage)}}" alt="" class="product-img">
        </div>
        <div class="name-area px-2">
          <h5 class="product-name"><a href="{{route('product.details',$item->id)}}">{{$item->associatedModel->productName}}</a></h5>
          <h6 class="quantity"> {{$item->quantity}} x &#2547;{{$item->price}}</h6>
        </div>
        <div class="" onclick="removeItem('{{$item->id}}')">
            <i class="fa fa-trash"></i>
          </div>
    </div>
   @endforeach

  </div>
  @if(\Cart::getContent()->count() > 0)

  <div class="d-flex justify-content-between cartTable">
        <div>
            <h5>Sub-Total:</h5>
        </div>
        <div class="">
        <h5 class="subTotal">&#2547;{{\Cart::getSubTotal()}}</h5>
        </div>
    </div>
    <div class="row my-md-5 my-4 cartTableBtn">
        <div class="col-6">
            <a href="{{route('cart')}}" class="btn btn-secondary w-100">View Cart</a>
        </div>
        <div class="col-6">
            <a href="{{route('checkout.index')}}" class="btn btn-danger w-100">checkout</a>
        </div>
    </div>
</section>
@else
    <h3 class="emptyCart">Cart is empty</h3>
@endif
<!-- right fixed cart end -->
</div>