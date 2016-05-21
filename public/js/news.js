
LB.namespace('news');

LB.news = function (document, $) {
    var _sys = LB.system,

    ajax_setup = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },

    validate_form = function (fields) {
        var status = 1;
        for(var i = 0, max = fields.length; i < max; i++) {
            $('#' + fields[i].id).css({'box-shadow' : 'none'});

            if(fields[i].value == '') {
                $('#' + fields[i].id).css({'box-shadow' : 'inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(225,0,0,.8)'});
                status = 0;
                return status;
            }

        }

        return status;
    },

    remove_element = function (el) {
        $(el).addClass('fade-out');
        setTimeout(function () {
            $(el).remove();
        }, 450);

    },

    set_default_values = function (fields) {
        for(var i = 0, max = fields.length; i < max; i++)
          $('#' + fields[i].id).val(fields[i].default_value);
    },

    format_message = function (message_text, fields) {
        $('body').prepend('<div class="alert alert-success fade-in"> ' + message_text + '</div>');

        if(typeof fields != 'undefined')
            set_default_values(fields);

        setTimeout(function () {
            remove_element('.alert');
        }, 1000);
    },

    send_form = function (form) {
        var fields = [
            {
                id: 'title',
                value: form['title'].value,
                default_value: 'Title'
            },
            {
                id: 'content',
                value: form['content'].value,
                default_value: 'Content'
            },
            {
                id: 'thumb',
                value: form['thumb'].value,
                defaul_value: 'Image url'
            }
        ],
            status = validate_form(fields);

        if(!status)
            return false;

        $.ajax({
            url: form.action,
            type: 'POST',
            data: {
                title: fields[0].value,
                content: fields[1].value,
                thumb: fields[2].value
            },
            success: function (data) {
                if(data.result)
                    format_message('<strong>Success!</strong> New news add to database!', fields);
                else
                    format_message('<strong>Danger!</strong> News don\'t add to database!', fields);
            },
            error: function () {

            }
        });

        return false;
    },

    delete_news = function (news_id) {
        if (typeof news_id == 'undefined')
            return false;

        $.ajax({
            url: 'delete_news_post',
            type: 'POST',
            data: {
                news_id: news_id
            },
            success: function (data) {
                if(data.result) {
                    format_message('<strong>Success!</strong> News delete from database!');
                    setTimeout(function () {
                        remove_element('#' + news_id);
                    }, 1100);
                }
                else
                    format_message('<strong>Danger!</strong> News don\'t delete from database!');
            },
            error: function (data) {

            }

        });
        return false;
    },

    update_news = function (form) {
        var fields = [
                {
                    id: 'title',
                    value: form['title'].value,
                    default_value: 'Title'
                },
                {
                    id: 'content',
                    value: form['content'].value,
                    default_value: 'Content'
                },
                {
                    id: 'thumb',
                    value: form['thumb'].value,
                    defaul_value: 'Image url'
                }
            ],
            status = validate_form(fields),
            news_id = form['news_id'].value;

        if(!status && typeof news_id == 'undefined')
            return false;


        $.ajax({
            url: form.action,
            type: 'POST',
            data: {
                news_id: news_id,
                title: fields[0].value,
                content: fields[1].value,
                thumb: fields[2].value
            },
            success: function (data) {
                console.log(data);
                if(data.result)
                    format_message('<strong>Success!</strong> News updated in database!');
                else
                    format_message('<strong>Danger!</strong> News updated in database!');
            },
            error: function () {

            }
        })

        return false;
    },

    get_random_image = function() {
        var keyword = "lisa ann";
        $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?",
            {
                tags: keyword,
                tagmode: "any",
                format: "json"
            },
            function(data) {
                var rnd = Math.floor(Math.random() * data.items.length);
                console.log(data.items.length);
                var image_src = data.items[rnd]['media']['m'].replace("_m", "_b");

                $('body').css('background-image', "url('" + image_src + "')");

            });
    };
    _sys.registerAutoload(ajax_setup);
    /*_sys.registerAutoload(test);*/
    return {
        form_proccess: send_form,
        delete_news: delete_news,
        update_news: update_news
    }
}(document, jQuery)