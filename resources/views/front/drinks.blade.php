

<section id="menu" class="menu section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Our Drinks</h2>
      <p>Check Our Tasty Drinks</p>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="menu-flters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-starters">Asirs</li>
          <li data-filter=".filter-salads">Jus</li>
          <li data-filter=".filter-specialty">Smoothie</li>
        </ul>
      </div>
    </div>

    <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

      @foreach($drinks as $drink)
      @if($drink->visible)
      <div class="col-lg-6 menu-item filter-specialty">
        <img src="{{route('drinkImage', ['imageName' => $drink->image_path ])}}" class="menu-img" alt="">
        <div class="menu-content">
          <a href="#" class="item-name" >{{$drink->name}}</a><span class="item-price">€{{$drink->price}}</span>
        </div>
        <div class="menu-ingredients">
          @foreach(explode('/',$drink->ingredients) as $ingredient)
          {{$ingredient}} @if(!$loop->last) - @endif
          @endforeach
        </div>
        @auth("web")
        <button class="add-to-cart-button" @click="addToCart({{$drink->id}},'drink')">
          <svg class="add-to-cart-box box-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
          <svg class="add-to-cart-box box-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="2" fill="#ffffff"/></svg>
          <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
          <svg class="tick" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#ffffff" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z"/></svg>
          <span class="add-to-cart"></span>
          <span class="added-to-cart"></span>
        </button>
        @endif
      </div>
      @endif
      @endforeach
      

    </div>

  </div>
  
</section><!-- End Menu Section -->
