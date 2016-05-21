@include("parts.header")
<div class="content">
    <div class="col-md-12 contact-form-box">
        <h3>Add News Form</h3>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-area">
                <form role="form" onsubmit="return LB.news.form_proccess(this)" action="{{URL::to('/add_news_post')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" id="content" name="content" placeholder="Content"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="thumb" name="thumb" placeholder="Image Url">
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include("parts.footer")