@include("parts.header")

<div class="content">
    <div class="row row-margin-bottom">
        <div class="col-md-12 lib-item" data-category="view">
            <div class="lib-panel">
                <div class="col-md-12 box-shadow">
                    <div class="col-md-6">
                        <img class="lib-img-show" src="{{$news->thumb}}">
                    </div>
                    <div class="col-md-6">
                        <div class="lib-row lib-header">
                            {{$news->title}}
                            <div class="lib-header-seperator"></div>
                        </div>
                        <div class="lib-row lib-desc">
                            {{$news->content}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("parts.footer")