@extends('frontend.common.app')

@section('head')
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/leaflet.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- <!-- Preloader Start -->
<div class="preloader">
    <div class="utf-preloader">
        <span></span>
        <span></span>
        <span></span>
		<span></span>
    </div>
</div>
<!-- Preloader End --> --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Wrapper -->
    <div id="main_wrapper">
        <form action="{{ route('venues.store') }}" id="add_venue_form" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="lat" value="" id="lat" />
            <input type="hidden" name="lng" value="" id="lng" />
            <input type="hidden" name="category_id" value="{{ $category->id }}" />
            <div class="container margin-bottom-75">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="utf_add_listing_part">
                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-tag"></i>{{ __('text.category_title') }}</h3>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>{{ __('text.title') }}</h5>
                                        <input type="text" class="search-field" name="title" id="title"
                                            placeholder="{{ __('text.title') }}" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-map"></i> {{ __('text.location') }}</h3>
                                </div>
                                <div class="utf_submit_section">
                                    <div class="row with-forms">
                                        <div class="col-md-6">
                                            <h5>{{ __('text.city') }}</h5>
                                            <div class="intro-search-field utf-chosen-cat-single" id="city_id_div">
                                                <select class="selectpicker default" name="city_id"
                                                    data-selected-text-format="count" data-size="7"
                                                    title="{{ __('text.city') }}"
                                                    id="city_id">
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}" data-lat="{{ $city->lat }}" data-lng="{{ $city->lng }}">{{ $city['name_'. app()->getLocale()] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>{{ __('text.address') }}</h5>
                                            <input type="text" class="input-text" name="address" id="address"
                                                placeholder="{{ __('text.address') }}" value="">
                                        </div>
                                        <div id="utf_listing_location" class="col-md-12 utf_listing_section map">
                                            <div id="map" style="height: 500px;">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-picture"></i> {{ __('text.images') }}</h3>
                                </div>
                                <form action="file-upload" class="dropzone"></form>
                                    <div class="row with-forms">
                                        <div class="utf_submit_section col-md-6">
                                            <h4>{{ __('text.cover_image') }}</h4>
                                            <input type="file" name="coverImage" />
                                        </div>
                                        <div class="utf_submit_section col-md-6">
                                            <h4>{{ __('text.other_images') }}</h4>
                                            <input type="file" name="images[]" multiple></input>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-list"></i> {{ __('text.content') }}</h3>
                                </div>
                                <div class="row with-forms">
                                    <div class="col-md-6">
                                        <h5>{{ __('text.phone') }}</h5>
                                        <input type="text" name="phone" id="phone" placeholder="{{ __('text.phone') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Email</h5>
                                        <input type="text" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Website</h5>
                                        <input type="text" name="website" placeholder="Website">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Facebook</h5>
                                        <input type="text" name="facebook" placeholder="Facebook">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Instagram</h5>
                                        <input type="text" name="instagram" placeholder="Instagram">
                                    </div>
                                    <div class="col-md-12">
                                        <h5>{{ __('text.description_bg') }}</h5>
                                        <textarea name="content_bg" cols="40" rows="3" id="content_bg"
                                            placeholder="{{ __('text.content') }}..." spellcheck="true"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <h5>{{ __('text.description_en') }}</h5>
                                        <textarea name="content_en" cols="40" rows="3" id="content_en"
                                            placeholder="{{ __('text.content') }}..." spellcheck="true"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-home"></i> {{ __('text.features') }}</h3>
                                </div>
                                <div class="checkboxes in-row amenities_checkbox">
                                    <ul>
                                        @foreach ($features as $feature)
                                            <li>
                                                <input id="{{ $feature->code }}" value="{{ $feature->id }}" type="checkbox" name="features_bool[]">
                                                <label for="{{ $feature->code }}">{{ $feature['name_' . app()->getLocale()] }}</label>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                            </div>

                            <div class="add_utf_listing_section margin-top-45">
                                <div class="utf_add_listing_part_headline_part">
                                    <h3><i class="sl sl-icon-clock"></i> {{ __('text.opening_hours') }} </h3>
                                </div>
                                <div class="switcher-content">
                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Monday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Tuesday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Wednesday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Thursday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Friday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Saturday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>

                                    <div class="row utf_opening_day utf_js_demo_hours">
                                        <div class="col-md-2">
                                            <h5>Sunday :-</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Open Time"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="utf_chosen_select" data-placeholder="Close Time"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="add_utf_listing_section margin-top-45">
				<div class="utf_add_listing_part_headline_part">
					<h3><i class="sl sl-icon-tag"></i> Add Pricing</h3>
                </div>
				<div class="row">
				  <div class="col-md-12">
					<table id="utf_pricing_list_section">
					  <tbody class="ui-sortable">
						<tr class="pricing-list-item pattern ui-sortable-handle">
						  <td><div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
							<div class="fm-input pricing-name">
							  <input type="text" placeholder="Title">
							</div>
							<div class="fm-input pricing-ingredients">
							  <input type="text" placeholder="Description">
							</div>
							<div class="fm-input pricing-price"><i class="data-unit">$</i>
							  <input type="text" placeholder="Price" data-unit="$">
							</div>
							<div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div></td>
						</tr>
					  </tbody>
					</table>
					<a href="#" class="button add-pricing-list-item">Add Item</a> <a href="#" class="button add-pricing-submenu">Add Category</a> </div>
				</div>
            </div> --}}

                            {{-- <div class="add_utf_listing_section margin-top-45">
              <div class="utf_add_listing_part_headline_part">
                <h3><i class="sl sl-icon-docs"></i> Your Listing Feature</h3>
              </div>
              <div class="checkboxes in-row amenities_checkbox">
                <ul>
					<li>
						<input id="check-a1" type="checkbox" name="check">
						<label for="check-a1">Accepts Credit Cards</label>
					</li>
					<li>
						<input id="check-b1" type="checkbox" name="check">
						<label for="check-b1">Smoking Allowed</label>
					</li>
					<li>
						<input id="check-c1" type="checkbox" name="check">
						<label for="check-c1">Bike Parking</label>
					</li>
					<li>
						<input id="check-d1" type="checkbox" name="check">
						<label for="check-d1">Hostels</label>
					</li>
					<li>
						<input id="check-e1" type="checkbox" name="check">
						<label for="check-e1">Wheelchair Accessible</label>
					</li>
					<li>
						<input id="check-f1" type="checkbox" name="check">
						<label for="check-f1">Wheelchair Internet</label>
					</li>
					<li>
						<input id="check-g1" type="checkbox" name="check">
						<label for="check-g1">Wheelchair Accessible</label>
					</li>
					<li>
						<input id="check-h1" type="checkbox" name="check" >
						<label for="check-h1">Parking Street</label>
					</li>
					<li>
						<input id="check-i1" type="checkbox" name="check" >
						<label for="check-i1">Wireless Internet</label>
					</li>
				</ul>
              </div>
            </div> --}}
                            <button class="button preview"><i class="fa fa-arrow-circle-right"></i> Save</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/chosen.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/tooltips.min.js') }}"></script>
    <script src="{{ asset('js/color_switcher.js') }}"></script>
    <script src="{{ asset('js/jquery_custom.js') }}"></script>
    <script src="{{ asset('js/markerclusterer.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/create_venue.js') }}"></script>

    <script>
        $(".utf_opening_day.utf_js_demo_hours .utf_chosen_select").each(function() {
            $(this).append('' +
                '<option></option>' +
                '<option>Closed</option>' +
                '<option>1 AM</option>' +
                '<option>2 AM</option>' +
                '<option>3 AM</option>' +
                '<option>4 AM</option>' +
                '<option>5 AM</option>' +
                '<option>6 AM</option>' +
                '<option>7 AM</option>' +
                '<option>8 AM</option>' +
                '<option>9 AM</option>' +
                '<option>10 AM</option>' +
                '<option>11 AM</option>' +
                '<option>12 AM</option>' +
                '<option>1 PM</option>' +
                '<option>2 PM</option>' +
                '<option>3 PM</option>' +
                '<option>4 PM</option>' +
                '<option>5 PM</option>' +
                '<option>6 PM</option>' +
                '<option>7 PM</option>' +
                '<option>8 PM</option>' +
                '<option>9 PM</option>' +
                '<option>10 PM</option>' +
                '<option>11 PM</option>' +
                '<option>12 PM</option>');
        });
    </script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
