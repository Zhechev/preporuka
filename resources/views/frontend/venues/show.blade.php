@extends('frontend.common.app')

@section('head')
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/leaflet.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Wrapper -->
<div id="main_wrapper"

  <div class="clearfix"></div>
  <div id="utf_listing_gallery_part" class="utf_listing_section">
    <div class="utf_listing_slider utf_gallery_container margin-bottom-0">
        <a href="{{ asset('images/' . $venue->cover_image) }}" data-background-image="{{ asset('images/' . $venue->cover_image) }}" class="item utf_gallery"></a>
        @foreach ($venue->images as $image)
            <a href="{{ asset('images/' . $image->path) }}" data-background-image="{{ asset('images/' . $image->path) }}" class="item utf_gallery"></a>
        @endforeach
	</div>
  </div>

  <input type="hidden" value="{{ $venue->lat }}" id="lat">
  <input type="hidden" value="{{ $venue->lng }}" id="lng">

  <div class="container">
    <div class="row utf_sticky_main_wrapper">
      <div class="col-lg-8 col-md-8">
        <div id="titlebar" class="utf_listing_titlebar">
          <div class="utf_listing_titlebar_title">
           <h2>{{ $venue->title }} <span class="listing-tag">{{ $venue->category['name_' . app()->getLocale()] }}</span></h2>
            <span> <a href="#utf_listing_location" class="listing-address"> <i class="sl sl-icon-location"></i> {{ $venue->address }} </a> </span>
			<span class="call_now"><i class="sl sl-icon-phone"></i> (415) 796-3633</span>
            <div class="utf_star_rating_section" data-rating="4.5">
              <div class="utf_counter_star_rating">(4.5) / (14 {{ __('text.reviews') }})</div>
            </div>
            <ul class="listing_item_social">
              <li><a href="#"><i class="fa fa-bookmark"></i> {{ __('text.bookmark') }}</a></li>
			  <li><a href="#"><i class="fa fa-star"></i> {{ __('text.add_review') }}</a></li>
              <li><a href="#"><i class="fa fa-share"></i> {{ __('text.share') }}</a></li>
			  <li><a href="#" class="now_open">{{ __('text.open') }}</a></li>
            </ul>
          </div>
        </div>
        <div id="utf_listing_overview" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">{{ __('text.description') }}</h3>
            <p>{{ $venue['content_' . app()->getLocale()] }}</p>
		  <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
		    <a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> {{ $venue->phone }} </a>
			<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $venue->email }}</a>
			<a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> {{ $venue->website }}</a>
          </div>
		  <div class="social-contact">
			<a href="{{ $venue->facebook }}" class="facebook-link"><i class="fa fa-facebook"></i> Facebook</a>
			<a href="{{ $venue->instagram }}" class="instagram-link"><i class="fa fa-instagram"></i> Instagram</a>
		  </div>
        </div>

		<div id="utf_listing_amenities" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-50 margin-bottom-40">{{ __('text.features') }}</h3>
          <ul class="utf_listing_features checkboxes margin-top-0">
            @foreach ($venue->category->features as $feature)
                @if(in_array($feature->id, $venue->features->pluck('id')->toArray()))
                    <li class="feature-yes">{{ $feature['name_' . app()->getLocale()] }}</li>
                @else
                    <li class="feature-no">{{ $feature['name_' . app()->getLocale()] }}</li>
                @endif
            @endforeach
          </ul>
        </div>
        @if($venue->lat != "null" && $venue->lng != "null" && !empty($venue->lat) && !empty($venue->lng))
        <div id="utf_listing_location" class="utf_listing_section">
            <h3 class="utf_listing_headline_part margin-top-60 margin-bottom-40">{{ __('text.location') }}</h3>
            <div id="utf_single_listing_map_block">
              <div id="utf_listing_location" class="col-md-12 utf_listing_section map">
                  <div id="map" style="height: 500px;">

                  </div>
              </div>
            </div>
          </div>
        @endif

        <div id="utf_listing_reviews" class="utf_listing_section">
          <h3 class="utf_listing_headline_part margin-top-75 margin-bottom-20">{{ __('text.Reviews') }} <span>(08)</span></h3>
          <div class="clearfix"></div>
		  <div class="reviews-container">
			<div class="row">
				<div class="col-lg-3">
					<div id="review_summary">
						<strong>4.5</strong>
						{{-- <em>Superb Reviews</em> --}}
						<small>Out of 15 Reviews</small>
					</div>
				</div>
				{{-- <div class="col-lg-9">
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Quality</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>77</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Space</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>15</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Price</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>18</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Service</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>10</strong></small></div>
					</div>
					<div class="row">
						<div class="col-lg-2 review_progres_title"><small><strong>Location</strong></small></div>
						<div class="col-lg-9">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col-lg-1 review_progres_title"><small><strong>05</strong></small></div>
					</div>
				</div> --}}
			</div>
		  </div>
          <div class="comments utf_listing_reviews">
            <ul>
                @foreach ($venue->reviews as $review)
                  <li>
                    <div class="avatar"><img src="images/client-avatar1.jpg" alt="" /></div>
                    <div class="utf_comment_content">
                      <div class="utf_arrow_comment"></div>
                      <div class="utf_star_rating_section" data-rating="4.5"></div>
                      <div class="utf_by_comment">Francis Burton<span class="date"><i class="fa fa-clock-o"></i> Jan 05, 2021 - 8:52 am</span> </div>
                      <a href="#" class="rate-review">Helpful Review <i class="fa fa-thumbs-up"></i></a>
                      <p>{{ $review->content }}</p>
                      <div class="review-images utf_gallery_container">
                          @foreach ($review->images as $image)
                          <a href="{{ asset('images/' . $image->path) }}" class="utf_gallery"><img src="{{ asset('images/' . $image->path) }}" alt=""></a>
                          @endforeach
                      </div>
                    </div>
                  </li>
                @endforeach

            </ul>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <div class="utf_pagination_container_part margin-top-30">
                <nav class="pagination">
                  <ul>
                    <li><a href="#"><i class="sl sl-icon-arrow-left"></i></a></li>
                    <li><a href="#" class="current-page">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div id="utf_add_review" class="utf_add_review-box">
          <h3 class="utf_listing_headline_part margin-bottom-20">{{ __('text.add_review') }}</h3>
          <form id="addReview" class="utf_add_comment" enctype="multipart/form-data" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" value="{{ $venue->id }}" name="venue_id">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="clearfix"></div>
                  <div class="utf_leave_rating margin-bottom-30">
                    <input type="radio" name="rating" id="rating-1" value="5"/>
                    <label for="rating-1" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-2" value="4"/>
                    <label for="rating-2" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-3" value="3"/>
                    <label for="rating-3" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-4" value="2"/>
                    <label for="rating-4" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-5" value="1"/>
                    <label for="rating-5" class="fa fa-star"></label>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="add-review-photos margin-bottom-30">
                    <div class="photoUpload"> <span>{{ __('text.upload_photos') }} <i class="sl sl-icon-arrow-up-circle"></i></span>
                      <input type="file" name="images[]" multiple class="upload" />
                    </div>
                  </div>
                </div>
              </div>
            <fieldset>
              <div>
                <label>{{ __('text.content') }}:</label>
                <textarea cols="40" placeholder="" rows="3" name="content"></textarea>
              </div>
            </fieldset>
            <button class="button" type="submit">Submit Review</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4 col-md-4 margin-top-75 sidebar-search">
        <div class="verified-badge with-tip margin-bottom-30" data-tip-content="Listing has been verified and belongs business owner or manager."> <i class="sl sl-icon-check"></i> Now Available</div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Contact Info</h3>
          <div class="utf_hosted_by_user_title"> <a href="#" class="utf_hosted_by_avatar_listing"><img src="images/dashboard-avatar.jpg" alt=""></a>
            <h4><a href="#">Kathy Brown</a><span>Posted 3 Days Ago</span>
              <span><i class="sl sl-icon-location"></i> Lonsdale St, Melbourne</span>
            </h4>
          </div>
		  <ul class="utf_social_icon rounded margin-top-10">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
          </ul>
          <ul class="utf_listing_detail_sidebar">
            <li><i class="sl sl-icon-map"></i> 12345 Little Lonsdale St, Melbourne</li>
            <li><i class="sl sl-icon-phone"></i> +(012) 1123-254-456</li>
            <li><i class="sl sl-icon-globe"></i> <a href="#">www.example.com</a></li>
            <li><i class="fa fa-envelope-o"></i> <a href="mailto:info@example.com">info@example.com</a></li>
          </ul>
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-folder-alt"></i> {{ __('text.categories') }}</h3>
          <ul class="utf_listing_detail_sidebar">
              @foreach ($categories as $category)
                <li><i class="fa fa-angle-double-right"></i> <a href="{{ route('categories.show', ['category' => $category]) }}">{{ $category['name_' . app()->getLocale()] }}</a></li>
              @endforeach
          </ul>
        </div>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-clock"></i> Business Hours</h3>
          <ul>
            <li>Monday <span>09:00 AM - 09:00 PM</span></li>
            <li>Tuesday <span>09:00 AM - 09:00 PM</span></li>
            <li>Wednesday <span>09:00 AM - 09:00 PM</span></li>
            <li>Thursday <span>09:00 AM - 09:00 PM</span></li>
            <li>Friday <span>09:00 AM - 09:00 PM</span></li>
            <li>Saturday <span>09:00 AM - 10:00 PM</span></li>
            <li>Sunday <span>09:00 AM - 10:00 PM</span></li>
          </ul>
        </div>
		<div class="opening-hours margin-top-35">
			<div class="utf_coupon_widget" style="background-image: url(images/coupon-bg-1.jpg);">
				<div class="utf_coupon_overlay"></div>
				<a href="#" class="utf_coupon_top">
					<h3>Book Now & Get 50% Discount</h3>
					<div class="utf_coupon_expires_date">Date of Expires 05/08/2021</div>
					<div class="utf_coupon_used"><strong>How to use?</strong> Just show us this coupon on a screen</div>
				</a>
				<div class="utf_coupon_bottom">
					<p>Coupon Code</p>
					<div class="utf_coupon_code">DL76T</div>
				</div>
			</div>
		</div>
        <div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Additional Information</h3>
          <ul>
            <li>Take Out: <span>Yes</span></li>
            <li>Delivery: <span>Yes</span></li>
            <li>Neutral Restrooms: <span>Yes</span></li>
            <li>Has Pool Table: <span>Yes</span></li>
            <li>Gender Neutral Restrooms: <span>Yes</span></li>
            <li>Waiter Service: <span>Yes</span></li>
          </ul>
        </div>
		<div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-envelope-open"></i> Sidebar Form</h3>
          <form id="contactform">
            <div class="row">
              <div class="col-md-12">
                  <input name="name" type="text" placeholder="Name" required="">
              </div>
              <div class="col-md-12">
                  <input name="email" type="email" placeholder="Email" required="">
              </div>
			  <div class="col-md-12">
                  <input name="phone" type="text" placeholder="Phone" required="">
              </div>
			  <div class="col-md-12">
				  <textarea name="comments" cols="40" rows="2" id="comments" placeholder="Your Message" required=""></textarea>
			  </div>
            </div>
            <input type="submit" class="submit button" id="submit" value="Contact Agent">
          </form>
        </div>
		<div class="utf_box_widget opening-hours margin-top-35">
          <h3><i class="sl sl-icon-info"></i> Google AdSense</h3>
          <span><img src="images/google_adsense.jpg" alt="" /></span>
        </div>
        <div class="utf_box_widget margin-top-35">
          <h3><i class="sl sl-icon-phone"></i> Quick Contact to Help?</h3>
          <p>Excepteur sint occaecat non proident, sunt in culpa officia deserunt mollit anim id est laborum.</p>
          <ul class="utf_social_icon rounded">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
          </ul>
          <a class="utf_progress_button button fullwidth_block margin-top-5" href="contact.html">Contact Us</a>
		</div>
        <div class="utf_box_widget listing-share margin-top-35 margin-bottom-40 no-border">
          <h3><i class="sl sl-icon-pin"></i> Bookmark Listing</h3>
		  <span>1275 People Bookmarked Listings</span>
          <button class="like-button"><span class="like-icon"></span> Login to Bookmark Listing</button>
          <ul class="utf_social_icon rounded margin-top-35">
            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
		<div class="utf_box_widget opening-hours review-avg-wrapper margin-top-35">
          <h3><i class="sl sl-icon-star"></i>  Rating Average </h3>
          <div class="box-inner">
			  <div class="rating-avg-wrapper text-theme clearfix">
				<div class="rating-avg">4.8</div>
				<div class="rating-after">
				  <div class="rating-mode">/5 Average</div>

				</div>
			  </div>
			  <div class="ratings-avg-wrapper">
				<div class="ratings-avg-item">
				  <div class="rating-label">Quality</div>
				  <div class="rating-value text-theme">5.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Location</div>
				  <div class="rating-value text-theme">4.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Space</div>
				  <div class="rating-value text-theme">3.5</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Service</div>
				  <div class="rating-value text-theme">4.0</div>
				</div>
				<div class="ratings-avg-item">
				  <div class="rating-label">Price</div>
				  <div class="rating-value text-theme">5.0</div>
				</div>
			  </div>
			</div>
        </div>
      </div>
    </div>
  </div>

  <section class="fullwidth_block padding-top-20 padding-bottom-50">
    <div class="container">
      <div class="row slick_carousel_slider">
        <div class="col-md-12">
          <h3 class="headline_part centered margin-bottom-25">Similar Listings</h3>
        </div>
		<div class="row">
			<div class="col-md-12">
				<div class="simple_slick_carousel_block utf_dots_nav">
				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-01.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span> <span class="featured_tag">Featured</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Chontaduro Barcelona</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>

				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-02.jpg" alt=""> <span class="tag"><i class="im im-icon-Electric-Guitar"></i> Events</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>
						</div>
						<h3>The Lounge & Bar</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>

				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-03.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $55</span>
						</div>
						<h3>Westfield Sydney</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>

				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-04.jpg" alt=""> <span class="tag"><i class="im im-icon-Dumbbell"></i> Fitness</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Ruby Beauty Center</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>

				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-05.jpg" alt=""> <span class="tag"><i class="im im-icon-Hotel"></i> Hotels</span> <span class="featured_tag">Featured</span>
					  <span class="utf_closed">Closed</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $45 - $70</span>
						</div>
						<h3>UK Fitness Club</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				   </div>

				  <div class="utf_carousel_item"> <a href="listings_single_page_1.html" class="utf_listing_item-container compact">
					<div class="utf_listing_item"> <img src="images/utf_listing_item-06.jpg" alt=""> <span class="tag"><i class="im im-icon-Chef-Hat"></i> Restaurant</span>
					  <span class="utf_open_now">Open Now</span>
					  <div class="utf_listing_item_content">
					    <div class="utf_listing_prige_block">
							<span class="utf_meta_listing_price"><i class="fa fa-tag"></i> $25 - $45</span>
							<span class="utp_approve_item"><i class="utf_approve_listing"></i></span>
						</div>
						<h3>Fairmont Pacific Rim</h3>
						<span><i class="fa fa-map-marker"></i> The Ritz-Carlton, Hong Kong</span>
						<span><i class="fa fa-phone"></i> (+15) 124-796-3633</span>
					  </div>
					</div>
					<div class="utf_star_rating_section" data-rating="4.5">
						<div class="utf_counter_star_rating">(4.5)</div>
						<span class="utf_view_count"><i class="fa fa-eye"></i> 822+</span>
						<span class="like-icon"></span>
					</div>
					</a>
				  </div>
				</div>
			  </div>
		  </div>
	   </div>
    </div>
  </section>

