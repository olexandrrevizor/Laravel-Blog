@include("parts.header")

<div class="content">
    <div class="col-md-12 contact-form-box">
        <h3>Edit News Form</h3>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-area">
                <form role="form" onsubmit="return LB.news.update_news(this);" action="{{URL::to('/update_news_post')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="news_id" value="{{$news->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$news->title}}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" id="content" name="content" placeholder="Content">{{$news->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="thumb" name="thumb" placeholder="Image Url" value="{{$news->thumb}}">
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include("parts.footer")