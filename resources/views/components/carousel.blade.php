<div id="carouselExampleCaptions" class="carousel slide carouselcontainer "  data-bs-ride="carousel">
    <div class="carousel-indicators">
    @foreach ($news as $index => $button )
    <button  @if($loop->first) class="active" @endif type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" aria-label="Slide 2"></button>
    @endforeach
    </div>
    
    <div class="carousel-inner  carouselinner " >
        @foreach ($news as $item)
        <div class="carousel-item  @if($loop->first) active @endif h-100">
            <img src="{{$item['images']}}" class="d-block mx-auto h-100 w-75 object-fit-cover" alt="...">
            <div class="carousel-caption d-none d-md-block  carouselcontent">
            <h5>{{$item['title']}}</h5>
            <p>{{Str::limit($item['synopsis'],50)}}</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>