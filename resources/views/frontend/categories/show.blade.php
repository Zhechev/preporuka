@extends('frontend.app')
@section('content')
  <div class="clearfix"></div>
  <div id="titlebar" class="gradient">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Layout List With Sidebar</h2>
          <nav id="breadcrumbs">
            <ul>
              <li><a href="index_1.html">Home</a></li>
              <li>Layout List With Sidebar</li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <div class="listing_filter_block">
            <form action="{% url 'show-all-venues' category_name=category page_num=1 %}" method="POST" id="sort_form">
                  <div class="col-md-2 col-xs-2">
                    <div class="utf_layout_nav"> <a href="listings_grid_with_sidebar.html" class="grid"><i class="fa fa-th"></i></a> <a href="#" class="list active"><i class="fa fa-align-justify"></i></a> </div>
                  </div>
                  <div class="col-md-10 col-xs-10">
                    <div class="sort-by utf_panel_dropdown sort_by_margin float-right"> <a href="#">Destination</a>
                      <div class="utf_panel_dropdown-content">
                        <input class="distance-radius" type="range" min="1" max="999" step="1" value="1" data-title="Select Range">
                        <div class="panel-buttons">
                          <button class="panel-apply">Apply</button>
                        </div>
                      </div>
                    </div>
                    <div class="sort-by">
                      <div class="utf_sort_by_select_item sort_by_margin">
                        <select data-placeholder="Сортиране" class="utf_chosen_select_single" id="select_sort" name="select_sort" onchange="this.form.submit()">
                            {% if select_sort == 'sort_rating_asc' %}
                                <option value="sort_rating_asc" selected>Оценка възх.</option>
                            {% else %}
                                <option value="sort_rating_asc">Оценка възх.</option>
                            {% endif %}
                            {% if select_sort == 'sort_rating_desc' %}
                                <option value="sort_rating_desc" selected>Оценка низх.</option>
                            {% else %}
                                <option value="sort_rating_desc">Оценка низх.</option>
                            {% endif %}

                        </select>
                      </div>
                    </div>
                    <div class="sort-by">
                      <div class="utf_sort_by_select_item sort_by_margin">
                        <select data-placeholder="Categories:" class="utf_chosen_select_single" id="select_sort_category" name="select_sort_category">
                            {% if category == 'restaurants' %}
                                <option value="restaurants" selected>Ресторанти</option>
                            {% else %}
                                <option value="restaurants">Ресторанти</option>
                            {% endif %}
                            {% if category == 'sportfitness' %}
                                <option value="sportfitness" selected>Спортни и фитнес</option>
                            {% else %}
                                <option value="sportfitness">Спортни и фитнес</option>
                            {% endif %}
                            {% if category == 'carservice' %}
                                <option value="carservice" selected>Автосервизи</option>
                            {% else %}
                                <option value="carservice">Автосервизи</option>
                            {% endif %}
                            {% if category == 'beautysalon' %}
                                <option value="beautysalon" selected>Салони за красота</option>
                            {% else %}
                                <option value="beautysalon">Салони за красота</option>
                            {% endif %}
                            {% if category == 'fastfood' %}
                                <option value="fastfood" selected>Бързо хранене</option>
                            {% else %}
                                <option value="fastfood">Бързо хранене</option>
                            {% endif %}
                            {% if category == 'carwash' %}
                                <option value="carwash" selected>Автомивки</option>
                            {% else %}
                                <option value="carwash">Автомивки</option>
                            {% endif %}
                            {% if category == 'fun' %}
                                <option value="fun" selected>Забавлание</option>
                            {% else %}
                                <option value="fun">Забавлание</option>
                            {% endif %}
                            {% if category == 'other' %}
                                <option value="other" selected>Други</option>
                            {% else %}
                                <option value="other">Други</option>
                            {% endif %}
                        </select>
                      </div>
                    </div>
                    <!--div class="sort-by">
                      <div class="utf_sort_by_select_item utf_search_map_section">
                        <ul>
                          <li><a class="utf_common_button" href="#"><i class="fa fa-dot-circle-o"></i>Близо до мен</a></li>
                        </ul>
                      </div>
                    </div-->
                  </div>
            </form>
        </div>
        <div class="row">
            @foreach ($category->venues as $venue)
              <div class="col-lg-12 col-md-12">
                <div class="utf_listing_item-container list-layout"> <a href="{% url 'show-venue' category=category pk=venue.id page_num=1%}"  class="utf_listing_item">
                  <div class="utf_listing_item-image">
                      <img src="{% static 'core/images/utf_listing_item-01.jpg' %}" alt="">
                      <span class="like-icon"></span>
                      <span class="tag"><i class="im im-icon-Hotel"></i> {{ $category->bg_name }}</span>
                      <div class="utf_listing_prige_block utf_half_list">
                        <span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
                        <span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
                      </div>
                  </div>
                  <span class="utf_open_now">Open Now</span>
                  <div class="utf_listing_item_content">
                    <div class="utf_listing_item-inner">
                      <h3>{{ $venue->title }}</h3>
                      <span><i class="sl sl-icon-location"></i> {{ $venue->address }}</span>
                      <span><i class="sl sl-icon-phone"></i> {{ $venue->phone }}</span>
                      <div class="utf_star_rating_section" data-rating="">
                        <div class="utf_counter_star_rating">()</div>
                      </div>
                      <p>{{ $venue->content }}</p>
                    </div>
                  </div>
                  </a>
                </div>
              </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
              <div class="utf_pagination_container_part margin-top-20 margin-bottom-70">
                <nav class="pagination">
                  <ul>
                    <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                    <li><a href="#" class="current-page">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4">
        <div class="sidebar">
          <div class="utf_box_widget margin-bottom-35">
            <h3><i class="sl sl-icon-direction"></i> Filters</h3>
            <div class="row with-forms">
              <div class="col-md-12">
                <input type="text" placeholder="What are you looking for?" value="">
              </div>
            </div>
            <div class="row with-forms">
              <div class="col-md-12">
                <div class="input-with-icon location">
                  <input type="text" placeholder="Search Location..." value="">
                  <a href="#"><i class="sl sl-icon-location"></i></a> </div>
              </div>
            </div>
			<a href="#" class="more-search-options-trigger margin-bottom-10" data-open-title="More Filters Options" data-close-title="More Filters Options"></a>
            <div class="more-search-options relative">
				<div class="checkboxes one-in-row margin-bottom-15">
					<input id="check-a" type="checkbox" name="check">
					<label for="check-a">Real Estate</label>
					<input id="check-b" type="checkbox" name="check">
					<label for="check-b">Friendly Workspace</label>
					<input id="check-c" type="checkbox" name="check">
					<label for="check-c">Instant Book</label>
					<input id="check-d" type="checkbox" name="check">
					<label for="check-d">Wireless Internet</label>
					<input id="check-e" type="checkbox" name="check">
					<label for="check-e">Free Parking</label>
					<input id="check-f" type="checkbox" name="check">
					<label for="check-f">Elevator in Building</label>
					<input id="check-g" type="checkbox" name="check">
					<label for="check-g">Restaurant</label>
					<input id="check-h" type="checkbox" name="check">
					<label for="check-h">Dance Floor</label>
				</div>
			</div>
            <button class="button fullwidth_block margin-top-5">Update</button>
          </div>
          <div class="utf_box_widget margin-top-35 margin-bottom-75">
            <h3><i class="sl sl-icon-folder-alt"></i> Категории</h3>
            <ul class="utf_listing_detail_sidebar">
			  @foreach ($categories as $category)
			  	<li><i class="fa fa-angle-double-right"></i> <a href="{{ route('category.show', ['category' => $category]) }}">{{ $category->category_bg_name }}</a></li>
			  @endforeach
            </ul>
          </div>
        </div>
      </div>
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
