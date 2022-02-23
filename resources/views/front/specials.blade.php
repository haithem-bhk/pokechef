 <style type="text/css">
   .cart-btn-special {
    top: 72% !important;
    left:26% !important;
    width: 4rem !important;
  }
  @media (max-width: 480px) {
    .cart-btn-special {
      top: 101% !important;
      left:2% !important;
      width: 4rem !important;
    }
  }
  @media screen and (min-width: 481px) and (max-width: 1024px) {
    .cart-btn-special {
      top: 101% !important;
      left:1% !important;
      width: 4rem !important;
    }
  }
</style>
<section id="specials" class="specials">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Specials</h2>
      <p>Check Our Specials</p>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-3">
        <ul class="nav nav-tabs flex-column">
          @foreach($specials as $special)
          @if($special->visible)
          <li class="nav-item">
            <a class="nav-link @if($loop->first) active show @endif" data-bs-toggle="tab" href="#{{str_replace(' ', '', $special->name)}}">{{$special->name}}</a>
            
          </li>
          @endif
          @endforeach
          
        </ul>
      </div>
      <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="tab-content">
          @foreach($specials as $special)
          @if($special->visible)
          <div class="tab-pane @if($loop->first) active show @endif" id="{{str_replace(' ', '', $special->name)}}">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>{{$special->name}}</h3>
                <p class="fst-italic">{{$special->description}}</p>
                <p><b>Ingredients:</b> @foreach(explode('/', $special->ingredients) as $ingredient)
                  {{$ingredient}} @if(!$loop->last) - @endif 
                @endforeach</p>
                <p><b>Price:</b> €{{$special->price}}</p>
              </div>
              @auth("web")
              <button class="add-to-cart-button cart-btn-special " @click="addToCart({{$special->id}},'special')">
                <svg class="add-to-cart-box box-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
                <svg class="add-to-cart-box box-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
                <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <svg class="tick" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#ffffff" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z"/></svg>
                <span class="add-to-cart"></span>
                <span class="added-to-cart"></span>
              </button>
              @endif
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="{{route('specialImage', ['imageName' => $special->image_path ])}}" alt="" class="img-fluid">
              </div>

            </div>

          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>

  </div>
    </section><!-- End Specials Section -->