@endsection

@section('scripts')
<!-- Scripts -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/chosen.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/rangeslider.min.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/mmenu.js') }}"></script>
<script src="{{ asset('js/tooltips.min.js') }}"></script>
<script src="{{ asset('js/color_switcher.js') }}"></script>
<script src="{{ asset('js/jquery_custom.js') }}"></script>
<script src="{{ asset('js/markerclusterer.js') }}"></script>
<script src="{{ asset('js/quantityButtons.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/show_venue.js') }}"></script>
<script>
$(function() {
	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,
		isInvalidDate: function(date) {
		var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
		var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);
		}
	});
});

$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});
$('#date-picker').on('hide.daterangepicker', function(ev, picker) {
	$('.daterangepicker').removeClass('calendar-visible');
	$('.daterangepicker').addClass('calendar-hidden');
});

function close_panel_dropdown() {
$('.panel-dropdown').removeClass("active");
	$('.fs-inner-container.content').removeClass("faded-out");
}
$('.panel-dropdown a').on('click', function(e) {
	if ($(this).parent().is(".active")) {
		close_panel_dropdown();
	} else {
		close_panel_dropdown();
		$(this).parent().addClass('active');
		$('.fs-inner-container.content').addClass("faded-out");
	}
	e.preventDefault();
});
$('.panel-buttons button').on('click', function(e) {
	$('.panel-dropdown').removeClass('active');
	$('.fs-inner-container.content').removeClass("faded-out");
});
var mouse_is_inside = false;
$('.panel-dropdown').hover(function() {
	mouse_is_inside = true;
}, function() {
	mouse_is_inside = false;
});
$("body").mouseup(function() {
	if (!mouse_is_inside) close_panel_dropdown();
});
</script>
