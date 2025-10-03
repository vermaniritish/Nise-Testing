<section class="agriculture-slider-wrap" id="homeCategory">
    <div class="container" v-if="records.length > 0">
        <div class="agriculture-inner-card">
            <h5>{!! preg_replace('/\d+/', $servicesCount, strip_tags($records['home_category_text'])) !!}</h5>
            <div class="d-flex position-relative search-input-home-outer">
                <span class="icon-search icon"></span>
                <input type="text" class="form-control search-input search-input-home rounded-3"
                    placeholder='Search with anything'>
                <button class="btn btn-bg-blue ms-2 rounded-3">Search</button>
            </div>
            <div class="agriculture-info-slider position-relative">
                <div class="main-bg-img position-absolute w-100">
                    <img :src="getImageUrl(selectedRecord.image)"alt="img"
                        class="w-100">
                </div>
                <div class="overlayer-content position-relative z-1">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="verticle-slide-thumbs position-relative">
                                <ul class="list-unstyled">
                                    <li v-for="(record, index) in records" :key="record.id"
                                        @click="selectCategory(index)" :class="{ 'active': selectedIndex === index }">
                                        @{{ record.title }}
                                    </li>
                                </ul>
                                <button class="slide-down">
                                    <i class="las la-angle-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="active-slide-card text-light">
                        {{-- <div class="slide-feature-tag">
                            <span>Popular</span>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-10">
                                <div class="category-detail">
                                    <h5>@{{ selectedRecord.title }}</h5>
                                    <small>@{{ selectedRecord.description }} </small>
                                </div>
                                <a v-if="selectedRecord.button_status === 1" :href="selectedRecord.button_link"
                                    class="btn btn-bg-light">
                                    @{{ selectedRecord.button_title }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
