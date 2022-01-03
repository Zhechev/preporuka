@extends('frontend.app')
@section('content')

  <div class="search_container_block home_main_search_part main_search_block" data-background-image="{{ asset('images/city_search_background.jpg') }}" style="background-image: url("{{ asset('images/city_search_background.jpg') }}");"/>
    <div class="main_inner_search_block">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2><strong>Октрийте най-доброто място за Вас!</strong></h2>
            <h4>Ресторанти, сервизи, забавление и много други, препоръчани за Вас!</h4>
            <form action="{% url 'search-venues' %}" method="post" id="home-search-form">
              <div class="main_input_search_part">
                  <div class="main_input_search_part_item" id="home-search-title-div">
                    <input type="text" id="home-search-title" name="title" placeholder="Име на обекта" value="">
                  </div>
                  <!--div class="main_input_search_part_item location">
                    <input type="text" placeholder="Search Location..." value="">
                    <a href="#"><i class="sl sl-icon-location"></i></a>
                  </div-->
                  <div class="main_input_search_part_item" id="search-choose-city-div">
                    <select id="search-choose-city" name="city" data-placeholder="All Categories" class="utf_chosen_select">
                      <option value="">Изберете град</option>
                    {{-- {% for city in cities %}
                        <option value="{{ city.id }}">{{ city.name }}</option>
                    {% endfor %} --}}
                    </select>
                  </div>
                  <div class="main_input_search_part_item" id="search-choose-category-div">
                    <select id="search-choose-category" name="category" data-placeholder="All Categories" class="utf_chosen_select">
                      <option value="">Изберете категория</option>
                      <option value="restaurants">Ресторанти</option>
                      <option value="sportfitness">Спорт и Фитнес</option>
                      <option value="carservice">Автосервизи</option>
                      <option value="beautysalon">Салони за красота</option>
                      <option value="fastfood">Бързо хранене</option>
                      <option value="carwash">Автомивки</option>
                      <option value="fun">Забавление</option>
                      <option value="other">Други</option>
                    </select>
                  </div>
                  <button class="button" type="submit" id="home-search-button">ТЪРСИ</button>
                </div>
            </form>
            <div class="main_popular_categories">
			  <h3>Разгледай категориите</h3>
              <ul class="main_popular_categories_list">
                @foreach ($categories as $category)
                  <li> <a href="{{ route('category.show', ['category' => $category]) }}">
                      <div class="utf_box"> <i class="{{ $category->icon }}" aria-hidden="true"></i>
                        <p>{{ $category->category_bg_name }}</p>
                      </div>
                      </a>
                  </li>
                  @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
	<div class="row">
      <div class="col-md-12">
        <h3 class="headline_part centered margin-top-75"> Категории<span> Открий правилната категория за теб</span></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="container_categories_box margin-top-5 margin-bottom-30">
            @foreach ($categories as $category)
            <a href="{{ route('category.show', ['category' => $category]) }}" class="utf_category_small_box_part"> <i class="{{ $category->icon }}"></i>
                <h4>{{ $category->category_bg_name }}</h4>
                <span>10</span>
              </a>
            @endforeach
		</div>
<!--		<div class="col-md-12 centered_content"> <a href="#" class="button border margin-top-20">View More</a> </div>-->
      </div>
    </div>
  </div>

  <section class="fullwidth_block margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-45"> Препоръчани места <span>Вижте някои от най-добрите места</span> </h3>
        </div>

		<div class="row">
			<div class="col-md-12">
				<div class="simple_slick_carousel_block utf_dots_nav">
                {% for venue in recommended_venues %}
                    33
                  <div class="utf_carousel_item"> <a href="{% url 'show-venue' category=venue.category.name pk=venue.id page_num=1%}" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> name</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>title</h3>
						<span><i class="sl sl-icon-location"></i> address</span>
						<span><i class="sl sl-icon-phone"></i> phone</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">33</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>
                {% endfor %}

				</div>
			  </div>
		  </div>
	   </div>
    </div>
  </section>

  <a href="listings_grid_full_width.html" class="flip-banner parallax" data-background="{% static 'core/images/slider-bg-02.jpg' %}" data-color="#000" data-color-opacity="0.85" data-img-width="2500" data-img-height="1666">
	  <div class="flip-banner-content">
		<h2 class="flip-visible">Browse Listings Attractions List</h2>
	  </div>
  </a>

  <section class="utf_testimonial_part fullwidth_block padding-top-75 padding-bottom-75">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h3 class="headline_part centered">What Say Our Customers <span class="margin-top-15">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since...</span> </h3>
        </div>
      </div>
    </div>
    <div class="fullwidth_carousel_container_block margin-top-20">
      <div class="utf_testimonial_carousel testimonials">
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{% static 'core/images/happy-client-01.jpg' %}" alt="">
            <h4>Denwen Evil <span>Web Developer</span></h4>
          </div>
        </div>
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{% static 'core/images/happy-client-02.jpg' %}" alt="">
            <h4>Adam Alloriam <span>Web Developer</span></h4>
          </div>
        </div>
        <div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{% static 'core/images/happy-client-03.jpg' %}" alt="">
            <h4>Illa Millia <span>Project Manager</span></h4>
          </div>
        </div>
		<div class="utf_carousel_review_part">
          <div class="utf_testimonial_box">
            <div class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</div>
          </div>
          <div class="utf_testimonial_author"> <img src="{% static 'core/images/happy-client-01.jpg' %}" alt="">
            <h4>Denwen Evil <span>Web Developer</span></h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container padding-bottom-70">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline_part centered margin-bottom-35 margin-top-70">Most Popular Cities/Towns <span>Discover best things to do restaurants, shopping, hotels, cafes and places<br>around the world by categories.</span></h3>
      </div>
      <div class="col-md-3">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-01.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>Nightlife </h4>
			  <span>18 Listings</span>
			</div>
         </a>
	  </div>
      <div class="col-md-3">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-02.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>Shops</h4>
			  <span>24 Listings</span>
			</div>
         </a>
	  </div>
      <div class="col-md-6">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-03.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>Restaurant</h4>
			  <span>17 Listings</span>
			</div>
         </a>
	  </div>
      <div class="col-md-6">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-04.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>Outdoor Activities</h4>
			  <span>12 Listings</span>
			</div>
         </a>
	  </div>
      <div class="col-md-3">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-05.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>Hotels</h4>
			  <span>14 Listings</span>
			</div>
         </a>
	  </div>
      <div class="col-md-3">
         <a href="listings_list_with_sidebar.html" class="img-box" data-background-image="{% static 'core/images/popular-location-06.jpg' %}">
			<div class="utf_img_content_box visible">
			  <h4>New York</h4>
			  <span>9 Listings</span>
			</div>
         </a>
	  </div>
	  <div class="col-md-12 centered_content"> <a href="#" class="button border margin-top-20">View More Categories</a> </div>
    </div>
  </div>

  <section class="utf_cta_area_item utf_cta_area2_block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf_subscribe_block clearfix">
                    <div class="col-md-8 col-sm-7">
                        <div class="section-heading">
                            <h2 class="utf_sec_title_item utf_sec_title_item2">Subscribe to Newsletter!</h2>
                            <p class="utf_sec_meta">
                                Subscribe to get latest updates and information.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <div class="contact-form-action">
                            <form method="post">
                                <span class="la la-envelope-o"></span>
                                <input class="form-control" type="email" placeholder="Enter your email" required="">
                                <button class="utf_theme_btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
	</section>
@endsection
