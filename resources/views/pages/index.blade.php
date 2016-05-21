@include("parts.header")

<div class="content">
        <section id="pinBoot">
                @foreach($news as $news_item)
                        <article class="white-panel" id="{{$news_item->id}}">
                                <img src="{{$news_item->thumb}}" alt="">
                                <h4><a href="{{URL::to('/news/'. $news_item->id)}}">{{$news_item->title}}</a></h4>
                                <p>{{$news_item->content}}</p>
                                <div class="row">
                                    <div class="col-md-1 col-md-offset-9">
                                        <a href="{{URL::to('/edit_news/'. $news_item->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="#" onclick="return LB.news.delete_news('{{$news_item->id}}')"><span class="glyphicon glyphicon-remove"></span></a>
                                    </div>
                                </div>
                        </article>
                @endforeach
        </section>
</div>

@include("parts.footer")